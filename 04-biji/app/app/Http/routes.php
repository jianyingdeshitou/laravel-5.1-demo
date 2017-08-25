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


Route::group(['namespace' => 'Auth'], function() {
    //登录、注册、退出路由
    get('auth/login','AuthController@getLogin');
    post('auth/login','AuthController@postLogin');

    get('auth/register','AuthController@getRegister');
    post('auth/register','AuthController@postRegister');

    get('auth/logout','AuthController@getLogout');
});

Route::group(['namespace' => 'Biji', 'middleware' => 'auth'], function(){
    resource('/biji','BijiController');
});

