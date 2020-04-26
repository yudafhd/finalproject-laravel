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
    Route::post('/roles/store', 'SettingController@storeRole')->name('role.store');
    Route::get('/roles/delete/{name}', 'SettingController@deleteRole')->name('role.delete');
    Route::get('/roles/update/{id}', 'SettingController@updateRole')->name('role.update');

    Route::get('/permissions', 'SettingController@permissionList')->name('permission.list');
    Route::get('/permissions/create', 'SettingController@createPermission')->name('permission.create');
    Route::post('/permissions/store', 'SettingController@storePermission')->name('permission.store');
    Route::get('/permissions/delete/{name}', 'SettingController@deletePermission')->name('permission.delete');
    Route::get('/permissions/update/{id}', 'SettingController@updateRole')->name('permission.update');
});


// Route::resource('customers', 'CustomerController');
// Route::resource('package', 'BookingPackagesController');
// Route::resource('booking', 'BookingController');