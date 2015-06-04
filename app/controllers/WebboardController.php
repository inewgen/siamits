<?php

class WebboardController extends BaseController
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
        $theme->setTitle('SiamiTs :: Webboard');
        $theme->setDescription('Webboard description');

        $view = array(
            'name' => 'xxx',
        );

        $script = $theme->scopeWithLayout('webboard.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('webboard.index', $view)->render();
    }
}
