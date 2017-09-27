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

Route::get('/player/operatorstats', 'PlayerController@operatorstats')->name('operatorstats');
Route::get('/player/{id}', 'PlayerController@show')->name('profile');
Route::post('/search', 'PlayerController@search')->name('search');
Route::post('/player/link', 'UserController@link')->name('link');