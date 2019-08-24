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

Route::get('/', 'HonestIpsumController@generate')->name('honest-ipsum.get');
Route::post('/', 'HonestIpsumController@api')->name('honest-ipsum.post');
Route::get('/api', 'HonestIpsumController@api')->name('api.honest-ipsum.get');
