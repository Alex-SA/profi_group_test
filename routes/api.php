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


Route::group(['middleware' => ['web']], function () {

    Route::get('auth/social/{social}', 'Auth\SocialController@redirectToSocial');
    Route::get('auth/social/{social}/callback', 'Auth\SocialController@handleSocialCallback');

});



Route::post('auth/signup', 'Auth\ApiController@register');
Route::post('auth/login', 'Auth\ApiController@login');

Route::get('tournaments', 'TournamentsController@index');
Route::post('tournament/create', 'TournamentsController@create');

Route::get('bets', 'BetsController@index');
Route::get('bets/user/{user}', 'BetsController@show');
Route::post('bet/create', 'BetsController@create');

