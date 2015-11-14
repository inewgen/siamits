<?php

class SystemsController extends BaseController
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function getFileNotFound()
    {
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: Home');
        $theme->setDescription('Home description');
        
        $parameters = array(
            'member_id' => '1',
            'perpage'   => '100',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('banners', $parameters);
        $results = json_decode($results, true);

        if (isset($_GET['sdebug'])) {
            alert($results);
            die();
        }

        $banners = array_get($results, 'data.record', array());
        $view = array(
            'banners' => $banners,
        );

        $script = $theme->scopeWithLayout('dashboard.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('dashboard.index', $view)->render();
    }
}
