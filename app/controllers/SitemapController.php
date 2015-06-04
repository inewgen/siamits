<?php

class SitemapController extends BaseController
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
        $theme->setTitle('SiamiTs :: Sitemap');
        $theme->setDescription('Sitemap description');

        $view = array(
            'name' => 'xxx',
        );

        $script = $theme->scopeWithLayout('sitemap.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('sitemap.index', $view)->render();
    }
}
