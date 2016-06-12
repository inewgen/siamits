<?php
use Madcoda\Youtube;

class DashboardController extends BaseController
{

    public function __construct(
        BannersRepositoryInterface $bannersRepository,
        NewsRepositoryInterface $newsRepository,
        PagesRepositoryInterface $pagesRepository,
        QuotesRepositoryInterface $quotesRepository,
        LayoutsRepositoryInterface $layoutsRepository)
    {
        $this->layoutsRepository = $layoutsRepository;
        $this->bannersRepository = $bannersRepository;
        $this->newsRepository    = $newsRepository;
        $this->pagesRepository   = $pagesRepository;
        $this->quotesRepository  = $quotesRepository;
    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $data  = Input::all();
        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: Home');
        $theme->setDescription('Home description');

        $view = array();

        // Get layouts
        $parameters = array(
            'pages'  => 'dashboard',
            'status' => '1'
        );

        $results = $this->layoutsRepository->get($parameters);

        $layout = array();
        if ($layouts = array_get($results, 'data.record', false)) {
            foreach ($layouts as $key => $value) {
                $layout[] = $value['title'];
            }
        }
        $view['layout'] = $layout;

        // Get banners
        if (in_array('banners', $layout)) {
            $parameters = array(
                // 'user_id' => '1',
                'perpage' => '100',
            );

            $results = $this->bannersRepository->get($parameters);

            $view['banners'] = array_get($results, 'data.record', array());
        }

        // Get hightlight news
        if (in_array('hnews', $layout)) {
            $parameters = array(
                'type'    => '2',
                'perpage' => '10',
                'order'   => 'updated_at',
                'sort'    => 'desc',
            );
            // $results2 = $client->get('news', $parameters);
            // $results2 = json_decode($results2, true);
            $results2 = $this->newsRepository->get($parameters);

            $news_h = array_get($results2, 'data.record', array());
            $view['news']['highlight'] = $news_h;
        }

        // Get news
        if (in_array('news', $layout)) {
            $parameters = array(
                'type'    => '1',
                'perpage' => '12',
                'order'   => 'updated_at',
                'sort'    => 'desc',
            );
            // $results2 = $client->get('news', $parameters);
            // $results2 = json_decode($results2, true);
            $results2 = $this->newsRepository->get($parameters);

            $news_h = array_get($results2, 'data.record', array());
            $view['news']['general'] = $news_h;
        }

        // Get hightlight pages
        if (in_array('hpages', $layout)) {
            $parameters = array(
                'type'    => '2',
                'perpage' => '10',
                'order'   => 'updated_at',
                'sort'    => 'desc',
            );
            // $results_p = $client->get('pages', $parameters);
            // $results_p = json_decode($results_p, true);
            $results_p = $this->pagesRepository->get($parameters);

            $pages_h = array_get($results_p, 'data.record', array());
            $view['pages']['highlight'] = $pages_h;
        }

        // Get pages
        if (in_array('pages', $layout)) {
            $parameters = array(
                'type'    => '1',
                'perpage' => '12',
                'order'   => 'updated_at',
                'sort'    => 'desc',
            );
            // $results_p = $client->get('pages', $parameters);
            // $results_p = json_decode($results_p, true);
            $results_p = $this->pagesRepository->get($parameters);

            $pages_h = array_get($results_p, 'data.record', array());
            $view['pages']['general'] = $pages_h;
        }

        // Youtube feed
        if (in_array('video', $layout)) {
            $search_youtube = 'เทคโนโลยี อนาคต';
            $view['youtube'] = self::getYoutubeSearch($search_youtube, 20);
        }

        // Get Quotes
        if (in_array('pages', $layout)) {
            $parameters = array(
                'type'    => '1',
                'perpage' => '20',
                'order'   => 'position',
                'sort'    => 'asc',
            );

            // $client         = new Client(Config::get('url.siamits-api'));
            // $results        = $client->get('quotes', $parameters);
            // $results        = json_decode($results, true);
            $results = $this->quotesRepository->get($parameters);

            $view['quotes'] = array_get($results, 'data.record', array());
        }

        $script = $theme->scopeWithLayout('dashboard.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        $render = $theme->scopeWithLayout('dashboard.index', $view)->render();

        return $render;
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
            // 'order' => 'viewCount',
            'order' => 'rating',
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

    public function ajaxWeather()
    {
        $data = Input::all();
        $response = array();

        // Get weather
        $entries = array();
        for ($i = 1; $i <= 7; $i++) {
            $parameters = array(
                'RegionID' => $i,
            );

            $client = new Client('http://www.tmd.go.th');
            $results = $client->get('xml/region_daily_forecast.php', $parameters);
            $results = json_encode(xmlstr_to_array($results));
            $results = json_decode($results, true);

            if (!$channel = array_get($results, 'channel', false)) {
                return $client->createResponse($response, 1001);
            }

            $entries[$i] = $results;
        }

        return $client->createResponse($entries, 0);
    }
}
