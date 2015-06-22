<?php

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

        $parameters = array(
            'page'    => $page,
            'perpage' => $perpage,
            'order'   => $order,
            'sort'    => $sort,
        );

        $results = $client->get('news', $parameters);
        $results = json_decode($results, true);

        $news = array_get($results, 'data.record', array());

        $view = array(
            'news'  => $news,
            'param' => $parameters,
        );

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

        $parameters = array(
            'user_id' => '1',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('news/'.$id, $parameters);
        $results = json_decode($results, true);

        $news = array_get($results, 'data.record.0', array());

        $view = array(
            'news' => $news,
        );

        $script = $theme->scopeWithLayout('news.jscript_show', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('news.show', $view)->render();
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
