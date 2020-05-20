<?php

namespace App\Services\Server\HookAction;

use Illuminate\Http\Request;
use App\Services\ServerUtils;
use App\Contracts\Server\ServerHookAction;
use App\ServerSoftware;

class RegisterServerSoftware implements ServerHookAction {

    public function callback(Request $request, $payload = [])
    {

        $serverData = [];

        if(
            $request->has('data') &&
            is_array($request->data)
        ) {

            // Configuring ports.
            if( isset($request->data['ports']) ) {
                $serverData['ports'] = json_encode($request->data['ports']);
            }

        }


        if( isset($payload['server_id']) && isset($payload['software_id']) ) {
            $serverData['server_id'] = $payload['server_id'];
            $serverData['software']  = $payload['software_id'];
        }

        $serverData['active'] = true;

        ServerSoftware::updateOrCreate(
            ['server_id' => $serverData['server_id']],
            $serverData
        );

        return true;
    }

}
