<?php

namespace Modules\Softether\Http\Livewire;

use Livewire\Component;
use Modules\Softether\Entities\SoftetherServer;
use Modules\Softether\Jobs\DisableL2TP;
use Modules\Softether\Jobs\EnableL2TP;
use Modules\Softether\Jobs\UpdateSoftetherAdminPassword;
use Modules\Softether\Jobs\UpdateSoftetherHubPassword;
use Modules\Softether\Jobs\UpdateSoftetherPsk;

class SoftetherServerSetting extends Component
{

    public $server, $softetherServer;

    public $serverName, $serverAddress, $hubName, $hubPassword, $adminPassword, $psk, $accountPrice, $allowAccountCreation;

    public $showHubPassword = false, $showAdminPassword = false;

    public $currentHubPassword, $currentAdminPassword, $currentPsk;

    public $enableL2TP;

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

        $this->currentHubPassword   = decrypt($softetherServer->hub_password);
        $this->currentAdminPassword = decrypt($softetherServer->admin_password);
        $this->currentPsk           = decrypt($softetherServer->psk);

        $this->enableL2TP = $softetherServer->enable_l2tp;
    }

    public function render()
    {
        return view('softether::livewire.softether-server-setting');
    }

    public function updatingAllowAccountCreation() {
        sleep(2);

        $this->softetherServer->update(['allow_account_creation' => ! $this->allowAccountCreation]);
    }

    public function updatingEnableL2TP() {
        $this->softetherServer->update(['enable_l2tp' => (bool) ! $this->enableL2TP]);

        ( ! $this->enableL2TP) ? EnableL2TP::dispatch($this->softetherServer) : DisableL2TP::dispatch($this->softetherServer);
    }

    public function updateDetails() {

        $this->softetherServer->update([
            'hub_password'   => encrypt($this->hubPassword),
            'admin_password' => encrypt($this->adminPassword),
            'psk'            => encrypt($this->psk),
            'account_price'  => $this->accountPrice
        ]);


        if($this->hubPassword != $this->currentHubPassword) {
            UpdateSoftetherHubPassword::dispatch($this->softetherServer, $this->currentHubPassword);
        }

        if($this->adminPassword != $this->currentAdminPassword) {
            UpdateSoftetherAdminPassword::dispatch($this->softetherServer, $this->currentAdminPassword);
        }

        if($this->psk != $this->currentPsk) {
            UpdateSoftetherPsk::dispatch($this->softetherServer, $this->currentPsk);
        }

    }
}
