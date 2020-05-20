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

Route::prefix('softether')->as('softether.')->group(function() {
    Route::get('/', 'SoftetherController@index');

    Route::resource('accounts', AccountController::class);
    Route::get('accounts/{server}/create_account', 'AccountController@createAccount')->name('accounts.create_account');

    Route::get('downloads/openvpn/{payload}', DownloadOpenvpnConfigController::class)->name('downloads.openvpn');
});
