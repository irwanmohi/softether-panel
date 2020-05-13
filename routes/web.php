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

Route::get('/', DashboardController::class)->middleware('auth');

Auth::routes();

Route::group(['prefix' => 'modal'], function() {

    Route::resource('settings', SettingController::class);

});


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::resource('plugins', PluginController::class);
    Route::apiResource('plugin-install', PluginInstallController::class);
    Route::post('plugin-install/upload-plugin-file', 'PluginInstallController@uploadPluginFile')->name('plugin-install.uploadPluginFile');
    Route::post('plugin-install/execute-installer', 'PluginInstallController@executeInstaller')->name('plugin-install.executeInstaller');

    Route::resource('servers', ServerController::class);

    Route::group(['as' => 'servers.server_setup.', 'layout' => 'layouts.master', 'section' => 'content'], function() {
        Route::livewire('servers/{id}/select-software', 'select-server-software')->name('select-software');
        Route::livewire('servers/{id}/setup/{software}', 'setup-server')->name('setup-server');
    });

});

Route::group(['prefix' => 'scripts', 'middleware' => 'api'], function() {
    Route::any('installer/{id}', ServerScriptInstallerController::class)->name('scripts.installer');
    Route::any('server-install/hooks/{payload}', ServerScriptInstallerHookController::class)->name('scripts.server-install.hooks');
    Route::any('server-install/update/{payload}', ServerScriptInstallerUpdateController::class)->name('scripts.server-install.update');
});
