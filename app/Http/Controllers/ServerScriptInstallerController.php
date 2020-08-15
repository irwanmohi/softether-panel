<?php

namespace App\Http\Controllers;

use App\ServerScript;
use Illuminate\Http\Request;

class ServerScriptInstallerController extends Controller
{

    protected $env = [
        'dev', 'local', 'test'
    ];

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        try {

            $scriptId = decrypt($id);

            $script   = ServerScript::find($scriptId);
            $server   = $script->server;

            //if( ! in_array(app()->environment(), $this->env)  ) {
                //if( $request->ip() != $server->ip ) return abort(404);
            //}

            $script->update([
                'last_fetch' => now(),
                'fetched'    => $script->fetched + 1
            ]);

            return decrypt($script->script);

        } catch(\Exception $e) {

            dd($e);

            return abort(404);
        }
    }
}
