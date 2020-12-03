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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Api\AuthController@login');
Route::post('/register', 'Api\AuthController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/profile', 'Api\ProfileController@index');
    Route::post('/teacher/home', 'Api\HomeTeacherController@index');
    Route::post('/teacher/absenteeism', 'Api\AbsenteeismTeacherController@index');
    Route::post('/teacher/absenteeism/submit', 'Api\AbsenteeismTeacherController@submitAbsent');
    Route::get('/parent/home', 'Api\HomeParentController@index');
    Route::get('/parent/allrecapitulation', 'Api\HomeParentController@homeParentAllRecap');
});
