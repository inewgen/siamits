<?php

use App\Repositories\CachedRepository;

class NewsRepository implements NewsRepositoryInterface
{

    public function __construct(CachedRepository $cachedRepository)
    {
        $this->cachedRepository = $cachedRepository;
        $this->pathcache = 'web.0.news';
    }

    public function get($parameters)
    {
        $keycache = getKeyCache($this->pathcache . '.get', $parameters);

        // Get cache
        $response = $this->cachedRepository->get($keycache);
        if ($response) {
            return $response;
        }

        if (isset($_GET['nocache'])) {
            $parameters['nocache'] = $_GET['nocache'];
        }

        $client   = new Client(Config::get('url.siamits-api'));
        $results  = $client->get('news', $parameters);
        $response = json_decode($results, true);

        // Save cache
        $this->cachedRepository->put($keycache, $response);

        return $response;
    }
}
