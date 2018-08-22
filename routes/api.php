<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * authentication routes for social networks
 */
Route::group(['middleware' => ['web']], function () {

    Route::get('auth/social/{social}', 'Auth\SocialController@redirectToSocial');
    Route::get('auth/social/{social}/callback', 'Auth\SocialController@handleSocialCallback');

});

/**
 * authentication routes for credential
 */
Route::post('auth/signup', 'Auth\ApiController@register');
Route::post('auth/login', 'Auth\ApiController@login');

/**
 * routes for tournaments
 */
Route::get('tournaments', 'TournamentsController@index');
Route::post('tournament/create', 'TournamentsController@create');

/**
 * routes for bets
 */
Route::get('bets', 'BetsController@index');
Route::get('bets/user/{user}', 'BetsController@show');
Route::post('bet/create', 'BetsController@create');

