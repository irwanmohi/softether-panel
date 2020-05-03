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

if( ! function_exists('boolean_to_word') ) {

    function boolean_to_word($value) {
        return ($value) ? 'YES' : 'NO';
    }
}

if( ! function_exists('boolean_to_label') ) {

    function boolean_to_label($value) {
        return ($value)
            ? '<span class="label label-success">YES</span>'
            : '<span class="label label-danger">NO</span>';
    }
}
