<?php

namespace App\Http\Controllers;

use Str;
use App\Server;
use Illuminate\Http\Request;

class ServerScriptInstallerUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $payload)
    {
        try {

            $payload = json_decode(decrypt($payload), true);

            $server  = Server::find($payload['server_id']);

            if( $request->has('status') ) {
                $server->update(['status' => $request->status]);
            }

            if( $request->has('percentage') ) {
                $server->update(['setup_percentage' => (int) $request->percentage]);
            }

            if( $request->has('state') ) {
                $server->update(['current_state' => Str::upper($request->state)]);
            }

            if( $request->has('online') && is_bool($request->online) ) {
                $server->update(['online_status' => ($request->online) ? 'ONLINE' : 'OFFLINE']);
            }

            if( $request->has('completed') && is_bool($request->completed)) {
                $server->update(['setup_completed' => ($request->completed)]);
            }

            return 'SSHPANEL Ray: ' . Str::random(50);

        } catch(\Exception $e) {
            return abort(404);
        }
    }
}
