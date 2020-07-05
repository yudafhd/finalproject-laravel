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
Route::get('/ewarong', 'Api\EwarongController@allEwarong');
Route::get('/alldistrics', 'Api\EwarongController@allDistrics');
Route::get('/allvillages', 'Api\EwarongController@allVillages');
Route::get('/allitems', 'Api\EwarongController@allItems');
Route::get('/getfromradius', 'Api\EwarongController@getFromMyRadius');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/getorderbyuser', 'Api\EwarongController@getOrderByUser');
    Route::post('/orderuser', 'Api\EwarongController@orderUser');
    Route::post('/confirmorder', 'Api\EwarongController@confirmOrder');
    Route::post('/confirmewarong', 'Api\EwarongController@confirmEwarong');
    Route::get('/todaychartuser', 'Api\ReportController@todayChartUser');
    Route::get('/adminreport', 'Api\ReportController@reportAdmin');
    Route::post('/updateprofile', 'Api\ProfileController@updateProfile');
});