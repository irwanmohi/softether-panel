<?php

namespace App\Services;

use App\Contracts\Server\ServerSoftware;

class ServerUtils {

    /**
     * Available Server Software.
     *
     * @var array $oftware
     */
    protected $software = [];

    protected $initialScript = [
        "# INIT SCRIPT",
        "apt-get update && apt-get install git -y",
        "git clone https://github.com/sshpanel/softether-public-init-script",
        "cd softether-public-init-script && chmod +x init && bash init"
    ];


    /**
     * Add new Software.
     *
     * @param  string                 $id
     * @param  ServerSoftware|string  $software
     * @return self
     */
    public function addSoftware($id, $software) {

        if( ! $software instanceof ServerSoftware ) {
            $software = app($software);
        }

        $this->software[$id] = $software;

        return $this;
    }

    public function getSoftware($id) {
        if( isset($this->software[$id]) ) return $this->software[$id];
    }

    public function getAllSoftware() {
        return $this->software;
    }

    public function getInitScript() {
        return collect($this->initialScript)->implode("\n");
    }
}

