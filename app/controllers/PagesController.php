<?php
use Madcoda\Youtube;

class PagesController extends BaseController
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
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: Pages');
        $theme->setDescription('Pages description');

        $client = new Client(Config::get('url.siamits-api'));
        $page = array_get($data, 'page', '1');
        $perpage = array_get($data, 'perpage', '15');
        $order = array_get($data, 'order', 'updated_at');
        $sort = array_get($data, 'sort', 'desc');

        // Pages
        $parameters = array(
            'page' => $page,
            'perpage' => $perpage,
            'order' => $order,
            'sort' => $sort,
        );

        isset($data['s']) ? $parameters['s'] = $data['s'] : '';

        $results = $client->get('pages', $parameters);
        $results = json_decode($results, true);
        $pages = array_get($results, 'data.record', array());

        // Popular Pages
        $parameters = array(
            'page' => '1',
            'perpage' => '5',
            'order' => 'views',
            'sort' => 'desc',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $ppages = $client->get('pages', $parameters);
        $ppages = json_decode($ppages, true);
        $ppages = array_get($ppages, 'data.record', array());

        $param = '';
        isset($data['s']) ? $param['s'] = $data['s'] : '';

        // Category
        $parameters = array(
            'type' => '3',
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
        $search_youtube = array_get($pages, 'title', 'Future Smart Technology Pages');
        $youtube = self::getYoutubeSearch($search_youtube, 3);

        $view = array(
            'pages' => $pages,
            'ppages' => $ppages,
            'param' => $param,
            'categories' => $categories,
            'youtube' => $youtube,
        );

        sdebug($view);

        //Pagination
        if ($pagination = self::getDataArray($results, 'data.pagination')) {
            $view['pagination'] = self::getPaginationsMake($pagination, $pages);
        }

        $script = $theme->scopeWithLayout('pages.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('pages.index', $view)->render();
    }

    public function show($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        $theme = Theme::uses('margo')->layout('margo');

        // Validator request
        $rules = array(
            'id' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return Redirect::to('pages')->withErrors($message);
        }

        // Pages
        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('pages/' . $id);
        $results = json_decode($results, true);
        $pages = array_get($results, 'data.record.0', array());
        sdebug($pages, true);

        // Popular Pages
        $parameters = array(
            'page' => '1',
            'perpage' => '5',
            'order' => 'views',
            'sort' => 'desc',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $ppages = $client->get('pages', $parameters);
        $ppages = json_decode($ppages, true);
        $ppages = array_get($ppages, 'data.record', array());

        $param = '';
        isset($data['s']) ? $param['s'] = $data['s'] : '';

        // Category
        $parameters = array(
            'type' => '3',
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
        //$tags_arr = array('ข่าว');
        $i = 0;
        foreach (array_get($pages, 'tags', array()) as $t) {
            if ($i < 1) {
                $tags_arr1[] = array_get($t, 'title', '');
            }
            if ($i < 2) {
                $tags_arr2[] = array_get($t, 'title', '');
            }
            if ($i < 3) {
                $tags_arr3[] = array_get($t, 'title', '');
            }
            $i++;
        }

        // 3 keys
        $search_origin = 'Future Smart Technology';
        $tags = $search_origin;
        if (isset($tags_arr3)) {
            $tags = implode(' ', $tags_arr3);
        }

        $search_youtube = $tags;
        $youtube = self::getYoutubeSearch($search_youtube, 3);

        // 2 keys
        if (count($youtube) == 0) {
            $search_origin = 'Future Smart Technology';
            $tags = $search_origin;
            if (isset($tags_arr2)) {
                $tags = implode(' ', $tags_arr2);
            }

            $search_youtube = $tags;
            $youtube = self::getYoutubeSearch($search_youtube, 3);
        }

        // 1 keys
        if (count($youtube) == 0) {
            $search_origin = 'Future Smart Technology';
            $tags = $search_origin;
            if (isset($tags_arr1)) {
                $tags = implode(' ', $tags_arr1);
            }

            $search_youtube = $tags;
            $youtube = self::getYoutubeSearch($search_youtube, 3);
        }

        // default keys
        if (count($youtube) == 0) {
            $search_youtube = $search_origin;
            $youtube = self::getYoutubeSearch($search_youtube, 3);
        }

        // Author
        $user_id = array_get($pages, 'user_id', '');
        $client = new Client(Config::get('url.siamits-api'));
        $author = $client->get('users/' . $user_id);
        $author = json_decode($author, true);
        $author = array_get($author, 'data.record', array());

        // Comments
        $page = array_get($data, 'page', '1');
        $perpage = array_get($data, 'perpage', '10');
        $order = array_get($data, 'order', 'updated_at');
        $sort = array_get($data, 'sort', 'asc');

        $parameters = array(
            'commentable_type' => 'pages',
            'commentable_id' => $id,
            'page' => $page,
            'perpage' => $perpage,
            'order' => $order,
            'sort' => $sort,
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('comments', $parameters);
        $results = json_decode($results, true);
        $comments_num = array_get($results, 'data.pagination.total', 0);
        $comments = array_get($results, 'data.record', array());

        $theme->setTitle('SiamiTs :: Pages');
        $theme->setDescription(array_get($pages, 'title', ''));

        $view = array(
            'url_share' => URL::to('pages') . '/' . $id,
            'pages' => $pages,
            'ppages' => $ppages,
            'param' => $param,
            'categories' => $categories,
            'youtube' => $youtube,
            'author' => $author,
            'comments' => $comments,
            'comments_num' => $comments_num,
        );

        sdebug($view, true);
        //Pagination
        if ($pagination = self::getDataArray($results, 'data.pagination')) {
            $view['pagination'] = self::getPaginationsMake($pagination, $pages);
        }

        $script = $theme->scopeWithLayout('pages.jscript_show', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('pages.show', $view)->render();
    }

    // List pages by category
    public function listPagesCategory($id)
    {
        $data = Input::all();
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: Pages');
        $theme->setDescription('Pages description');

        // Get hightlight pages
        $client = new Client(Config::get('url.siamits-api'));
        $page = array_get($data, 'page', '1');
        $perpage = array_get($data, 'perpage', '15');
        $order = array_get($data, 'order', 'updated_at');
        $sort = array_get($data, 'sort', 'desc');

        // Pages
        $parameters = array(
            'category_id' => $id,
            'page' => $page,
            'perpage' => $perpage,
            'order' => $order,
            'sort' => $sort,
        );

        $results = $client->get('pages', $parameters);
        $results = json_decode($results, true);

        $pages = array_get($results, 'data.record', array());
        $param = '';

        // Popular Pages
        $parameters = array(
            'page' => '1',
            'perpage' => '5',
            'order' => 'views',
            'sort' => 'desc',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $ppages = $client->get('pages', $parameters);
        $ppages = json_decode($ppages, true);
        $ppages = array_get($ppages, 'data.record', array());

        $param = '';
        isset($data['s']) ? $param['s'] = $data['s'] : '';

        // Category
        $parameters = array(
            'type' => '3',
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
        $search_youtube = array_get($pages, 'title', 'Future Smart Technology Pages');
        $youtube = self::getYoutubeSearch($search_youtube, 3);

        $view = array(
            'id' => $id,
            'pages' => $pages,
            'ppages' => $ppages,
            'param' => $param,
            'categories' => $categories,
            'youtube' => $youtube,
        );

        sdebug($view, true);

        //Pagination
        if ($pagination = self::getDataArray($results, 'data.pagination')) {
            $view['pagination'] = self::getPaginationsMake($pagination, $pages);
        }

        $script = $theme->scopeWithLayout('pages.jscript_category_pages', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('pages.category_pages', $view)->render();
    }

    // List category
    public function listCategory()
    {
        $data = Input::all();
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: Pages');
        $theme->setDescription('Pages description');

        // Get hightlight pages
        $client = new Client(Config::get('url.siamits-api'));
        $page = array_get($data, 'page', '1');
        $perpage = array_get($data, 'perpage', '15');
        $order = array_get($data, 'order', 'position');
        $sort = array_get($data, 'sort', 'asc');

        // Category
        $parameters = array(
            'type' => '3',
            'page' => $page,
            'perpage' => $perpage,
            'order' => $order,
            'sort' => $sort,
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('categories', $parameters);
        $results = json_decode($results, true);
        $category = array_get($results, 'data.record', array());

        $categories = array();
        foreach ($category as $key => $value) {
            $categories[array_get($value, 'id', '')] = array_get($value, 'title', '');
        }

        // Popular Pages
        $parameters = array(
            'page' => '1',
            'perpage' => '5',
            'order' => 'views',
            'sort' => 'desc',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $ppages = $client->get('pages', $parameters);
        $ppages = json_decode($ppages, true);
        $ppages = array_get($ppages, 'data.record', array());

        $param = '';
        isset($data['s']) ? $param['s'] = $data['s'] : '';

        // Youtube feed
        $pages = array();
        $search_youtube = array_get($pages, 'title', 'Future Smart Technology Pages');
        $youtube = self::getYoutubeSearch($search_youtube, 3);

        $view = array(
            //'pages'  => $pages,
            'ppages' => $ppages,
            'param' => $param,
            'category' => $category,
            'categories' => $categories,
            'youtube' => $youtube,
        );

        sdebug($view, true);

        //Pagination
        if ($pagination = self::getDataArray($results, 'data.pagination')) {
            $view['pagination'] = self::getPaginationsMake($pagination, $category);
        }

        $script = $theme->scopeWithLayout('pages.jscript_category_list', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('pages.category_list', $view)->render();
    }

    public function postAddComment()
    {
        $data = Input::all();
        $perpage = 10;

        // Validator request
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'commentable_id' => 'required',
            'g-recaptcha-response' => 'required',
        );

        $referer = array_get($data, 'referer', '');
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = $validator->messages()->first();

            return Redirect::to($referer)->with('error', $message);
        }

        $ip = $_SERVER['REMOTE_ADDR'];

        // Recaptcha
        $parameters = array(
            'secret' => Config::get('web.recaptch-secret-key'),
            'response' => array_get($data, 'g-recaptcha-response', ''),
            'remoteip' => $ip,
        );

        $client = new Client(Config::get('url.recaptch-api'));
        $recaptcha = $client->get('siteverify', $parameters);
        $recaptcha = json_decode($recaptcha, true);

        if (array_get($recaptcha, 'success', false) == false) {
            $message = array_get($recaptcha, 'error-codes.0', 'The captch is invalid.');

            return Redirect::to($referer)->with('error', $message);
        }

        // Comments
        $parameters = array(
            'commentable_type' => 'pages',
            'commentable_id' => array_get($data, 'commentable_id', ''),
            'page' => '1',
            'perpage' => '1',
            'order' => 'number',
            'sort' => 'desc',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('comments', $parameters);
        $results = json_decode($results, true);
        $comments_num = array_get($results, 'data.pagination.total', 0);
        $comments_num_last = array_get($results, 'data.record.0.number', 0);
        $comments_num_last = $comments_num_last + 1;
        $comments_page_last = ceil($comments_num / $perpage);
        $comments_page_last = ($comments_page_last > 0 ? $comments_page_last : 1);

        // Parameters
        $parameters_allow = array(
            'name' => '',
            'email' => '',
            'message' => '',
            'user_id' => '',
            'commentable_type' => 'pages',
            'commentable_id' => '',
            'number' => $comments_num_last,
            'status' => '1',
            'ip' => $ip,
        );

        $parameters = array();
        foreach ($parameters_allow as $key => $val) {
            $parameters[$key] = array_get($data, $key, $val);
        }

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->post('comments', $parameters);
        $results = json_decode($results, true);

        if (array_get($results, 'status_code', false) != '0') {
            $message = array_get($results, 'status_txt', 'Can not created');

            return Redirect::to($referer)->with('error', $message);
        }

        $message = 'You successfully created. <a href="' . URL::to('pages') . '/' . array_get($data, 'commentable_id', '') . '?page=' . $comments_page_last . '#comments' . $comments_num_last . '">View your comment</a>';
        return Redirect::to('pages/' . array_get($data, 'commentable_id', '') . '?page=' . $comments_page_last . '#addcomments')->with('success', $message);
    }

    private function getYoutubeSearch($key, $max)
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
            'order' => 'viewCount',
            'videoDefinition' => 'high',
            'maxResults' => $max,
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
                $entries[$key]['id'] = array_get($value, 'id.videoId', '');
                $entries[$key]['title'] = array_get($value, 'snippet.title', '');
                $entries[$key]['channelTitle'] = array_get($value, 'snippet.channelTitle', '');
                $entries[$key]['images']['default'] = array_get($value, 'snippet.thumbnails.default.url', '');
                $entries[$key]['images']['medium'] = array_get($value, 'snippet.thumbnails.medium.url', '');
                $entries[$key]['images']['high'] = array_get($value, 'snippet.thumbnails.high.url', '');
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

    public function ajaxUpdatePages()
    {
        $data = Input::all();
        $client = new Client(Config::get('url.siamits-api'));

        $rules = array(
            'action' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = $validator->messages()->first();

            return $client->createResponse($response, 1003);
        }

        $action = array_get($data, 'action', null);
        $response = array();

        if ($action == 'update') {
            $rules = array(
                'id' => 'required',
            );

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $response = $validator->messages()->first();

                return $client->createResponse($response, 1003);
            }

            $id = array_get($data, 'id', '');

            // Parameters
            $parameters_allow = array(
                'title',
                'sub_description',
                'description',
                'position',
                'status',
                'user_id',
                'reference',
                'reference_url',
                'categories',
                'type',
                'views',
                'likes',
                'share',
                'tags',
            );

            $parameters = array();
            foreach ($parameters_allow as $val) {
                if ($val2 = array_get($data, $val, false)) {
                    $parameters[$val] = $val2;
                }
            }

            $client = new Client(Config::get('url.siamits-api'));
            $results = $client->put('pages/' . $id, $parameters);
            $results = json_decode($results, true);

            if (array_get($results, 'status_code', false) != '0') {
                $status_code = array_get($results, 'status_code', '');
                $status_txt = array_get($results, 'status_txt', '');

                return $client->createResponse($status_txt, $status_code);
            }
        }

        return $client->createResponse($response, 0);
    }

    public function ajaxUpdatePagesStat()
    {
        $data = Input::all();
        $response = array();

        $rules = array(
            'type' => 'required',
            'id' => 'required',
            'action' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $client = new Client(Config::get('url.siamits-api'));
            $response = $validator->messages()->first();

            return $client->createResponse($response, 1003);
        }

        $id = array_get($data, 'id', '');
        $type = array_get($data, 'type', '');
        $action = array_get($data, 'action', '');

        // Parameters
        $parameters_allow = array(
            'type',
            'id',
            'action',
        );

        $parameters = array();
        foreach ($parameters_allow as $val) {
            if ($val2 = array_get($data, $val, false)) {
                $parameters[$val] = $val2;
            }
        }

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('pages/update/stat', $parameters);
        $results = json_decode($results, true);

        if (array_get($results, 'status_code', false) != '0') {
            $status_code = array_get($results, 'status_code', '');
            $status_txt = array_get($results, 'status_txt', '');

            return $client->createResponse($status_txt, $status_code);
        }

        if (in_array($type, array('likes', 'unlikes'))) {
            if ($action == '2') {
                unset($_COOKIE['likes_pages_' . $id]);
                $lifetime = time() - (60 * 60 * 1);
                $likes_value = null;
                $likes_cookies = setcookie('likes_pages_' . $id, $likes_value, $lifetime, '/', null, null, true);
            } else {
                $lifetime = time() + (60 * 60 * 1);
                $likes_value = array_get($data, 'type', '');
                $likes_cookies = setcookie('likes_pages_' . $id, $likes_value, $lifetime, '/', null, null, true);
            }
        }

        // Loop data
        $entries = array();
        if ($data = array_get($results, 'data', false)) {
            foreach ($data as $key => $value) {
                $entries[$key] = number_format($value);
            }
        }

        $cookies = isset($_COOKIE['likes_pages_' . $id]) ? $_COOKIE['likes_pages_' . $id] : false;

        $response = array(
            'data' => $entries,
            'cookies' => $cookies,
        );

        return $client->createResponse($response, 0);
    }
}
