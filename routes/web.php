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
Route::get('/', [ 'as' => 'login', 'uses' => 'App\AppController@login'])->middleware('guest');
Route::get('/login', [ 'as' => 'login', 'uses' => 'App\AppController@login'])->middleware('guest');;
Route::get('/register', 'App\AppController@register')->middleware('guest');;
Route::post('/loginData', 'App\AppController@loginPost');
Route::post('/registerData', 'App\AppController@registerPost');
Route::group(['middleware' => ['web', 'auth:CustomAuth']], function () {

    Route::get('/home', [ 'as' => 'home', 'uses' => 'App\AppMainController@showcalulator']);
    Route::get('/logout', [ 'as' => 'logout', 'uses' => 'App\AppController@logout']);
    Route::get('/lcm', [ 'as' => 'lcm', 'uses' => 'App\AppMainController@showcalulator']);
    Route::post('/lcm', [ 'as' => 'lcm', 'uses' => 'App\AppMainController@calculate']);
    Route::get('/userlist', [ 'as' => 'userlist', 'uses' => 'App\AppMainController@usershow']);
    Route::get('/lcmhistory', [ 'as' => 'lcmhistory', 'uses' => 'App\AppMainController@lcmcalculated']);

});

//Route::get('/home', 'App\AppMainController@home');

