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
    Route::get('news/category', 'NewsController@listCategory');
    Route::get('news/{id}', 'NewsController@Show');
    Route::get('news/category/{id}', 'NewsController@listNewsCategory');
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

Route::get('clear/cache', 'CacheController@clearCache');

Route::get('/', 'DashboardController@Index');
