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
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: Search');
        $theme->setDescription('Search description');

        $view = array(
            'name' => 'xxx',
        );

        $script = $theme->scopeWithLayout('search.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('search.index', $view)->render();
    }
}
