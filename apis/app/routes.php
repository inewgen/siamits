<?php
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

require app_path() . '/routes-func.php';
$req_path = Request::path();

if (preg_match('/\/$/', $req_path)) {
    Route::get('/', 'HomeController@index');
}

$route_conf = Config::get('route');

$prefix  = 'api/';

if (routeLoad($prefix . 'banners', $req_path, $route_conf)) {
    Route::resource($prefix . 'banners', 'BannersController');
}

if (routeLoad($prefix . 'categories', $req_path, $route_conf)) {
    Route::resource($prefix . 'categories', 'CategoriesController');
}

if (routeLoad($prefix . 'images', $req_path, $route_conf)) {
    Route::resource($prefix . 'images', 'ImagesController');
}

if (routeLoad($prefix . 'members', $req_path, $route_conf)) {
    Route::resource($prefix . 'members', 'MembersController');
}

if (routeLoad($prefix . 'navigations', $req_path, $route_conf)) {
    Route::resource($prefix . 'navigations', 'NavigationsController');
}

if (routeLoad($prefix . 'news', $req_path, $route_conf)) {
    Route::resource($prefix . 'news', 'NewsController');
}

if (routeLoad($prefix . 'tags', $req_path, $route_conf)) {
    Route::resource($prefix . 'tags', 'TagsController');
}

if (routeLoad($prefix . 'users', $req_path, $route_conf)) {
    Route::resource($prefix . 'users', 'UsersController');
}

if (preg_match('/^api$/', $req_path)) {
    Route::resource($prefix . '/', 'HomeController');
}
