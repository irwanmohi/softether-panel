<?php

namespace App\Http\Livewire;

use App\Server;
use Livewire\Component;
use phpseclib\Crypt\RSA;

class AddServer extends Component
{

    public $serverName, $serverIP;

    public function submit() {
        $this->validate([
            'serverName' => 'required',
            'serverIP'   => 'required|ipv4'
        ]);

        if( Server::where('ip', $this->serverIP)->first() ) {
            $this->addError('ip', sprintf("The Server with IP address %s already exists.", $this->serverIP));

            return;
        }

        // generate key pairs for the server.
        $rsa = new RSA();
        $rsa->setComment('sshpanel-key-vault');
        $rsa->setPublicKeyFormat(RSA::PUBLIC_FORMAT_OPENSSH);

        $keys = $rsa->createKey(2048);

        $server = Server::create([
            'name' => $this->serverName,
            'ip'   => $this->serverIP,
            'public_key'    => $keys['publickey'],
            'private_key'   => $keys['privatekey'],
            'current_state' => 'CHOOSING_SOFTWARE',
            'status'        => 'Select VPN Software',
        ]);

        return redirect(route('servers.server_setup.select-software', [encrypt($server->id)]));

    }

    public function render()
    {
        return view('livewire.add-server');
    }
}
