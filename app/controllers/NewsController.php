<?php
use Madcoda\Youtube;

class NewsController extends BaseController
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
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: News');
        $theme->setDescription('News description');

        // Get hightlight news
        $client = new Client(Config::get('url.siamits-api'));
        $page    = array_get($data, 'page', '1');
        $perpage = array_get($data, 'perpage', '15');
        $order   = array_get($data, 'order', 'updated_at');
        $sort    = array_get($data, 'sort', 'desc');

        // News
        $parameters = array(
            'page'    => $page,
            'perpage' => $perpage,
            'order'   => $order,
            'sort'    => $sort,
        );

        isset($data['s']) ? $parameters['s'] = $data['s'] : '';

        $results = $client->get('news', $parameters);
        $results = json_decode($results, true);
        $news = array_get($results, 'data.record', array());

        // Popular News
        $parameters = array(
            'page'    => '1',
            'perpage' => '5',
            'order'   => 'views',
            'sort'    => 'desc',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $pnews = $client->get('news', $parameters);
        $pnews = json_decode($pnews, true);
        $pnews = array_get($pnews, 'data.record', array());

        $param = '';
        isset($data['s']) ? $param['s'] = $data['s'] : '';

        // Category
        $parameters = array(
            'type' => '2',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $category = $client->get('categories', $parameters);
        $category = json_decode($category, true);
        $category = array_get($category, 'data.record', array());

        $categories = array();
        foreach ($category as $key => $value) {
            $categories[array_get($value, 'id', '')] = array_get($value, 'title', '');
        }

        // Youtube feed
        $youtube = self::getYoutubeSearch();

        $view = array(
            'news'  => $news,
            'pnews'  => $pnews,
            'param' => $param,
            'categories' => $categories,
            'youtube'    => $youtube,
        );

        sdebug($view);

        //Pagination
        if ($pagination = self::getDataArray($results, 'data.pagination')) {
            $view['pagination'] = self::getPaginationsMake($pagination, $news);
        }

        $script = $theme->scopeWithLayout('news.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('news.index', $view)->render();
    }

    public function show($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: News');
        $theme->setDescription('News description');

        // Validator request
        $rules = array(
            'id' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return Redirect::to('news')->withErrors($message);
        }

        // News
        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('news/'.$id);
        $results = json_decode($results, true);
        $news = array_get($results, 'data.record.0', array());

        // Category
        $parameters = array(
            'type' => '2',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('categories', $parameters);
        $results = json_decode($results, true);
        $category = array_get($results, 'data.record', array());

        $view = array(
            'news' => $news,
            'categories' => $category,
        );

        sdebug($view);

        $script = $theme->scopeWithLayout('news.jscript_show', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('news.show', $view)->render();
    }

    // List news by category
    public function listNewsCategory($id)
    {
        $data = Input::all();
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: News');
        $theme->setDescription('News description');

        // Get hightlight news
        $client = new Client(Config::get('url.siamits-api'));
        $page    = array_get($data, 'page', '1');
        $perpage = array_get($data, 'perpage', '15');
        $order   = array_get($data, 'order', 'updated_at');
        $sort    = array_get($data, 'sort', 'desc');

        // News
        $parameters = array(
            'category_id' => $id,
            'page'       => $page,
            'perpage'    => $perpage,
            'order'      => $order,
            'sort'       => $sort,
        );

        $results = $client->get('news', $parameters);
        $results = json_decode($results, true);

        $news = array_get($results, 'data.record', array());
        $param = '';

        // Category
        $parameters = array(
            'type' => '2',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $category = $client->get('categories', $parameters);
        $category = json_decode($category, true);
        $category = array_get($category, 'data.record', array());

        $categories = array();
        foreach ($category as $key => $value) {
            $categories[array_get($value, 'id', '')] = array_get($value, 'title', '');
        }

        $view = array(
            'id'  => $id,
            'news'  => $news,
            'param' => $param,
            'categories' => $categories,
        );

        sdebug($view, true);

        //Pagination
        if ($pagination = self::getDataArray($results, 'data.pagination')) {
            $view['pagination'] = self::getPaginationsMake($pagination, $news);
        }

        $script = $theme->scopeWithLayout('news.jscript_category_news', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('news.category_news', $view)->render();
    }

    // List category
    public function listCategory()
    {
        $data = Input::all();
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: News');
        $theme->setDescription('News description');

        // Get hightlight news
        $client = new Client(Config::get('url.siamits-api'));
        $page    = array_get($data, 'page', '1');
        $perpage = array_get($data, 'perpage', '15');
        $order   = array_get($data, 'order', 'position');
        $sort    = array_get($data, 'sort', 'asc');

        // Category
        $parameters = array(
            'type'    => '2',
            'page'    => $page,
            'perpage' => $perpage,
            'order'   => $order,
            'sort'    => $sort,
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('categories', $parameters);
        $results = json_decode($results, true);
        $category = array_get($results, 'data.record', array());

        $categories = array();
        foreach ($category as $key => $value) {
            $categories[array_get($value, 'id', '')] = array_get($value, 'title', '');
        }

        $param = '';
        $view = array(
            'param' => $param,
            'category' => $category,
            'categories' => $categories,
        );

        sdebug($view, true);

        //Pagination
        if ($pagination = self::getDataArray($results, 'data.pagination')) {
            $view['pagination'] = self::getPaginationsMake($pagination, $category);
        }

        $script = $theme->scopeWithLayout('news.jscript_category_list', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('news.category_list', $view)->render();
    }

    private function getYoutubeSearch()
    {
        // Youtube feed
        $youtube = new Youtube(array('key' => Config::get('youtube.key')));

        $params = array(
            'key'             => 'AIzaSyCZTwvt_utoDFW7U6KKwXKHNMS4ZrZyfyk',
            'q'               => 'Future Smart Technology News',
            'type'            => 'video',
            'part'            => 'id, snippet',
            // 'order'        => 'date',
            'order'           => 'viewCount',
            'videoDefinition' => 'high',
            'maxResults'      => 1,
        );

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

    private function getPaginationsMake($pagination, $record)
    {
        $total = array_get($pagination, 'total', 0);
        $limit = array_get($pagination, 'perpage', 0);
        $paginations = Paginator::make($record, $total, $limit);
        return isset($paginations) ? $paginations : '';
    }

    private function getDataArray($data, $key)
    {
        return array_get($data, $key, false);
    }
}
