<?php

class SearchController extends BaseController
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
        $theme->setTitle('SiamiTs :: Search');
        $theme->setDescription('Search description');

        $client = new Client(Config::get('url.siamits-api'));
        $page    = array_get($data, 'page', '1');
        $perpage = array_get($data, 'perpage', '15');
        $order   = array_get($data, 'order', 'tagables.updated_at');
        $sort    = array_get($data, 'sort', 'desc');

        // News
        $parameters = array(
            'page'    => $page,
            'perpage' => $perpage,
            'order'   => $order,
            'sort'    => $sort,
        );

        isset($data['s']) ? $parameters['s'] = $data['s'] : '';
        $param = '';
        isset($data['s']) ? $param['s'] = $data['s'] : '';

        $results = $client->get('tags/search', $parameters);
        $results = json_decode($results, true);
        $news = array_get($results, 'data.record', array());

        $view = array(
            'data'  => $news,
            'param' => $param,
        );

        //Pagination
        if ($pagination = getDataArray($results, 'data.pagination')) {
            $view['pagination'] = getPaginationsMake($pagination, $news);
        }

        $script = $theme->scopeWithLayout('search.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('search.index', $view)->render();
    }
}
