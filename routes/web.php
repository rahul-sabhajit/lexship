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

Auth::Routes();
Route::get('/', [ 'as' => 'login', 'uses' => 'App\AppController@login']);
Route::get('/login', [ 'as' => 'login', 'uses' => 'App\AppController@login']);
Route::get('/register', 'App\AppController@register');
Route::post('/loginData', 'App\AppController@loginPost');
Route::post('/registerData', 'App\AppController@registerPost');
Route::group(['middleware' => ['web', 'auth:CustomAuth']], function () {

    Route::get('/home', [ 'as' => 'home', 'uses' => 'App\AppMainController@package']);
    Route::get('/logout', [ 'as' => 'logout', 'uses' => 'App\AppController@logout']);
    Route::get('/package', [ 'as' => 'lcm', 'uses' => 'App\AppMainController@package']);
    Route::get('/package_single/{id}', [ 'as' => 'package_single', 'uses' => 'App\AppMainController@package_single']);
    Route::get('/export', [ 'as' => 'export', 'uses' => 'App\AppMainController@export']);
    Route::post('/updateStatus', [ 'as' => 'updateStatus', 'uses' => 'App\AppMainController@updateStatus']);
    Route::get('/userlist', [ 'as' => 'userlist', 'uses' => 'App\AppMainController@usershow']);


});

//Route::get('/home', 'App\AppMainController@home');

