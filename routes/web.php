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
    return view('welcome');
});

/*Route::get('groupes', function($n = null){
    return view('groupes', ['albums' => $n]);
});*/

Route::get('groupes', 'Groupes@show')->name('groupes');

Route::get('albums', 'Albums@show')->name('albums');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
