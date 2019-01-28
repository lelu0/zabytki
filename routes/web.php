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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard/{mode?}', 'HomeController@dashboard')->name('dashboard');
Route::get('/home/sendmsg/{id}', 'HomeController@msgForm');
Route::post('/home/sendmsg/{id}', 'HomeController@send');
Route::get('/home/moderate/{id}', 'HomeController@moderate');
Route::get('/home/moderate/done/{id}', 'HomeController@moderateDone');

Route::resource('monuments', 'MonumentController');
Route::post('/monuments/addcomment', 'MonumentController@addComment');
Route::get('/monument/confirm/{id}', 'MonumentController@confirm');
Route::post('/monument/search', 'MonumentController@search');
