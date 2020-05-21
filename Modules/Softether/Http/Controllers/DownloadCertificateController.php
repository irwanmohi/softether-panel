<?php

namespace Modules\Softether\Http\Controllers;

use PhpZip\ZipFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DownloadCertificateController extends Controller
{
    public function __invoke(Request $request, $payload) {
        try {
            $config = json_decode(decrypt($payload), true);


            if( ! isset($config['cert']) && !isset($config['key']) ) abort(404);

            $zip = new ZipFile;

            $zip->addFromString('certs/account.crt', $config['cert']);
            $zip->addFromString('certs/account.key', $config['key']);
            $zip->addFromString('certs/signature.txt', view('softether::signature')->render());

            return response()->streamDownload(function() use($zip) {
                echo $zip->outputAsString();
            }, 'certificate.zip');

        } catch(\Exception $e) {
            dd($e);
            return abort(404);
        }

    }
}
