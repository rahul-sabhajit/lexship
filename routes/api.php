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
Route::middleware('auth:api')->get('/user', 'Api\TrackingController@userlist');
Route::middleware('auth:api')->post('/calculateLcm', 'Api\TrackingController@computelcm');
Route::middleware('auth:api')->get('/method', 'Api\TrackingController@algorithm');
Route::middleware('auth:api')->get('/package', 'Api\TrackingController@package_details');
Route::middleware('auth:api')->post('/package_details', 'Api\TrackingController@package_single');
Route::middleware('auth:api')->post('/package_status_update', 'Api\TrackingController@updateStatus');
Route::middleware('auth:api')->get('/updateTrackingStatusTable', 'Api\TrackingController@updateTrackingStatusTable');
Route::middleware('auth:api')->get('/reportData', 'Api\TrackingController@reportData');


Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
