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


Auth::routes();
Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/user/admin', 'UserController@index')->name('user.admin');

//Roles
Route::group(['prefix' => 'setting'], function () {
    Route::get('/roles', 'SettingController@roleList')->name('role.list');
    Route::get('/roles/create', 'SettingController@createRole')->name('role.create');
});


// Route::resource('customers', 'CustomerController');
// Route::resource('package', 'BookingPackagesController');
// Route::resource('booking', 'BookingController');