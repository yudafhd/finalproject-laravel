<?php

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/', 'General\HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contactus', 'General\ContactUsController@create')->name('contactus');
Route::post('/contactus', 'General\ContactUsController@store')->name('contactus.store');

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
        Route::post('/theme/update', 'General\ThemeController@themeUpdate')->name('general.theme.update');
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
    Route::name('admin.')->group(function () {
        Route::get('/login', 'AuthAdmin\LoginAdminController@showLoginForm')->name('login');
        Route::post('/login', 'AuthAdmin\LoginAdminController@login')->name('login.auth');
        Route::middleware(['auth:admin'])->group(function () {
            // Auth backoffice
            Route::post('/logout', 'AuthAdmin\LoginAdminController@logout')->name('logout.auth');

            // User backoffice
            Route::get('/', 'Backoffice\DashboardController@index')->name('dashboard');
            Route::get('/dashboard', 'Backoffice\DashboardController@index')->name('dashboard');
            Route::group(['prefix' => 'user'], function () {
                Route::get('/profile', 'Backoffice\UserController@profile')->name('user.profile');
                Route::get('/create', 'Backoffice\UserController@create')->name('user.create');
                Route::post('/store', 'Backoffice\UserController@store')->name('user.store');
                Route::get('/{type}', 'Backoffice\UserController@index')->name('user.list');
                Route::get('/update/{id}', 'Backoffice\UserController@update')->name('user.update');
                Route::get('/delete/{id}', 'Backoffice\UserController@delete')->name('user.delete');
                Route::post('/storeUpdate', 'Backoffice\UserController@storeUpdate')->name('user.store.update');
                Route::post('/storeGeneralUpdate', 'Backoffice\UserController@storeGeneralUpdate')->name('user.general.store.update');
                Route::post('/storeUpdateProfile', 'Backoffice\UserController@storeUpdateProfile')->name('user.store.update.profile');
            });

            //Roles backoffice
            Route::group(['prefix' => 'setting'], function () {
                Route::get('/roles', 'Backoffice\SettingController@roleList')->name('role.list');
                Route::get('/roles/create', 'Backoffice\SettingController@createRole')->name('role.create');
                Route::post('/roles/store', 'Backoffice\SettingController@storeRole')->name('role.store');
                Route::get('/roles/delete/{id}', 'Backoffice\SettingController@deleteRole')->name('role.delete');
                Route::get('/roles/update/{id}', 'Backoffice\SettingController@updateRole')->name('role.update');
                Route::post('/roles/storeUpdate', 'Backoffice\SettingController@storeUpdateRole')->name('role.store.update');
                Route::get('/permissions', 'Backoffice\SettingController@permissionList')->name('permission.list');
                Route::get('/permissions/create', 'Backoffice\SettingController@createPermission')->name('permission.create');
                Route::post('/permissions/store', 'Backoffice\SettingController@storePermission')->name('permission.store');
                Route::get('/permissions/delete/{name}', 'Backoffice\SettingController@deletePermission')->name('permission.delete');
                Route::get('/permissions/update/{id}', 'Backoffice\SettingController@updatePermission')->name('permission.update');
                Route::post('/permissions/storeUpdate', 'Backoffice\SettingController@storeUpdatePermission')->name('permission.store.update');
            });

            //Product backoffice
            Route::resource('product', 'Backoffice\ProductController');

            //Theme backoffice
            Route::resource('theme', 'Backoffice\ThemeController');

            //Link backoffice
            Route::resource('link', 'Backoffice\LinkController');

            //Transaction backoffice
            Route::resource('transaction', 'Backoffice\TransactionController');
        });
    });
});

Route::get('/{username}', 'General\UsernameController@index')->name('username');