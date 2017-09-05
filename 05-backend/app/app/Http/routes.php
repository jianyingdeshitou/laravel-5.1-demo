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

Route::group(['namespace' => 'Backend', 'prefix' => 'backend'], function() {
    get('/', function () {
        return 'welcome';
    });

    get('/login', 'Auth\AuthController@getLogin');
});
