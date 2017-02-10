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

// Main App
Route::get('/', 'Application\IndexController@index');
Route::get('/getTrack', 'Application\IndexController@getTrack');
Route::get('/second', 'Application\IndexController@index2');

// Ajax
Route::get('/soundCloudUrl', 'SoundEngine\SoundCloudController@getClientId');