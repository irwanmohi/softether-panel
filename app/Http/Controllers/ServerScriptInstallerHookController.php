<?php

namespace App\Http\Controllers;

use Str;
use App\Facades\ServerUtils;
use Illuminate\Http\Request;
use App\Contracts\Server\ServerHookAction;

class ServerScriptInstallerHookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $payload)
    {

        $request->validate(['action' => 'required']);

        $payload = decrypt($payload);

        $action = $request->action;

        $hookAction = ServerUtils::getHookAction($action);

        if( $hookAction instanceof ServerHookAction ) {
            $hookAction->callback($request, json_decode($payload, true));
        }

        return sprintf("SSHPANEL Ray: %s\n", Str::random(100));
    }
}
