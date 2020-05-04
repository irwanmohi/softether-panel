<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layouts.master');
});

Auth::routes();

Route::group(['prefix' => 'modal'], function() {

    Route::resource('settings', SettingController::class);

});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::resource('plugins', PluginController::class);
    Route::apiResource('plugin-install', PluginInstallController::class);
    Route::post('plugin-install/upload-plugin-file', 'PluginInstallController@uploadPluginFile')->name('plugin-install.uploadPluginFile');
    Route::post('plugin-install/execute-installer', 'PluginInstallController@executeInstaller')->name('plugin-install.executeInstaller');
});
