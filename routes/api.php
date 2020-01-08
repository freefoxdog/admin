<?php

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


Route::namespace('ApiAuth')->group(function(){

    Route::post('password/verification', 'ResetPasswordController@sendResetCode');
    Route::post('password/reset', 'ResetPasswordController@reset');
    Route::post('register', 'RegisterController@register')->name("register");
    Route::post('register/verification', 'RegisterController@verification');
    Route::post('login', 'LoginController@login')->name("login");
    Route::post('logout', 'LoginController@logout')->middleware('auth:api')->name("logout");

 });
Route::prefix("test")->group(function(){

    Route::get('veri', 'TestController@verification');
});
