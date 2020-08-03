<?php

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/', 'General\HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

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
        Route::post('/account/update', 'General\AccountController@accountUpdate')->name('account.update');
        Route::post('/account/update/username', 'General\AccountController@accountUsername')->name('account.update.username');
    });

    // Order views
    Route::group(['prefix' => 'order'], function () {
        Route::get('/finish', 'General\OrderController@finish')->name('order.finish');
        Route::get('/error', 'General\OrderController@error')->name('order.error');
    });

});

Route::group(['prefix' => 'backoffice'], function () {
    Route::get('/login', 'AuthAdmin\LoginAdminController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginAdminController@login')->name('admin.login.auth');
    Route::middleware(['auth:admin'])->group(function () {

        // Auth backoffice
        Route::post('/logout', 'AuthAdmin\LoginAdminController@logout')->name('admin.logout.auth');

        // User backoffice
        Route::get('/', 'Backoffice\DashboardController@index')->name('admin.dashboard');
        Route::get('/dashboard', 'Backoffice\DashboardController@index')->name('admin.dashboard');
        Route::group(['prefix' => 'user'], function () {
            Route::get('/create', 'Backoffice\UserController@create')->name('admin.user.create');
            Route::post('/store', 'Backoffice\UserController@store')->name('admin.user.store');
            Route::get('/{type}', 'Backoffice\UserController@index')->name('admin.user.list');
            Route::get('/update/{id}', 'Backoffice\UserController@update')->name('admin.user.update');
            Route::get('/delete/{id}', 'Backoffice\UserController@delete')->name('admin.user.delete');
            Route::post('/storeGeneralUpdate', 'Backoffice\UserController@storeGeneralUpdate')->name('admin.user.general.store.update');
            Route::post('/storeUpdate', 'Backoffice\UserController@storeUpdate')->name('admin.user.store.update');
            Route::post('/storeUpdateProfile', 'Backoffice\UserController@storeUpdateProfile')->name('admin.user.store.update.profile');
            Route::get('/profile', 'Backoffice\UserController@profile')->name('admin.user.profile');
        });

        //Roles backoffice
        Route::group(['prefix' => 'setting'], function () {
            Route::get('/roles', 'Backoffice\SettingController@roleList')->name('admin.role.list');
            Route::get('/roles/create', 'Backoffice\SettingController@createRole')->name('admin.role.create');
            Route::post('/roles/store', 'Backoffice\SettingController@storeRole')->name('admin.role.store');
            Route::get('/roles/delete/{id}', 'Backoffice\SettingController@deleteRole')->name('admin.role.delete');
            Route::get('/roles/update/{id}', 'Backoffice\SettingController@updateRole')->name('admin.role.update');
            Route::post('/roles/storeUpdate', 'Backoffice\SettingController@storeUpdateRole')->name('admin.role.store.update');
            Route::get('/permissions', 'Backoffice\SettingController@permissionList')->name('admin.permission.list');
            Route::get('/permissions/create', 'Backoffice\SettingController@createPermission')->name('admin.permission.create');
            Route::post('/permissions/store', 'Backoffice\SettingController@storePermission')->name('admin.permission.store');
            Route::get('/permissions/delete/{name}', 'Backoffice\SettingController@deletePermission')->name('admin.permission.delete');
            Route::get('/permissions/update/{id}', 'Backoffice\SettingController@updatePermission')->name('admin.permission.update');
            Route::post('/permissions/storeUpdate', 'Backoffice\SettingController@storeUpdatePermission')->name('admin.permission.store.update');
        });

        //Product backoffice
        Route::group(['prefix' => 'product', 'as' => 'admin.product.'], function () {
            Route::resource('/', 'Backoffice\ProductController');
        });
    });
});
Route::get('/{username}', 'General\UsernameController@index')->name('username');