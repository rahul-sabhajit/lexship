<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user()->orderBy('users.id', 'DESC')->paginate(3);
});*/
Route::middleware('auth:api')->get('/user', 'Api\LcmController@userlist');
Route::middleware('auth:api')->post('/calculateLcm', 'Api\LcmController@computelcm');
Route::middleware('auth:api')->get('/method', 'Api\LcmController@algorithm');
Route::middleware('auth:api')->get('/lcmhistory', 'Api\LcmController@lcmhistory');

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
