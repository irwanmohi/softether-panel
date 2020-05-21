<?php

namespace Modules\Softether\Http\Livewire;

use Str;
use Carbon\Carbon;
use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;
use Livewire\Component;
use Modules\Softether\Entities\SoftetherAccount;
use Modules\Softether\Entities\SoftetherServer;
use Modules\Softether\Jobs\CreateSoftetherAccount as CreateSoftetherAccountJob;

class CreateSoftetherAccount extends Component
{
    public $softetherServer;

    public $username;

    public $password;

    public $duration;

    public $accountPrice = 0;

    protected $server;

    protected $commands = [];

    protected const DEFAULT_USERNAME = 'root';

    protected const CONTAINER_NAME = 'sshpanel-softether';

    public function mount(SoftetherServer $softetherServer) {
        $this->softetherServer = $softetherServer;
        $this->server          = $softetherServer->server;

        if( $this->softetherServer->passwordless_only ) {
            $this->password = Str::random(10);
        }
    }

    public function render()
    {
        return view('softether::livewire.create-softether-account');
    }

    public function submit() {
        $this->validate([
            'username' => 'required|alpha_num',
            'duration' => 'required|min:1'
        ]);

        if( ! $this->softetherServer->passwordless_only ) {

            $this->validate([
                'password' => 'required'
            ]);
        }

        $account = SoftetherAccount::where('username', $this->username)
            ->whereIn('status', ['ACTIVE', 'EXPIRED'])
            ->where('softether_server_id', $this->softetherServer->id)
            ->first();

        if( $account instanceof SoftetherAccount ) {
            return session()->flash('error_message', sprintf("Username <b>%s</b> already exists.", $this->username));
        }

        $account = $this->createAccount();

        $this->emit('SoftetherAccountCreated', ['account' => $account, 'redirect' => route('softether.accounts.show', [encrypt($account->id)])]);
    }

    public function updatedDuration() {
        $this->accountPrice = $this->duration * $this->softetherServer->account_price;
    }

    protected function createAccount() {

        $this->server = $this->softetherServer->server;

        $ssh = new SSH2($this->server->ip);
        $rsa = new RSA();
        $rsa->loadKey($this->server->private_key);

        if( ! $ssh->login(self::DEFAULT_USERNAME, $rsa) ) {

            $this->server->update(['online_status' => 'OFFLINE']);

            session()->flash('error_message', 'Unable to connecting to the server! Please contact your administrator.');
        }
        else
        {
            $this->server->update(['online_status' => 'ONLINE']);
        }

        // create the account.

        $account = SoftetherAccount::create([
            'softether_server_id' => $this->softetherServer->id,
            'username'            => $this->username,
            'password'            => encrypt($this->password),
            'price'               => $this->softetherServer->account_price,
            'auth_type'           => ($this->softetherServer->passwordless_only) ? 'CERTIFICATE' : 'PASSWORD',
            'active_date'         => Carbon::now(),
            'expired_date'        => Carbon::now()->addMonths($this->duration),
        ]);

        // dispatch job.
        CreateSoftetherAccountJob::dispatch(
            $this->softetherServer, $account
        );

        return $account;
    }
}
