<?php

use App\Article;

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

Route::get('/', [ 'as' => 'index', function () {
    $articles = Article::orderBy('created_at', 'desc')->paginate(4);
    return view('pages.index')
        ->with([ 'newsArticles' => $articles ]);
}]);

Route::get('/about', [ 'as' => 'about', function () {
    return view('pages.about');
}]);

Route::group([ 'prefix' => '/feed', 'as' => 'feed/' ], function () {
    Route::get('/', [ 'as' => 'landing', function () {
        return view('pages.feed.landing');
    }]);
});
