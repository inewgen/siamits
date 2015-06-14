<?php

class GalleryController extends BaseController
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
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: Gallery');
        $theme->setDescription('Gallery description');

        $view = array(
            'name' => 'xxx',
        );

        $script = $theme->scopeWithLayout('gallery.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('gallery.index', $view)->render();
    }
}
