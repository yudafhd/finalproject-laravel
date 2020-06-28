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
Route::get('/users', 'UserController@index')->name('user');
Route::get('/booking/cancel', 'BookingController@cancelList')->name('booking.cancel');
Route::get('/keuangan', 'PembayaranController@index')->name('pembayaran.list');

Route::resource('customers', 'CustomerController');
Route::resource('package', 'BookingPackagesController');
Route::resource('booking', 'BookingController');