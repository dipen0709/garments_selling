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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//echo 'APi route'; die;
Route::group([
    'prefix' => 'user/'
], function ($router) {
    Route::post('login', 'ApiUserController@login');
    Route::post('registration', 'ApiUserController@registration');
    Route::get('validate/{token}', 'ApiUserController@validateUser');
    Route::post('forgotpassword', 'ApiUserController@forgotPassword');
    Route::get('resetpassword/{token}', 'ApiUserController@resetPassword');
    Route::post('updatepassword', 'ApiUserController@updatePassword')->name('updatepassword');
    Route::post('updateprofile', 'ApiUserController@updateProfile');
    Route::post('sociallogin', 'ApiUserController@socialLogin');
    Route::post('quetionary', 'ApiUserController@getQuetionary');
    Route::post('categorylist', 'ApiUserController@categoryList');
});