<?php

use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;

class SocialsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		if($session) {

		  try {

		    $response = (new FacebookRequest(
		      $session, 'POST', '/me/feed', array(
		      	'link' => 'www.example.com',
		      	'message' => 'User provided message'
		      )
		    ))->execute()->getGraphObject();

		    echo "Posted with id: " . $response->getProperty('id');

		  } catch(FacebookRequestException $e) {

		    echo "Exception occured, code: " . $e->getCode();
		    echo " with message: " . $e->getMessage();

		  }   

		}
	}

}
