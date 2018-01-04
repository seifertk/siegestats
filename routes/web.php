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
Auth::routes();
// override register to provide token
Route::get('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::get('/register/{tokenString}', ['as' => 'register.create', 'uses' => 'Auth\RegisterController@createUser']);
Route::post('/register/complete', ['as' => 'register.complete', 'uses' => 'Auth\RegisterController@completeRegistration']);

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/player_home', function() {
    return view('player.player_home');
})->name('player_home');

// Versions Page Route
Route::get('/versions', function() {
    return view('versions');
})->name('versions');

Route::get('/leaderboard', function() {
    return view('leaderboard', ['players' => []]);
})->name('leaderboard');

Route::post('/leaderboard/search', 'LeaderboardController@getLeaderboard')->name('leaderboard.search');

Route::get('/player/operatorstats', 'PlayerController@operatorStats')->name('operatorstats');
Route::get('/player/{id?}', 'PlayerController@show')->name('profile');
Route::get('/search', 'PlayerController@search')->name('search');
Route::post('/search', 'PlayerController@search')->name('search');
Route::post('/player/link', 'UserController@link')->name('link');
Route::post('/player/compare', 'PlayerController@comparePlayers')->name('compare');
Route::get('/news', 'NewsController@getNews')->name('news.index');