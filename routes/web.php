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
    // $url = "https://raw.githubusercontent.com/jupiter9381/pickadove/038baae5a7e6548f9f45a5373fe1b48b04920d16/frontend/src/app/pages/profile-browser/profile-browser.component.html";
    // $file_get_content = file_get_contents($url);
    // Storage::disk('s3')->put('file.txt', $file_get_content);
    // return view('fileupload');
});

Route::post('upload', function(){
  //Storage::disk('s3')->put('file.txt', $fileContent);
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
Route::post('/monitors/notification', 'MonitorController@checkNotification');
Route::post('/monitors/checkedNotification', 'MonitorController@checkedNotification');
Route::post('/monitors/emailCheck', 'MonitorController@emailCheck');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
