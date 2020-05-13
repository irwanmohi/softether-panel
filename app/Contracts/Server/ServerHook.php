<?php

namespace App\Contracts\Server;

interface ServerHook {

    public function setUpdateUrl($updateUrl);
    public function getUpdateUrl();

    public function setHookUrl($hookUrl);
    public function getHookUrl();

}
