<?php

namespace Modules\Softether\Http\Controllers;

use PhpZip\ZipFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DownloadOpenvpnConfigController extends Controller
{
    public function __invoke(Request $request, $payload)
    {
        try {

            $config = decrypt($payload);

            $passwordlessConfig = json_decode($config, true);
            $passwordConfig     = json_decode($config, true);

            $passwordConfig['AUTH_METHOD']     = 'auth-user-pass';
            $passwordlessConfig['AUTH_METHOD'] = ';auth-user-pass';

            $passwordConfig = view('softether::base-ovpn', $passwordConfig)->render();
            $passwordlessConfig = view('softether::base-ovpn', $passwordlessConfig)->render();

            $text = $this->getText();

            $zip = new ZipFile;

            $zip->addFromString('config/password-auth.ovpn', $passwordConfig);
            $zip->addFromString('config/passwordless-auth.ovpn', $passwordlessConfig);
            $zip->addFromString('signature.txt', view('softether::signature')->with('text', $text)->render());

            return response()->streamDownload(function() use($zip) {
                echo $zip->outputAsString();
            }, 'client.zip');

        } catch(\Exception $e) {
            return abort(404);
        }
    }

    protected function getText() {
        $texts = [
            '# THIS IS THE OPENVPN CONFIGURATION FILES.',
            '# YOU CAN CONNECT TO THE OPENVPN SERVER USING ANY OPENVPN CLIENT YOU FIND SUITABLE.',
            '',
            'NOTE:',
            'The config directory containing 2 files, "password-auth.ovpn" & "passwordless-auth.ovpn"',
            'if you enable the Passwordless™ on the dashboard, please use the "passwordless-auth.ovpn" file.',
            'if no, then use the regular "password-auth.ovpn" file to connect to VPN server.'
        ];

        return collect($texts)->implode("\n");
    }
}
