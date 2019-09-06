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
    //return view('fileupload');
});

Route::post('upload', function(){
  request()->file('file')->store(
    '',
    's3'
  );
})->name('upload');
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/profile', 'HomeController@profile');
Route::post('/profile/update', 'HomeController@updateProfile');

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'HomeController@logut');

Route::get('/monitors/create', 'MonitorController@view');
Route::get('/monitors', 'MonitorController@index');
Route::get('/monitors/search/{id}', 'MonitorController@search');

Route::post('/monitors/add_monitor', 'MonitorController@add_monitor');
Route::post('/monitors/search_code', 'MonitorController@search_code');

Route::post('/monitors/check', 'MonitorController@checkMonitors');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
