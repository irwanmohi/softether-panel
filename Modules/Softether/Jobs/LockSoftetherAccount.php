<?php

namespace Modules\Softether\Jobs;

use App\Server;
use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Softether\Entities\SoftetherAccount;

class LockSoftetherAccount implements ShouldQueue
{


    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $softetherAccount, $softetherServer, $server;

    protected const DEFAULT_USERNAME = 'root';

    protected const CONTAINER_NAME = 'sshpanel-softether';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SoftetherAccount $softetherAccount)
    {
        $this->softetherAccount = $softetherAccount;
        $this->softetherServer  = $softetherAccount->softetherServer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $server = $this->softetherServer->server;

        if( ! $server instanceof Server ) return;

        $ssh    = new SSH2($server->ip);
        $rsa    = new RSA();
        $rsa->loadKey($server->private_key);

        $this->server = $server;

        if( ! $ssh->login(self::DEFAULT_USERNAME, $rsa) ) {

            $server->update(['online_status' => 'OFFLINE']);

        }
        else
        {
            $server->update(['online_status' => 'ONLINE']);
        }


        $command = sprintf('docker exec %s vpncmd localhost:5555 /SERVER /HUB:%s /PASSWORD:%s /CSV /CMD:UserPolicySet %s /NAME:Access /VALUE:no',
            self::CONTAINER_NAME,
            $this->softetherServer->hub_name,
            decrypt($this->softetherServer->hub_password),
            $this->softetherAccount->username
        );

        $this->softetherAccount->update(['is_locked' => true]);
    }
}
