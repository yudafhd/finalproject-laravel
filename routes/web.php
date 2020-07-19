<?php

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/', 'General\HomeController@index')->name('home');

// Midtrans Notification
   Route::group(['prefix' => 'notification'], function () {
    Route::post('/handling', 'General\MidtransNotificationController@index')->name('notification.handling');
    Route::get('/handling/test', 'General\MidtransNotificationController@test')->name('notification.handling.test');
});

Route::middleware(['auth'])->group(function () {
    // User general
    Route::group(['prefix' => 'general'], function () {
        Route::get('/', 'General\GeneralController@index')->name('general');
        Route::post('/', 'General\GeneralController@saveLinks')->name('general.save.links');
        Route::get('/dashboard', 'General\DashboardController@index')->name('general.dashboard');
        Route::get('/theme', 'General\ThemeController@index')->name('general.theme');
        Route::get('/account', 'General\AccountController@index')->name('account');
        Route::get('/transaction', 'General\AccountController@transaction')->name('transaction');
        Route::get('/account/upgrade', 'General\MidtransTransactionController@upgradeAccountViews')->name('account.upgrade');
        Route::post('/account/upgrade', 'General\MidtransTransactionController@upgradeAccount')->name('account.upgrade.agreement');
    });
    
    // Order views
    Route::group(['prefix' => 'order'], function () {
        Route::get('/finish', 'General\OrderController@finish')->name('order.finish');
        Route::get('/error', 'General\OrderController@error')->name('order.error');
    });

    // User office
    Route::group(['prefix' => 'backoffice'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::group(['prefix' => 'user'], function () {
            Route::get('/create', 'UserController@create')->name('user.create');
            Route::post('/store', 'UserController@store')->name('user.store');
            Route::get('/{type}', 'UserController@index')->name('user.list');
            Route::get('/update/{id}', 'UserController@update')->name('user.update');
            Route::get('/delete/{id}', 'UserController@delete')->name('user.delete');
            Route::post('/storeUpdate', 'UserController@storeUpdate')->name('user.store.update');
            Route::post('/storeUpdateProfile', 'UserController@storeUpdateProfile')->name('user.store.update.profile');
            Route::get('/profile', 'UserController@profile')->name('user.profile');
        });

        //Roles office
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
    });
});

Route::get('/{username}', 'General\HomeController@usernameProfile')->name('username');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');