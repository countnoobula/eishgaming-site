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

Route::get('/', 'PageController@index');

Route::get('/about', 'PageController@about');

Route::get('/servers', 'PageController@servers');

Route::group([ 'prefix' => '/feed', ], function () {
    Route::get('/', 'PageController@feed');
});

Route::group([ 'prefix' => '/auth', 'namespace' => 'Auth', ], function () {
    Route::get('/login', 'AuthController@getLogin');
    Route::post('/login', 'AuthController@postLogin');
    Route::get('/logout', 'AuthController@getLogout');
    Route::get('/register', 'Auth\AuthController@getRegister');
    Route::post('/register', 'Auth\AuthController@postRegister');
});

Route::group([ 'prefix' => '/profile', ], function () {
    Route::get('/', 'ProfileController@index');
    Route::get('/edit', 'ProfileController@getEdit');
    Route::post('/edit', 'ProfileController@postEdit');
});

Route::model('user', '\App\Models\User');

Route::get('/p/{user}', 'ProfileController@user');

Route::group([ 'prefix' => '/c', ], function () {
    //Route::get('/', 'ClanController@index');
    Route::get('/create', 'ClanController@getCreate');
    Route::post('/create', 'ClanController@postCreate');
    Route::get('/{clan}', 'ClanController@getView');
});

Route::group([ 'prefix' => '/thirdparty', 'namespace' => 'Thirdparty', ], function () {
    Route::group([ 'prefix' => '/facebook' ], function () {
        Route::get('/auth', 'Facebook@getAuthenticate');
        Route::get('/', 'Facebook@index');
    });
    
    Route::group([ 'prefix' => '/steam' ], function () {
        Route::get('/auth', 'Steam@getAuthenticate');
        Route::get('/', 'Steam@index');
    });
});
