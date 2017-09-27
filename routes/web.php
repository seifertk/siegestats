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

Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

// Route::get('/search', 'PlayerController@showSearch');
Route::get('/player/{id}', 'PlayerController@show')->name('profile');
Route::post('/search', 'PlayerController@search')->name('search');

// Versions Page Route
Route::get('/versions', function() {
    return view('versions');
});