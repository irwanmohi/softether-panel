<?php

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {

    Route::get('reseller-setting', 'ResellerSettingController' );

});

