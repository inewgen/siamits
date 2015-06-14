<?php

class ProcessingController extends BaseController
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $req_path = Request::path();
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: '.$req_path);
        $theme->setDescription($req_path.' description');
        
        $view = array(
            'xxx' => 'xxx',
        );

        $script = $theme->scopeWithLayout('processing.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('processing.index', $view)->render();
    }
}
