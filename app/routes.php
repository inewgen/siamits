<?php
require app_path() . '/funcs.php';
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

App::missing(function($exception) {
    $req_path = Request::path();

    return pageNotFound($req_path);
});

$req_path = Request::path();
$prefix = '';

if (routeLoad($prefix . 'contact', $req_path)) {
    Route::get('contact', 'ContactController@Index');
}

if (routeLoad($prefix . 'gallery', $req_path)) {
    Route::get('gallery', 'GalleryController@Index');
}

if (routeLoad($prefix . 'members', $req_path)) {
    Route::get('members', 'MembersController@Index');
}

if (routeLoad($prefix . 'news', $req_path)) {
    Route::get('news', 'NewsController@Index');
    Route::get('news/{id}', 'NewsController@Show');
}

if (routeLoad($prefix . 'pages', $req_path)) {
    Route::get('pages', 'PagesController@Index');
}

if (routeLoad($prefix . 'policy', $req_path)) {
    Route::get('policy', 'PolicyController@Index');
}

if (routeLoad($prefix . 'register', $req_path)) {
    Route::get('register', 'RegisterController@Index');
}

if (routeLoad($prefix . 'search', $req_path)) {
    Route::get('search', 'SearchController@Index');
}

if (routeLoad($prefix . 'sitemap', $req_path)) {
    Route::get('sitemap', 'SitemapController@Index');
}

if (routeLoad($prefix . 'webboard', $req_path)) {
    Route::get('webboard', 'WebboardController@Index');
}

// Processing
if (in_array($req_path, $path_processing)) {
    Route::get($req_path, 'ProcessingController@Index');
}

Route::get('/', 'DashboardController@Index');

// Admins
Route::get('login', array('uses' => 'AdminsUsersController@login'));
Route::get('register/verify', array('uses' => 'AdminsUsersController@verify'));
Route::get('register', array('uses' => 'AdminsUsersController@register'));
Route::post('register', array('uses' => 'AdminsUsersController@postRegister'));
Route::get('checkmail', array('uses' => 'AdminsUsersController@checkmail'));
Route::post('login', array('uses' => 'AdminsUsersController@postLogin'));
Route::get('mail/sendmail', array('uses' => 'AdminsMailController@sendMail'));
Route::post('images/uploads', 'AdminsImagesController@uploads');
Route::get('images/deleteimages', 'AdminsImagesController@getDeleteImage');
Route::get('forgot', array('uses' => 'AdminsUsersController@forgot'));
Route::post('forgot', array('uses' => 'AdminsUsersController@postForgot'));
Route::get('forgot/password', array('uses' => 'AdminsUsersController@setPassword'));
Route::post('forgot/password', array('uses' => 'AdminsUsersController@postForgotPassword'));
Route::get('logout',array('as'=>'logout','uses'=>'AdminsAuthController@getLoggedOut'));
Route::get('fbauth/{auth?}',array('as'=>'facebookAuth','uses'=>'AdminsAuthController@getFacebookLogin'));
Route::get('gauth/{auth?}',array('as'=>'googleAuth','uses'=>'AdminsAuthController@getGoogleLogin'));

// Route admin
Route::group(array('prefix' => 'admins','before'=>'auth'), function () use ($req_path) {
    $req_path  = Request::path();
    $prefix = 'admins/';

    Route::get('profile', array('uses' => 'AdminsUsersController@profile'));
    Route::post('profile/edit', array('uses' => 'AdminsUsersController@editProfile'));
    Route::get('profile/password', array('uses' => 'AdminsUsersController@password'));
    Route::post('profile/password', array('uses' => 'AdminsUsersController@editPassword'));

    if (routeLoad($prefix . 'banners', $req_path)) {
        Route::get('banners', 'AdminsBannersController@getIndex');
        Route::get('banners/add', 'AdminsBannersController@getAdd');
        Route::post('banners/add', 'AdminsBannersController@postAdd');
        Route::get('banners/{id}', 'AdminsBannersController@getEdit');
        Route::post('banners', 'AdminsBannersController@postEdit');
    }

    if (routeLoad($prefix . 'contact', $req_path)) {
        Route::get('contact', 'AdminsContactController@Index');
    }

    if (routeLoad($prefix . 'news', $req_path)) {
        Route::get('news', 'AdminsNewsController@getIndex');
        Route::get('news/add', 'AdminsNewsController@getAdd');
        Route::get('news/tags', 'AdminsNewsController@getTags');
        Route::post('news/uploads', 'AdminsNewsController@postUploads');
        Route::get('news/deleteimages', 'AdminsNewsController@getDeleteImage');
        Route::post('news/add', 'AdminsNewsController@postAdd');
        Route::get('news/{id}', 'AdminsNewsController@getEdit');
        Route::post('news', 'AdminsNewsController@postEdit');
    }

    if (routeLoad($prefix . 'members', $req_path)) {
        Route::get('members', 'AdminsMembersController@getIndex');
        Route::get('members/add', 'AdminsMembersController@getAdd');
        Route::post('members/add', 'AdminsMembersController@postAdd');
        Route::get('members/{id}', 'AdminsMembersController@getEdit');
        Route::post('members', 'AdminsMembersController@postEdit');
    }

    if (routeLoad($prefix . 'socials', $req_path)) {
        Route::get('socials', 'AdminsSocialsController@getIndex');
    }

    Route::get('/', 'AdminsDashboardController@Index');
});

Route::filter('auth', function () {
    if (Auth::guest()) {
        return Redirect::to('login');
    }

});
