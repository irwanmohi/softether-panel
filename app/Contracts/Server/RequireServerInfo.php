<?php

namespace App\Contracts\Server;

use App\Server;

interface RequireServerInfo {

    public function setServer(Server $server);

    public function getServer() : Server;

}
