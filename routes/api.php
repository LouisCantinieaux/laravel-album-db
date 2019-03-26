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

Route::get('/albums', 'AlbumsController@all')->name('albums.all');

Route ::post('/albums', 'AlbumsController@store')->name('albums.store');

Route::get('/albums/{albums}', 'AlbumsController@show')->name('albums.show');

Route::put('/albums/{albums}', 'AlbumsController@update')->name('albums.update');

Route::delete('/albums/{albums}', 'AlbumsController@destroy')->name('albums.destroy');
