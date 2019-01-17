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

Route::get('/', 'PagesController@dashboard');
Route::get('/input', 'PostsController@create');
Route::get('/delete', 'PostsController@delete');
Route::get('/remove', 'PostsController@destroy');
Route::get('/changepassword', 'HomeController@showChgPassForm');
Route::get('/allreports', 'PostsController@index');
Route::post('/changePassword', 'HomeController@changePassword')->name('changePassword');
Route::resource('posts', 'PostsController');

Auth::routes();


