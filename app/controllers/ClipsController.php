<?php
use Madcoda\Youtube;

class ClipsController extends BaseController
{
    /**
     * The layout that should be used for responses.
     */
    //protected $layout = 'layouts.master';

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $data = Input::all();

        $client = new Client(Config::get('url.siamits-api'));
        $page = array_get($data, 'page', '1');

        if (isMobile()) {
            $perpage = array_get($data, 'perpage', '5');
        } else {
            $perpage = array_get($data, 'perpage', '20');
        }

        $order = array_get($data, 'order', 'updated_at');
        $sort = array_get($data, 'sort', 'desc');
        $action = array_get($data, 'action', '');

        $param = array();
        $param['s'] = '';
        isset($data['s']) ? $param['s'] = $data['s'] : '';
        // isset($data['prevPageToken']) ? $param['prevPageToken'] = $data['prevPageToken'] : '';
        // isset($data['nextPageToken']) ? $param['nextPageToken'] = $data['nextPageToken'] : '';
        isset($data['pageToken']) ? $param['pageToken'] = $data['pageToken'] : '';

        // Youtube feed
        $key = array_get($data, 's', '');
        $youtube = $this->getYoutubeSearch($key, $page, $perpage, $param);
        //$youtube = self::getYoutubeSearch($search_youtube, 20);

        if (isset($youtube['PageToken']['prevPageToken'])) {
            $param['prevPageToken'] = $youtube['PageToken']['prevPageToken'];
        }

        isset($youtube['PageToken']['nextPageToken']) ? $param['nextPageToken'] = $youtube['PageToken']['nextPageToken'] : '';

        if ($action == 'ajax') {
            if (!isset($youtube['pagination']['total'])) {
                $response['message'] = 'Can connect to youtube';

                return $client->createResponse($response, 1001);
            }

            if (!array_get($youtube, 'results', false)) {
                $response['message'] = 'Data not found';

                return $client->createResponse($response, 1004);
            }

            $response['pagination'] = $youtube['pagination'];
            $response['PageToken'] = $youtube['PageToken'];
            $response['results'] = $youtube['results'];
            return $client->createResponse($response, 0);
        } else {
            $theme = Theme::uses('margo')->layout('margo');
            $theme->setTitle('SiamiTs :: Clips VDO');
            $theme->setDescription('Clips VDO description');

            $view = array(
                'param' => $param,
                'youtube' => $youtube,
                'page' => $page,
            );

            //Pagination
            if ($pagination = getDataArray($youtube, 'pagination')) {
                $view['pagination'] = getPaginationsMake($pagination, $youtube['results']);
            }

            $script = $theme->scopeWithLayout('clips.jscript_index', $view)->content();
            $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

            return $theme->scopeWithLayout('clips.index', $view)->render();
        }
    }

    private function getYoutubeSearch($key, $page, $perpage, $param)
    {
        // Youtube feed
        $youtube = new Youtube(array('key' => Config::get('youtube.key')));

        $params = array(
            'key' => 'AIzaSyCZTwvt_utoDFW7U6KKwXKHNMS4ZrZyfyk',
            'q' => $key,
            'type' => 'video',
            'part' => 'id, snippet',
            // 'order'        => 'date',
            //'eventType'       => 'completed',
            //'order' => 'viewCount',
            'order' => 'rating',
            'videoDefinition' => 'high',
            'maxResults' => $perpage,
        );

        if (isset($param['prevPageToken'])) {
            $params['prevPageToken'] = $param['prevPageToken'];
        }

        if (isset($param['nextPageToken'])) {
            $params['nextPageToken'] = $param['nextPageToken'];
        }

        if (isset($param['pageToken'])) {
            $params['pageToken'] = $param['pageToken'];
        }

        if (isset($param['pageToken'])) {
            if (is_null($param['pageToken']) || ($param['pageToken'] == null) || ($param['pageToken'] == null) || ($param['pageToken'] == 'null')) {
                $entries['results'] = array();
                $entries['pagination']['total'] = 0;
                return $entries;
            }
        }

        // Make Intial Call. With second argument to reveal page info such as page tokens.
        $search = $youtube->searchAdvanced($params, true);

        // check if we have a pageToken
        if (isset($search['info']['nextPageToken'])) {
            $params['pageToken'] = $search['info']['nextPageToken'];
        }

        // Make Another Call and Repeat
        $search = $youtube->searchAdvanced($params, true);
        $search = json_decode(json_encode($search), true);

        $entries['results'] = array();
        if (isset($search['results']) && is_array($search['results'])) {
            foreach ($search['results'] as $key => $value) {
                $entries['results'][$key]['id'] = array_get($value, 'id.videoId', '');
                $entries['results'][$key]['title'] = array_get($value, 'snippet.title', '');
                $entries['results'][$key]['channelTitle'] = array_get($value, 'snippet.channelTitle', '');
                $entries['results'][$key]['images']['default'] = array_get($value, 'snippet.thumbnails.default.url', '');
                $entries['results'][$key]['images']['medium'] = array_get($value, 'snippet.thumbnails.medium.url', '');
                $entries['results'][$key]['images']['high'] = array_get($value, 'snippet.thumbnails.high.url', '');
            }
        }

        if (isset($search['info']) && is_array($search['info'])) {
            $entries['pagination']['page'] = $page;
            $entries['pagination']['perpage'] = $search['info']['resultsPerPage'];

            if (is_array($search['results']) && count($search['results']) > 0) {
                // if (count($search['results']) >= $perpage) {
                $entries['pagination']['total'] = $search['info']['totalResults'];
                $entries['PageToken']['prevPageToken'] = $search['info']['prevPageToken'];
                $entries['PageToken']['nextPageToken'] = $search['info']['nextPageToken'];
                // } else {
                //     $entries['pagination']['total'] = count($search['results']);
                // }
            } else {
                $entries['pagination']['total'] = 0;
                // $entries['PageToken']['prevPageToken'] = '';
                // $entries['PageToken']['nextPageToken'] = '';
            }
        }

        return $entries;
    }
}
