<?php

namespace Modules\Softether\Http\Livewire;

use Livewire\Component;
use Modules\Softether\Entities\SoftetherAccount;
use Modules\Softether\Jobs\ChangeSoftetherAccountPassword;
use Modules\Softether\Jobs\ChangeSoftetherAccountPasswordlessAuthentication;

class SoftetherAccountSetting extends Component
{

    public $softetherAccount;

    public $showPassword = false;

    public $username;

    public $password;

    public $serverAddress;

    public $psk;

    public $passwordLess = false;

    public function mount(SoftetherAccount $softetherAccount) {
        $this->softetherAccount = $softetherAccount;
        $this->username         = $softetherAccount->username;
        $this->password         = decrypt($this->softetherAccount->password);
        $this->psk              = decrypt($this->softetherAccount->softetherServer->psk);
        $this->serverAddress    = $softetherAccount->softetherServer->server->ip;
        $this->passwordLess     = $softetherAccount->auth_type == 'CERTIFICATE';
    }

    public function render()
    {
        return view('softether::livewire.softether-account-setting');
    }

    public function updating() {
        //
    }

    public function updatingPasswordLess() {

        switch($this->softetherAccount->fresh()->auth_type) {
            case 'PASSWORD':
                    ChangeSoftetherAccountPasswordlessAuthentication::dispatch($this->softetherAccount);
                break;
            case 'CERTIFICATE' :
                    ChangeSoftetherAccountPassword::dispatch($this->softetherAccount);
                break;
            default:
        }

    }
}
