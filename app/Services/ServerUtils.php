<?php

namespace App\Services;

use App\Contracts\Server\Service;
use App\Contracts\Server\ServerHookAction;
use App\Contracts\Server\ServerSoftware;

class ServerUtils {

    /**
     * Available Server Software.
     *
     * @var array $oftware
     */
    protected $software = [];

    protected $hookActions = [];

    protected $initialScript = [
        "# INIT SCRIPT",
        "apt-get update && apt-get install git -y",
        "git clone https://github.com/sshpanel/softether-public-init-script",
        "cd softether-public-init-script && chmod +x init && bash init"
    ];

    protected $services = [];

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

    public function addService($group, Service $service) {
        $this->services[$group][] = $service;
    }

    public function getServices($group = 'main') {
        return isset($this->services[$group])
                ? $this->services[$group]
                : [];
    }

    public function registerHookAction($key, $hookAction, $override = false) {

        if( ! $hookAction instanceof ServerHookAction) {
            $hookAction = app($hookAction);
        }

        if(isset($this->hookActions[$key])) {
            $this->hookActions[$key] = ($override) ? $hookAction : $this->hookActions[$key];
        }
        else
        {
            $this->hookActions[$key] = $hookAction;
        }
    }

    public function getHookAction($key) {
        if( isset($this->hookActions[$key]) ) return $this->hookActions[$key];
    }
}

