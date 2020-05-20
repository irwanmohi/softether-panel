<?php

namespace Modules\Softether\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DownloadOpenvpnConfigController extends Controller
{
    public function __invoke(Request $request, $payload)
    {
        try {

            $config = decrypt($payload);

        } catch(\Exception $e) {
            return abort(404);
        }

        $renderedConfig = view('softether::base-ovpn', json_decode($config, true))->render();

        return response()->streamDownload(function() use($renderedConfig) {
            echo $renderedConfig;
        }, 'client.ovpn');

    }
}
