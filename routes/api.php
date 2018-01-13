<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/v1');
});

Route::group(['prefix' => 'v1'], function() {

    Route::get('/', function () {
        return redirect('/v1/swagger.json');
    });

    Route::get('swagger.json', function() {
        return response(view('swagger', ['host' => parse_url(config('app.url'), PHP_URL_HOST)]), 200, ['Content-Type' => 'application/json']);
    });

    Route::get('archival-images', 'ArchivalImageController@index');
    Route::get('archival-images/{id}', 'ArchivalImageController@show');

});
