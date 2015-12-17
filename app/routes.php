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
    Route::get('contact/add', 'ContactController@postAddContact');
}

if (routeLoad($prefix . 'clips', $req_path)) {
    Route::get('clips', 'ClipsController@Index');
}

if (routeLoad($prefix . 'comments', $req_path)) {
    Route::get('comments/ajax', 'CommentsController@ajaxComments');
}

if (routeLoad($prefix . 'weather', $req_path)) {
    Route::get('weather/ajax', 'DashboardController@ajaxWeather');
}

if (routeLoad($prefix . 'members', $req_path)) {
    Route::get('members', 'MembersController@Index');
}

if (routeLoad($prefix . 'news', $req_path)) {
    Route::get('news', 'NewsController@Index');
    Route::get('news/category', 'NewsController@listCategory');
    Route::get('news/{id}', 'NewsController@Show');
    Route::get('news/category/{id}', 'NewsController@listNewsCategory');
    Route::post('news/addcomment', 'NewsController@postAddComment');
    Route::get('news/update/ajax', 'NewsController@ajaxUpdateNews');
    Route::get('news/update/stat', 'NewsController@ajaxUpdateNewsStat');
}

if (routeLoad($prefix . 'pages', $req_path)) {
    Route::get('pages', 'PagesController@Index');
    Route::get('pages/category', 'PagesController@listCategory');
    Route::get('pages/{id}', 'PagesController@Show');
    Route::get('pages/category/{id}', 'PagesController@listPagesCategory');
    Route::post('pages/addcomment', 'PagesController@postAddComment');
    Route::get('pages/update/ajax', 'PagesController@ajaxUpdatPages');
    Route::get('pages/update/stat', 'PagesController@ajaxUpdatePagesStat');
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
