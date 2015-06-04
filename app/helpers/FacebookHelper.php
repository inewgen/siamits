<?php
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;

class FacebookHelper
{
    private $helper;
    private $session;

    public function __construct()
    {
        FacebookSession::setDefaultApplication(Config::get('facebook.app_id'), Config::get('facebook.app_secret'));

        $this->helper = new FacebookRedirectLoginHelper(url('login/fb/callback'));
    }

    public function getUrlLogin()
    {
        return $this->helper->getLoginUrl(Config::get('facebook.app_scope'));
    }

    public function generateSessionFromRedirect()
    {
        $this->session = null;
        try {
            $this->session = $this->helper->getSessionFromRedirect();
        } catch (FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch (\Exception $ex) {
            // When validation fails or other local issues
        }

        return $this->session;
    }

    public function generateSessionFromToken($token)
    {
        $this->session = new FacebookSession($token);
        return $this->session;
    }

    public function getToken()
    {
        return $this->session->getToken();
    }

    public function getGraph()
    {
        $request = new FacebookRequest($this->session, 'GET', '/me');
        $response = $request->execute();
        return $response->getGraphObject();
    }

    public function saveImage($inPath, $outPath)
    {
        //Download images from remote server
        $in  = fopen($inPath, "rb");
        $out = fopen($outPath, "w+");

        while ($chunk = fread($in, 8192)) {
            fwrite($out, $chunk, 8192);
        }
        fclose($in);
        fclose($out);

        return $outPath;
    }
}
