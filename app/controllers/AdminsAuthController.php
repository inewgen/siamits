<?php

class AdminsAuthController extends \BaseController
{
    private $fb;
    private $scode;

    public function __construct(FacebookHelper $fb, Scode $scode)
    {
        $this->fb = $fb;
        $this->scode = $scode;
    }

    public function getTwitterLogin($auth = null)
    {
        if ($auth == 'auth') {
            Hybrid_Endpoint::process();
            return;
        }

        try {
            $oauth = new Hybrid_Auth(app_path() . '/config/twitterAuth.php');
            $provider = $oauth->authenticate('Twitter');
            $profile = $provider->getUserProfile();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return var_dump($profile) . '<a href="logout">Log Out</a>';

    }

    //this is the code for facebook Login
    public function getFacebookLogin($auth = null)
    {
        if ($auth == 'auth') {
            try {
                Hybrid_Endpoint::process();
            } catch (Exception $e) {
                return Redirect::to('fbauth');
            }
            return;
        }

        $oauth = new Hybrid_Auth(app_path() . '/config/fb_auth.php');
        $provider = $oauth->authenticate('Facebook');
        $profile = $provider->getUserProfile();

        if (empty($profile)) {
            return Redirect::to('/login')->with('error', 'Data not found facebook.');
        }

        //Upload images
        $code = $this->scode->imageCode();

        $photo_facebook = str_replace('150', '200', $profile->photoURL);
        $password = $this->scode->pencode('@siamits12345!', '@SiamiTS!');
        $extension = 'jpg';
        $name = 'facebook.' . $extension;

        $images[] = array(
            'code' => $code,
            'name' => $name,
            'extension' => $extension,
        );

        $parameters = array(
            'email' => $profile->email,
            'password' => $password,
            'name' => $profile->displayName,
            'birthday' => date("Y-m-d", strtotime($profile->birthYear.'-'.$profile->birthMonth.'-'.$profile->birthDay)),
            'photo' => $photo_facebook,
            'images' => $images,
            'uid_fb' => $profile->identifier,
            'first_name' => $profile->firstName,
            'last_name' => $profile->lastName,
            'gender' => $profile->gender,
            'link_fb' => $profile->profileURL,
            'locale' => $profile->language,
            'access_token_fb' => '',
            'remember_token' => '',
            'status' => '1',
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

        //$this->access_token_fb = $this->fb->getToken();
        $user_id = array_get($results, 'id', 0);

        // Delete old images
        foreach ($images_old as $key => $value) {
            $code_old = array_get($value, 'code', 0);
            $extension_old = array_get($value, 'extension', 'jpg');

            $image_path = 'public/uploads/' . $user_id . '/' . $code_old . '.' . $extension_old;
            $image_delete = File::delete($image_path);
        }

        // Upload images
        $targetFolder = 'public/uploads/' . $user_id;
        $targetFile = 'public/uploads/' . $user_id . '/' . $code . '.' . $extension;

        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777);
        }

        $photo = $this->fb->saveImage($photo_facebook, $targetFile);
        //alert($user);die();;
        Auth::loginUsingId($user->id);

        return Redirect::to('/login')->with('message', 'You are login with facebook already');
    }

    //this is the method that will handle the Google Login

    public function getGoogleLogin($auth = null)
    {
        if ($auth == 'auth') {
            Hybrid_Endpoint::process();

        }
        try {
            $oauth = new Hybrid_Auth(app_path() . '/config/google_auth.php');
            $provider = $oauth->authenticate('Google');
            $profile = $provider->getUserProfile();
        } catch (exception $e) {
            return $e->getMessage();
        }

        if (empty($profile)) {
            return Redirect::to('/login')->with('error', 'Data not found google.');
        }

        //Upload images
        $code = $this->scode->imageCode();

        $photo_google = $profile->photoURL;
        $password = $this->scode->pencode('@siamits12345!', '@SiamiTS!');
        $extension = 'jpg';
        $name = 'google.' . $extension;

        $images[] = array(
            'code' => $code,
            'name' => $name,
            'extension' => $extension,
        );

        $parameters = array(
            'email' => $profile->email,
            'password' => $password,
            'name' => $profile->displayName,
            'birthday' => date("Y-m-d", strtotime($profile->birthYear.'-'.$profile->birthMonth.'-'.$profile->birthDay)),
            'photo' => $photo_google,
            'images' => $images,
            'uid_g' => $profile->identifier,
            'first_name' => $profile->firstName,
            'last_name' => $profile->lastName,
            'gender' => $profile->gender,
            'link_g' => $profile->profileURL,
            'locale' => $profile->language,
            'access_token_g' => '',
            'remember_token' => '',
            'status' => '1',
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

        //$this->access_token_fb = $this->fb->getToken();
        $user_id = array_get($results, 'id', 0);

        // Delete old images
        foreach ($images_old as $key => $value) {
            $code_old = array_get($value, 'code', 0);
            $extension_old = array_get($value, 'extension', 'jpg');

            $image_path = 'public/uploads/' . $user_id . '/' . $code_old . '.' . $extension_old;
            $image_delete = File::delete($image_path);
        }

        // Upload images
        $targetFolder = 'public/uploads/' . $user_id;
        $targetFile = 'public/uploads/' . $user_id . '/' . $code . '.' . $extension;

        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777);
        }

        $photo = $this->fb->saveImage($photo_google, $targetFile);
        //alert($user);die();
        Auth::loginUsingId($user->id);
        
        return Redirect::to('/login')->with('message', 'You are login with google already');
    }

    public function getLoggedOut()
    {
        Auth::logout();
        // $hauth = new Hybrid_Auth(app_path() . '/config/twitterAuth.php');
        // $hauth = new Hybrid_Auth(app_path() . '/config/fb_auth.php');
        //You can use any of the one provider to get the variable, I am using google
        //this is important to do, as it clears out the cookie
        $hauth = new Hybrid_auth(app_path() . '/config/google_auth.php');
        $hauth->logoutAllProviders();
        return Redirect::to('login');

    }

}
