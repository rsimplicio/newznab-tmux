<?php

/*
|--------------------------------------------------------------------------
| RSS Routes
|--------------------------------------------------------------------------
|
| RSS feed routes
|
*/

use App\Http\Controllers\RssController;

Route::group(['guard' => 'rss', 'middleware' => ['auth:api']], function () {
    Route::get('mymovies', [RssController::class, 'myMoviesRss']);
    Route::post('mymovies', [RssController::class, 'myMoviesRss']);
    Route::get('myshows', [RssController::class, 'myShowsRss']);
    Route::post('myshows', [RssController::class, 'myShowsRss']);
    Route::get('full-feed', [RssController::class, 'fullFeedRss']);
    Route::post('full-feed', [RssController::class, 'fullFeedRss']);
    Route::get('cart', [RssController::class, 'cartRss']);
    Route::post('cart', [RssController::class, 'cartRss']);
    Route::get('category', [RssController::class, 'categoryFeedRss']);
    Route::post('category', [RssController::class, 'categoryFeedRss']);
});
