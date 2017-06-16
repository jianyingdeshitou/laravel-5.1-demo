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
    return redirect('cats');
});

// GET /cats
Route::get('cats', function() {
    return 'All cats';
});

// GET /cats/{id}
Route::get('cats/{id}', function($id) {
    return sprintf('Cat #%d', $id);
})->where('id', '[0-9]+');

