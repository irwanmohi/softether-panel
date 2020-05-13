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

        if( $ssh->login(self::DEFAULT_USERNAME, $rsa) ) {
            $this->sshConnected = true;
        }

        ServerUtils::addService(
            sprintf('server.%s', $this->server->id),
            app(Service::class)
                ->setName('OPENSSH')
                ->setStatus($this->sshConnected ? Service::STATUS_ONLINE : Service::STATUS_OFFLINE)
        );

        ServerUtils::addService(
            sprintf('server.%s', $this->server->id),
            app(Service::class)
                ->setName('OPENVPN')
                ->setStatus('DISABLED')
        );

        ServerUtils::addService(
            sprintf('server.%s', $this->server->id),
            app(Service::class)
                ->setName('L2TP')
                ->setStatus('OFFLINE')
        );


        $this->services = ServerUtils::getServices(
            sprintf('server.%s', $this->server->id)
        );

        $this->readyToLoad = true;

    }
}