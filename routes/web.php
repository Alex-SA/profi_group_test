<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * test client: REST API for auth through social networks
 */
Route::get('/google', function () {
    return view('forms.social.google');
});
// FB does not work without https !
Route::get('/facebook', function () {
    return view('forms.social.facebook');
});

//Route::group(['middleware' => ['web']], function () {
//    Route::get('/social', function () {
//        return view('forms.social.social');
//    });
//});


/**
 * test client: REST API for credential authentication
 */
Route::get('/signup', function () {
    return view('forms.auth.signup');
});
Route::get('/signin', function () {
    return view('forms.auth.signin');
});
Route::get('/logout', function () {
    return view('forms.auth.logout');
});

/**
 * test client: REST API for tournaments and bets
 */
Route::get('/tournaments', 'TestTournamentsAPIController@index');
Route::get('/bets', 'TestBetsAPIController@index');

Route::get('/', function () {
    return view('test_api');
});

//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');


