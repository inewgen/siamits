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

$req_path = Request::path();
$prefix = '';

Route::get('login', array('uses' => 'UsersController@login'));
Route::post('login', array('uses' => 'UsersController@postLogin'));
Route::get('logout',array('as'=>'logout','uses'=>'AuthController@getLoggedOut'));

Route::get('fbauth/{auth?}',array('as'=>'facebookAuth','uses'=>'AuthController@getFacebookLogin'));
Route::get('gauth/{auth?}',array('as'=>'googleAuth','uses'=>'AuthController@getGoogleLogin'));

Route::get('register/verify', array('uses' => 'UsersController@verify'));
Route::get('register/verify/sendmail', array('uses' => 'UsersController@sendMailVerify'));
Route::get('register', array('uses' => 'UsersController@register'));
Route::post('register', array('uses' => 'UsersController@postRegister'));

Route::get('checkmail', array('uses' => 'UsersController@checkmail'));
Route::get('mail/sendmail', array('uses' => 'MailController@sendMail'));

Route::post('images/uploads', 'ImagesController@uploads');
Route::get('images/delete', 'ImagesController@getDeleteImage');

Route::get('forgot', array('uses' => 'UsersController@forgot'));
Route::post('forgot', array('uses' => 'UsersController@postForgot'));
Route::get('forgot/password', array('uses' => 'UsersController@setPassword'));
Route::post('forgot/password', array('uses' => 'UsersController@postForgotPassword'));

Route::get('tags/check', 'TagsController@checkTags');

Route::group(array('before' => 'auth'), function () {
    $prefix = '';
    $req_path = Request::path();

    Route::get('profile', array('uses' => 'UsersController@profile'));
    Route::post('profile/edit', array('uses' => 'UsersController@editProfile'));
    Route::get('profile/password', array('uses' => 'UsersController@password'));
    Route::post('profile/password', array('uses' => 'UsersController@editPassword'));

    if (routeLoad($prefix . 'banners', $req_path)) {
        Route::get('banners', 'BannersController@getIndex');
        Route::get('banners/add', 'BannersController@getAdd');
        Route::post('banners/add', 'BannersController@postAdd');
        Route::get('banners/{id}', 'BannersController@getEdit');
        Route::post('banners', 'BannersController@postEdit');
    }

    if (routeLoad($prefix . 'contact', $req_path)) {
        Route::get('contact', 'ContactController@Index');
    }

    if (routeLoad($prefix . 'news', $req_path)) {
        Route::get('news', 'NewsController@getIndex');
        Route::get('news/add', 'NewsController@getAdd');
        Route::post('news/uploads', 'NewsController@postUploads');
        Route::post('news/add', 'NewsController@postAdd');
        Route::get('news/{id}', 'NewsController@getEdit');
        Route::post('news', 'NewsController@postEdit');
    }

    if (routeLoad($prefix . 'members', $req_path)) {
        Route::get('members', 'MembersController@getIndex');
        Route::get('members/add', 'MembersController@getAdd');
        Route::post('members/add', 'MembersController@postAdd');
        Route::get('members/{id}', 'MembersController@getEdit');
        Route::post('members', 'MembersController@postEdit');
    }

    if (routeLoad($prefix . 'socials', $req_path)) {
        Route::get('socials', 'SocialsController@getIndex');
    }

    Route::get('/', 'DashboardController@Index');
});

Route::filter('auth', function () {
    if (!checkLogin()) {
        return Redirect::to('login');
    }

});
