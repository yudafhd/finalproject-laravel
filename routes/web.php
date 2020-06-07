<?php

Auth::routes();
Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');



Route::middleware(['auth'])->group(function () {

    // User
    Route::group(['prefix' => 'user'], function () {
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/store', 'UserController@store')->name('user.store');
        Route::get('/{type}', 'UserController@index')->name('user.list');
        Route::get('/update/{id}', 'UserController@update')->name('user.update');
        Route::get('/delete/{id}', 'UserController@delete')->name('user.delete');
        Route::post('/storeUpdate', 'UserController@storeUpdate')->name('user.store.update');
        Route::post('/storeUpdateProfile', 'UserController@storeUpdateProfile')->name('user.store.update.profile');
    });

    Route::get('/profile', 'UserController@profile')->name('user.profile');

    // RPK
    Route::resource('ewarung', 'RpkController');

    // RPK
    Route::group(['prefix' => 'ewarung'], function () {
        Route::put('/verify/{rpk}', 'RpkController@verify')->name('ewarung.verify');
        Route::put('/disabled/{rpk}', 'RpkController@disable')->name('ewarung.disable');
        Route::put('/reject/{rpk}', 'RpkController@reject')->name('ewarung.reject');
        Route::put('/active/{rpk}', 'RpkController@active')->name('ewarung.actived');
    });

    // Stock
    Route::resource('stock', 'StockController');

    // Item
    Route::resource('item', 'ItemController');

    // Pemesanan
    Route::resource('pemesanan', 'PemesananController');
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