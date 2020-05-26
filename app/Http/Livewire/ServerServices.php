<?php

namespace App\Http\Livewire;

use App\Contracts\Server\Service;
use App\Facades\ServerUtils;
use App\Server;
use Livewire\Component;
use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;

class ServerServices extends Component
{
    public $server;

    public $services = [];

    public $readyToLoad = false;

    protected $sshConnected = false;

    protected const DEFAULT_USERNAME = 'root';

    public function mount(Server $server) {
        $this->server = $server;


    }

    public function render()
    {
        return view('livewire.server-services');
    }

    public function registerServices() {
        $ssh = new SSH2($this->server->ip);
        $rsa = new RSA();
        $rsa->loadKey($this->server->private_key);

        try {

            if( $ssh->login(self::DEFAULT_USERNAME, $rsa) ) {
                $this->sshConnected = true;

                $this->server->update(['online_status' => 'ONLINE']);
            }

            if( ! $this->sshConnected ) {
                // mark server as offline
                $this->server->update(['online_status' => 'OFFLINE']);
            }

        } catch(\Exception $e) {
            $this->server->update(['online_status' => 'OFFLINE']);
        }


        ServerUtils::addService(
            sprintf('server.%s', $this->server->id),
            app(Service::class)
                ->setName('OPENSSH')
                ->setStatus($this->sshConnected ? Service::STATUS_ONLINE : Service::STATUS_OFFLINE)
        );

        $this->services = ServerUtils::getServices(
            sprintf('server.%s', $this->server->id)
        );

        $this->readyToLoad = true;

    }
}
