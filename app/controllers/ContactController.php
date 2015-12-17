<?php

class ContactController extends BaseController
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
        $theme->setTitle('SiamiTs :: Contact');
        $theme->setDescription('Contact description');

        $view = array(
            'name' => 'xxx',
        );

        $script = $theme->scopeWithLayout('contact.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('contact.index', $view)->render();
    }

    public function postAddContact()
    {
        $data = Input::all();
        $perpage = 10;
        $client = new Client(Config::get('url.siamits-api'));

        // Validator request
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
        );

        $referer = array_get($data, 'referer', '');
        
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response['message'] = $validator->messages()->first();

            return $client->createResponse($response, 1003);
        }

        $ip = $_SERVER['REMOTE_ADDR'];

        // Recaptcha
        $parameters = array(
            'secret' => Config::get('web.recaptch-secret-key'),
            'response' => array_get($data, 'g-recaptcha-response', ''),
            'remoteip' => $ip,
        );

        $client = new Client(Config::get('url.recaptch-api'));
        $recaptcha = $client->get('siteverify', $parameters);
        $recaptcha = json_decode($recaptcha, true);

        if (array_get($recaptcha, 'success', false) == false) {
            $response['message'] = array_get($recaptcha, 'error-codes.0', 'The captch is invalid.');

            return $client->createResponse($response, 1003);
        }

        // Parameters
        $parameters_allow = array(
            'name' => '',
            'email' => '',
            'mobile' => '',
            'message' => '',
            'user_id' => '',
            'status' => '1', // 0=Closed,1=New,2=Read,3=Active
            'ip' => $ip,
            'url' => $referer,
        );

        $parameters = array();
        foreach ($parameters_allow as $key => $val) {
            $parameters[$key] = array_get($data, $key, $val);
        }

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->post('contacts', $parameters);
        $results = json_decode($results, true);

        if (array_get($results, 'status_code', false) != '0') {
            $response['message'] = array_get($results, 'status_txt', 'Can not created');

            return $client->createResponse($response, 1001);
        }

        $response['message'] = 'You successfully send message';
        return $client->createResponse($response, 0);
    }
}
