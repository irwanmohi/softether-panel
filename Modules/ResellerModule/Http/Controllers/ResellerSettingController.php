<?php

namespace Modules\ResellerModule\Http\Controllers;

use Str;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ResellerSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $settings = Setting::all()->filter(function($setting) {
            return Str::startsWith($setting->key, 'reseller_module');
        });

        return view('resellermodule::setting-lists', compact('settings'));

    }

}
