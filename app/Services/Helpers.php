<?php

use App\Setting;
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

if( ! function_exists('setting') ) {

    function setting($key) {
        return optional(Setting::where('key', $key)->first());
    }

}

if( ! function_exists('random_color_class') ) {

    function random_color_class() {

        $classes = [
            'red', 'pink', 'purple', 'deep-purple',
            'indigo', 'blue', 'light-blue', 'cyan', 'teal',
            'green', 'light-green', 'lime', 'yellow', 'amber',
            'orange', 'deep-orange', 'brown', 'grey', 'blue-grey', 'black'
        ];

        return $classes[array_rand($classes)];
    }

}
