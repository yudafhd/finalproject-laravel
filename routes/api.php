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
Route::get('/ewarong', 'Api\EwarongController@allEwarong');
Route::get('/allvillagesanddistrics', 'Api\EwarongController@allVillagesAndDistrics');
Route::get('/allitems', 'Api\EwarongController@allItems');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/home', 'Api\HomeTeacherController@index');
    Route::get('/absenteeism', 'Api\AbsenteeismTeacherController@index');
    Route::post('/absenteeism', 'Api\AbsenteeismTeacherController@submitAbsent');
    Route::get('/teacherprofile', 'Api\ProfileController@index');
    Route::get('/home_parent', 'Api\HomeParentController@index');
    Route::get('/home_parent_all_recap', 'Api\HomeParentController@homeParentAllRecap');
    Route::get('/studentprofile', 'Api\ProfileController@index');
});