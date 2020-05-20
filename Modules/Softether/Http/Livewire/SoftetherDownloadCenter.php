<?php

namespace Modules\Softether\Http\Livewire;

use Livewire\Component;
use Modules\Softether\Entities\SoftetherAccount;

class SoftetherDownloadCenter extends Component
{

    public $softetherAccount;

    public function mount(SoftetherAccount $softetherAccount) {
        $this->softetherAccount = $softetherAccount;
    }

    public function render()
    {
        return view('softether::livewire.softether-download-center');
    }

    public function downloadOpenvpnConfig() {
        $configPayload = json_encode([
            'REMOTE_SERVER' => $this->softetherAccount->softetherServer->server->ip,
            'AUTH_METHOD' => ($this->softetherAccount->auth_type == 'PASSWORD' && ! $this->softetherAccount->softetherServer->passwordless_only) ? 'auth-user-pass' : '',
            'SERVER_CA' => $this->softetherAccount->softetherServer->server_ca,
            'USER_CERT' => $this->softetherAccount->account_cert,
            'USER_KEY'  => $this->softetherAccount->account_key
        ]);

        return redirect(route('softether.downloads.openvpn', [encrypt($configPayload)]));

    }
}
