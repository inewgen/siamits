<?php
use Madcoda\Youtube;

class DashboardController extends BaseController
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $data = Input::all();

        // Get cache value
        $key_cache = 'web.0.dashboard.index.0.'.md5(serialize($data));
        if ($render = getCache($key_cache)) {
            return $render;
        }

        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: Home');
        $theme->setDescription('Home description');
        
        // Get banners
        $parameters = array(
            // 'user_id' => '1',
            'perpage'   => '100',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('banners', $parameters);
        $results = json_decode($results, true);
        sdebug($results,true);
        $banners = array_get($results, 'data.record', array());

        // Get hightlight news
        $parameters = array(
            'type' => '2',
            'perpage' => '10',
            'order' => 'updated_at',
            'sort' => 'desc',
        );
        $results2 = $client->get('news', $parameters);
        $results2 = json_decode($results2, true);

        $news_h = array_get($results2, 'data.record', array());
        $news_entry['highlight'] = $news_h;

        // Get news
        $parameters = array(
            'type' => '1',
            'perpage' => '16',
            'order' => 'updated_at',
            'sort' => 'desc',
        );
        $results2 = $client->get('news', $parameters);
        $results2 = json_decode($results2, true);

        $news_h = array_get($results2, 'data.record', array());
        $news_entry['general'] = $news_h;

        // Youtube feed
        $youtube = self::getYoutubeSearch();
        
        $view = array(
            'banners' => $banners,
            'news'    => $news_entry,
            'youtube'    => $youtube,
        );

        $script = $theme->scopeWithLayout('dashboard.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        $render = $theme->scopeWithLayout('dashboard.index', $view)->render();

        // Save cache value
        if (!Session::has('success') && !Session::has('error') && !Session::has('warning')) {
            $contents = sanitize_output($render->original);
            saveCache($key_cache, $contents);
        }

        return $render;
    }

    private function getYoutubeSearch()
    {
        // Youtube feed
        $youtube = new Youtube(array('key' => Config::get('youtube.key')));

        $params = Config::get('youtube');

        // Make Intial Call. With second argument to reveal page info such as page tokens.
        $search = $youtube->searchAdvanced($params, true);

        // check if we have a pageToken
        if (isset($search['info']['nextPageToken'])) {
            $params['pageToken'] = $search['info']['nextPageToken'];
        }

        // Make Another Call and Repeat
        $search = $youtube->searchAdvanced($params, true);
        $search = json_decode(json_encode($search), true);

        $entries = array();
        if (isset($search['results']) && is_array($search['results'])) {
            foreach ($search['results'] as $key => $value) {
                $entries[$key]['id']                = array_get($value, 'id.videoId', '');
                $entries[$key]['title']             = array_get($value, 'snippet.title', '');
                $entries[$key]['channelTitle']      = array_get($value, 'snippet.channelTitle', '');
                $entries[$key]['images']['default'] = array_get($value, 'snippet.thumbnails.default.url', '');
                $entries[$key]['images']['medium']  = array_get($value, 'snippet.thumbnails.medium.url', '');
                $entries[$key]['images']['high']    = array_get($value, 'snippet.thumbnails.high.url', '');
            }
        }

        return $entries;
    }
}
