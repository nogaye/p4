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

Route::get('/', function()
{
    return View::make('index');
});




/**
* User
* (Explicit Routing)
*/
Route::get('/signup','UserController@getSignup' );
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', 'UserController@postSignup' );
Route::post('/login', 'UserController@postLogin' );
Route::get('/logout', 'UserController@getLogout' );


/**
* Mood
* (Explicit Routing)
*/
Route::get('/mymood', 'MoodController@getUserMoods');
Route::get('/mood', 'MoodController@getMoods');
Route::post('/mood/create', 'MoodController@postCreate');

Route::get('/mood/edit/{id}', 'MoodController@getEdit');
Route::post('/mood/edit', 'MoodController@postEdit');
Route::get('/mood/delete/{id}', 'MoodController@getDelete');


/**
* Debug
*/
Route::get('debug', 'DebugController@getIndex');








