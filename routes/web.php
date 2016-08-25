<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	flashy()->success('Welcome');
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('community', 'CommunityLinksController@index');
Route::post('community', 'CommunityLinksController@store');
Route::get('community/{category}', 'CommunityLinksController@index');

Route::post('votes/{link}', 'VotesController@store');
