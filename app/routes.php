<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/generate', 'RepportController@generate');
Route::get('/','IgnoreController@index');
Route::get('/ignore/add', 'IgnoreController@add');
Route::post('/ignore/add', 'IgnoreController@store');
Route::delete('/','IgnoreController@delete');
//Route::get('/test', 'RepportController@test');