<?php

class DashboardController extends BaseController
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
        $theme->setTitle('SiamiTs :: Home');
        $theme->setDescription('Home description');
        
        $parameters = array(
            'user_id' => '1',
            'perpage'   => '100',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('banners', $parameters);
        $results = json_decode($results, true);

        $banners = array_get($results, 'data.record', array());

        $parameters = array(
            'user_id' => '1',
            'perpage' => '20',
            'order' => 'updated_at',
            'sort' => 'desc',
        );
        $results2 = $client->get('news', $parameters);
        $results2 = json_decode($results2, true);

        $news = array_get($results2, 'data.record', array());

        $news_entry = array();
        foreach ($news as $key => $value) {
            if ($value['type'] == '2') {
                $news_entry['highlight'][$key] = $value;
            } else {
                $news_entry['general'][$key] = $value;
            }
        }

        if (isset($_GET['sdebug'])) {
            alert($results);
            die();
        }
        
        $view = array(
            'banners' => $banners,
            'news'    => $news_entry,
        );

        $script = $theme->scopeWithLayout('dashboard.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('dashboard.index', $view)->render();
    }
}
