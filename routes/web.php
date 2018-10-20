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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/service', 'PagesController@service');

Route::resource('posts','PostsController');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social',"google|facebook|twitter|github|linkedin");
Route::get('/login/{social}/redirect/callback', 'Auth\LoginController@handleProviderCallback')->where('social',"google|facebook|twitter|github|linkedin");
