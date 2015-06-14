<?php

class LoginFacebookController extends \BaseController
{

    private $fb;
    private $scode;

    public function __construct(FacebookHelper $fb, Scode $scode)
    {
        $this->fb = $fb;
        $this->scode = $scode;
    }

    public function login()
    {
        return Redirect::to($this->fb->getUrlLogin());
    }

    public function callback()
    {
        if (!$this->fb->generateSessionFromRedirect()) {
            return Redirect::to('/login')->with('error', "Error, can't login with facebook");
        }

        $user_fb = $this->fb->getGraph();

        if (empty($user_fb)) {
            return Redirect::to('/login')->with('error', 'Data not found facebook.');
        }

        //Upload images
        $code = $this->scode->imageCode();

        $photo_facebook = 'http://graph.facebook.com/' . $user_fb->getProperty('id') . '/picture?type=large&width=200&height=200';
        $password = $this->scode->pencode('@siamits12345!', '@SiamiTS!');
        $extension = 'jpg';
        $name = 'facebook.'.$extension;
        
        $images[] = array(
            'code'      => $code,
            'name'      => $name,
            'extension' => $extension,
        );

        $parameters = array(
            'email'           => $user_fb->getProperty('email'),
            'password'        => $password,
            'name'            => $user_fb->getProperty('name'),
            'birthday'        => date("Y-m-d", strtotime($user_fb->getProperty('birthday'))),
            'photo'           => $photo_facebook,
            'images'          => $images,
            'uid_fb'          => $user_fb->getProperty('id'),
            'first_name'      => $user_fb->getProperty('first_name'),
            'last_name'       => $user_fb->getProperty('last_name'),
            'gender'          => $user_fb->getProperty('gender'),
            'link_fb'         => $user_fb->getProperty('link'),
            'locale'          => $user_fb->getProperty('locale'),
            'timezone'        => $user_fb->getProperty('timezone'),
            'access_token_fb' => $this->fb->getToken(),
            'remember_token'  => '',
            'status'          => '1',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->post('users', $parameters);
        $results = json_decode($results, true);

        if (empty($results['data']['record']['id'])) {
            $message = array_get($results, 'data.message', 'Data not found facebook.');
            return Redirect::to('/login')->with('error', $message);
        }

        $images_old = array_get($results, 'data.images_old', array());
        $results = array_get($results, 'data.record', array());

        $user = new User;
        foreach ($results as $key => $value) {
                $user->$key = $value;
        }

        $this->access_token_fb = $this->fb->getToken();
        $user_id = array_get($results, 'id', 0);

        // Delete old images
        foreach ($images_old as $key => $value) {
            $code_old = array_get($value, 'code', 0);
            $extension_old = array_get($value, 'extension', 'jpg');

            $image_path = 'public/uploads/'.$user_id.'/'.$code_old.'.'.$extension_old;
            $image_delete = File::delete($image_path);
        }

        // Upload images
        $targetFolder = 'public/uploads/'.$user_id;
        $targetFile = 'public/uploads/'.$user_id.'/'.$code.'.'.$extension;

        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777);
        }

        $photo = $this->fb->saveImage($photo_facebook, $targetFile);
    //alert($user);die();
        Auth::login($user);

        return Redirect::to('/login')->with('message', 'You are login with facebook already');
    }
}
