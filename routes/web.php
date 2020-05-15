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
Route::get('/', 'OkpController@index')->name('dashboard');
Route::get('/dashboard', 'OkpController@index')->name('dashboard');


Route::resource('okp', 'OkpController');
Route::resource('kegiatan', 'KegiatanController');
Route::resource('anggota', 'AnggotaController');
Route::resource('bidang', 'BidangController');


// User
Route::group(['prefix' => 'user'], function () {
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/store', 'UserController@store')->name('user.store');
    Route::get('/', 'UserController@index')->name('user.list');
    Route::get('/update/{id}', 'UserController@update')->name('user.update');
    Route::get('/delete/{id}', 'UserController@delete')->name('user.delete');
    Route::post('/storeUpdate', 'UserController@storeUpdate')->name('user.store.update');
});

//Roles
Route::group(['prefix' => 'setting'], function () {
    Route::get('/roles', 'SettingController@roleList')->name('role.list');
    Route::get('/roles/create', 'SettingController@createRole')->name('role.create');
    Route::post('/roles/store', 'SettingController@storeRole')->name('role.store');
    Route::get('/roles/delete/{name}', 'SettingController@deleteRole')->name('role.delete');
    Route::get('/roles/update/{id}', 'SettingController@updateRole')->name('role.update');
    Route::post('/roles/storeUpdate', 'SettingController@storeUpdateRole')->name('role.store.update');

    Route::get('/permissions', 'SettingController@permissionList')->name('permission.list');
    Route::get('/permissions/create', 'SettingController@createPermission')->name('permission.create');
    Route::post('/permissions/store', 'SettingController@storePermission')->name('permission.store');
    Route::get('/permissions/delete/{name}', 'SettingController@deletePermission')->name('permission.delete');
    Route::get('/permissions/update/{id}', 'SettingController@updatePermission')->name('permission.update');
    Route::post('/permissions/storeUpdate', 'SettingController@storeUpdatePermission')->name('permission.store.update');
});



// Route::resource('customers', 'CustomerController');