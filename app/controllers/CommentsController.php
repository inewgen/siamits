<?php
class CommentsController extends BaseController
{
    public function ajaxComments()
    {
        $data = Input::all();
        $response = array();

        $order = array_get($data, 'order', 'updated_at');
        $sort = array_get($data, 'sort', 'desc');
        $page = array_get($data, 'page', 0);
        $perpage = array_get($data, 'perpage', 20);

        // Parameters
        $parameters = array(
            'order' => $order,
            'sort' => $sort,
            'page' => $page,
            'perpage' => $perpage,
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('comments', $parameters);
        $results = json_decode($results, true);

        if (array_get($results, 'status_code', false) != '0') {
            $status_code = array_get($results, 'status_code', '');
            $status_txt = array_get($results, 'status_txt', '');

            return $client->createResponse($status_txt, $status_code);
        }

        // Loop data
        $entries = array();
        if ($data = array_get($results, 'data.record', false)) {
            foreach ($data as $key => $value) {
                $entry = array();
                foreach ($value as $key2 => $value2) {
                    if ($key2 == 'message2') {
                        $entry[$key2] = mb_substr($value2, 0, 20, 'UTF-8');
                    } else {
                        $entry[$key2] = $value2;
                    }
                }

                $entries[$key] = $entry;
            }
        }

        return $client->createResponse($entries, 0);
    }
}
