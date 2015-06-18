<?php

class NewsController extends BaseController
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
        $theme->setTitle('SiamiTs :: News');
        $theme->setDescription('News description');

        $view = array(
            'name' => 'xxx',
        );

        $script = $theme->scopeWithLayout('news.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('news.index', $view)->render();
    }

    public function show($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        $theme = Theme::uses('margo')->layout('margo');
        $theme->setTitle('SiamiTs :: News');
        $theme->setDescription('News description');

        // Validator request
        $rules = array(
            'id' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return Redirect::to('news')->withErrors($message);
        }

        $parameters = array(
            'user_id' => '1',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('news/'.$id, $parameters);
        $results = json_decode($results, true);

        $news = array_get($results, 'data.record.0', array());

        $view = array(
            'news' => $news,
        );

        $script = $theme->scopeWithLayout('news.jscript_show', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('news.show', $view)->render();
    }
}
