<?php

use Illuminate\Support\Facades\Auth;

if( ! function_exists('panel_name') ) {

    function panel_name() {
        return 'SOFTETHER PANEL';
    }

}

if( ! function_exists('user') ) {

    function user() {

        return optional(Auth::user());

    }
}
