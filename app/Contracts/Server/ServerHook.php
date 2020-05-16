<?php

namespace App\Contracts\Server;

use App\Server;

interface ServerHook {

    public function setUpdateUrl($updateUrl);
    public function getUpdateUrl();

    public function setHookUrl($hookUrl);
    public function getHookUrl();

    public function beforeRun(Server $server);

}
