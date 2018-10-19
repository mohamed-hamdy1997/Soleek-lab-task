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

   Route::group(['middleware' => ['api']], function () {
    Route::post('auth/login', 'ApiController@login');

    Route::post('/register', 'ApiController@register');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/countries', 'ApiController@getCountries');
    });
});
