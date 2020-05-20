<?php

namespace App\Contracts\Server;

use Illuminate\Http\Request;

interface ServerHookAction {

    public function callback(Request $request, $payload = []);

}
