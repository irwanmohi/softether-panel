<?php

namespace Modules\Softether\Services;

use Illuminate\Http\Request;
use Modules\Softether\Entities\SoftetherServer;
use App\Contracts\Server\ServerHookAction;
use Illuminate\Http\UploadedFile;

class RegisterServerCertificateHookAction implements ServerHookAction {

    public function callback(Request $request, $payload = [])
    {
        if(
            $request->has('data') &&
            is_array($request->data) &&
            isset($request->data['cert']) &&
            $request->data['cert'] instanceof UploadedFile
        ) {
            $keyContent = $request->data['cert']->get();

            $server = SoftetherServer::where('server_id', $payload['server_id'])->update(['server_ca' => $keyContent]);
        }
    }

}
