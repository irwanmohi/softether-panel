<?php

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {

    Route::get('reseller-setting', 'ResellerSettingController' );

});

Route::resource('resellers', ResellerController::class, ['as' => 'reseller-plugin']);

