<?php

namespace Modules\Softether\Http\Livewire;

use Livewire\Component;
use Modules\Softether\Entities\SoftetherServer;

class SoftetherServerSetting extends Component
{

    public $server, $softetherServer;

    public $serverName, $serverAddress, $hubName, $hubPassword, $adminPassword, $psk, $accountPrice, $allowAccountCreation;

    public $showHubPassword = false, $showAdminPassword = false;

    public function mount(SoftetherServer $softetherServer) {
        $this->softetherServer = $softetherServer;
        $this->server          = $softetherServer->server;

        $this->serverName    = $this->server->name;
        $this->serverAddress = $this->server->ip;
        $this->hubName       = $softetherServer->hub_name;
        $this->hubPassword   = decrypt($softetherServer->hub_password);
        $this->adminPassword = decrypt($softetherServer->admin_password);
        $this->psk           = decrypt($softetherServer->psk);
        $this->accountPrice  = $softetherServer->account_price;
        $this->allowAccountCreation = $softetherServer->allow_account_creation;
    }

    public function render()
    {
        return view('softether::livewire.softether-server-setting');
    }

    public function updatingAllowAccountCreation() {
        sleep(2);

        $this->softetherServer->update(['allow_account_creation' => ! $this->allowAccountCreation]);
    }
}
