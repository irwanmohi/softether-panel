<?php

namespace App\Http\Livewire;

use App\Server;
use App\ServerScript;
use Livewire\Component;
use App\Facades\ServerUtils;
use App\Contracts\Server\RequireServerInfo;
use App\Contracts\Server\ServerHook;

class RunSoftwareScript extends Component
{

    public $server;

    public $softwareId, $softwareName, $softwareDescription;

    public $script;

    protected $software;

    protected $allowedState = ['TO_RUN_SOFTWARE_SCRIPT'];

    protected $deps = [
        'curl', 'netcat-openbsd', 'git'
    ];

    protected $version = '1.0';

    public function mount(Server $server, $softwareId) {

        if( ! in_array($server->current_state, $this->allowedState) ) abort(404);

        $this->server = $server;

        $software = ServerUtils::getSoftware($softwareId);

        // Set the software properties.
        $this->softwareName         = $software->getName();
        $this->softwareDescription  = $software->getDescription();
        $this->softwareId           = $softwareId;

        $this->software = $software;
        $this->script   = $this->getInstallerScript();
    }

    public function render()
    {
        return view('livewire.run-software-script');
    }

    protected function getInstallerScript() {

        // TODO
        // Merge default script & the script from software implementation.
        // Generate unique url using the server_script

        $payload = encrypt(
            json_encode([
                'server_id'    => $this->server->id,
                'software_id'  => $this->softwareId
            ])
        );

        $updateUrl = route('scripts.server-install.update', [$payload]);
        $hookUrl   = route('scripts.server-install.hooks', [$payload]);

        if( $this->software instanceof RequireServerInfo ) {
            $this->software->setServer($this->server);
        }

        if( $this->software instanceof ServerHook ) {
            $this->software->setHookUrl($hookUrl);
            $this->software->setUpdateUrl($updateUrl);
        }

        // generated script.

        $version = sprintf("%s%s", $this->version, str_repeat(" ", (8 - strlen($this->version))));
        $serverName = $this->server->name;
        $serverIP   = $this->server->ip;
        $serverPub  = $this->server->public_key;

        $generatedScript = <<<EOL
#!/bin/bash

####################################################################################
#   _______  _______  __   __  _______  _______  __    _  _______  ___             #
#  |       ||       ||  | |  ||       ||   _   ||  |  | ||       ||   |            #
#  |  _____||  _____||  |_|  ||    _  ||  |_|  ||   |_| ||    ___||   |            #
#  | |_____ | |_____ |       ||   |_| ||       ||       ||   |___ |   |            #
#  |_____  ||_____  ||       ||    ___||       ||  _    ||    ___||   |___         #
#   _____| | _____| ||   _   ||   |    |   _   || | |   ||   |___ |       |        #
#  |_______||_______||__| |__||___|    |__| |__||_|  |__||_______||_______|        #
#                                                                                  #
#     Installer Version: $version                                                  #
#     Website: https://sshpanel.io                                                 #
#     Contact: contact@sshpanel.io                                                 #
#                                                                                  #
# ##################################################################################


export SSHPANEL_HOOKS="$hookUrl"
export SSHPANEL_UPDATE="$updateUrl"
export SERVER_PUB="$serverPub"
export SERVER_IP="$serverIP"
export SERVER_NAME="$serverName"


EOL;

        $generatedScript .= ServerUtils::getInitScript();

        // get the software script
        $generatedScript .= $this->software->generateInstallationScript();

        $serverScript = ServerScript::updateOrCreate(
            ['server_id' => $this->server->id],
            [
                'server_id' => $this->server->id,
                'script'    =>  encrypt($generatedScript),
                'fetched'   => 0
            ]
        );

        $scriptUrl = route("scripts.installer", [encrypt($serverScript->id)]);

        $script = sprintf('export DEBIAN_FRONTEND=noninteractive; echo \'Acquire::ForceIPv4 "true";\' | tee /etc/apt/apt.conf.d/99force-ipv4; apt-get update; apt-get install %s -y; curl -4 --silent --location %s | bash -; export DEBIAN_FRONTEND=newt',
            collect($this->deps)->implode(' '),
            $scriptUrl
        );

        return $script;
    }
}
