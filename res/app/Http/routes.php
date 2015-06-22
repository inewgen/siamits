<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('images', 'HomeController@index');

// User images
Route::get('/image', 'ImageController@getImage');
Route::get('/image/{user_id}', 'ImageController@getImage');
Route::get('/image/{user_id}/{code}', 'ImageController@getImage');
Route::get('/image/{user_id}/{code}/{extension}', 'ImageController@getImage');
Route::get('/image/{user_id}/{code}/{extension}/{w}', 'ImageController@getImage');
Route::get('/image/{user_id}/{code}/{extension}/{w}/{h}', 'ImageController@getImage');
Route::get('/image/{user_id}/{code}/{extension}/{w}/{h}/{name}', 'ImageController@getImage');// User images

Route::get('/image2', 'ImageController@getImage2');
Route::get('/image2/{user_id}', 'ImageController@getImage2');
Route::get('/image2/{user_id}/{code}', 'ImageController@getImage2');
Route::get('/image2/{user_id}/{code}/{extension}', 'ImageController@getImage2');
Route::get('/image2/{user_id}/{code}/{extension}/{w}', 'ImageController@getImage2');
Route::get('/image2/{user_id}/{code}/{extension}/{w}/{h}', 'ImageController@getImage2');
Route::get('/image2/{user_id}/{code}/{extension}/{w}/{h}/{name}', 'ImageController@getImage2');

// Web images
Route::get('/img', 'ImageController@getImg');
Route::get('/img/{user_id}', 'ImageController@getImg');
Route::get('/img/{user_id}/{code}', 'ImageController@getImg');
Route::get('/img/{user_id}/{code}/{extension}', 'ImageController@getImg');
Route::get('/img/{user_id}/{code}/{extension}/{w}', 'ImageController@getImg');
Route::get('/img/{user_id}/{code}/{extension}/{w}/{h}', 'ImageController@getImg');
Route::get('/img/{user_id}/{code}/{extension}/{w}/{h}/{name}', 'ImageController@getImg');
