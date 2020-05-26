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

class SynchronizeSoftetherAccountDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $softetherAccount, $softetherServer, $server;

    protected const DEFAULT_USERNAME = 'root';

    protected const CONTAINER_NAME = 'sshpanel-softether';

    protected $mapping = [
        'Outgoing Unicast Packets' => 'outgoing_unicast_packets',
        'Outgoing Unicast Total Size' => 'outgoing_unicast_size',
        'Outgoing Broadcast Packets' => 'outgoing_broadcast_packets',
        'Outgoing Broadcast Total Size' => 'outgoing_broadcast_size',
        'Incoming Unicast Packets' => 'incoming_unicast_packets',
        'Incoming Unicast Total Size' => 'incoming_unicast_size',
        'Incoming Broadcast Packets' => 'incoming_broadcast_packets',
        'Incoming Broadcast Total Size' => 'incoming_broadcast_size',
        'Number of Logins' => 'total_logins'
    ];

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


        $command = sprintf('docker exec %s vpncmd localhost:5555 /SERVER /HUB:%s /PASSWORD:%s /CSV /CMD:UserGet %s',
            self::CONTAINER_NAME,
            $this->softetherServer->hub_name,
            decrypt($this->softetherServer->hub_password),
            $this->softetherAccount->username
        );


        $csv = str_getcsv($ssh->exec($command), "\n");

        $toUpdate = [];

        foreach ($csv as $str) {
            $row = str_getcsv($str);

            if( count($row) == 2 ) {
                $key    = $row[0];
                $value  = $row[1];

                if( in_array($key, array_keys($this->mapping)) ) {
                    $trimmed = str_replace(['packets', 'size', 'bytes', ','], '', $value);

                    $toUpdate[$this->mapping[$key]] = trim($trimmed);
                }
            }
        }

        $this->softetherAccount->update($toUpdate);

        // Updating online status.
        $command = sprintf('docker exec %s vpncmd localhost:5555 /SERVER /HUB:%s /PASSWORD:%s /CSV /CMD:SessionList',
            self::CONTAINER_NAME,
            $this->softetherServer->hub_name,
            decrypt($this->softetherServer->hub_password)
        );

        $csv = str_getcsv($ssh->exec($command), "\n");

        $userOnline = false;

        foreach ($csv as $str) {
            $row = str_getcsv($str);

            if( count($row) > 3 ) {

                $currentUser = $row[3];

                if( $currentUser === $this->softetherAccount->username ) {
                    $userOnline = true;
                }
            }

        }

        if( $userOnline && $this->softetherAccount->online_status == 'OFFLINE') {
            $this->softetherAccount->update(['online_status' => 'ONLINE']);
        }
        else
        {
            if( $this->softetherAccount->online_status  == 'OFFLINE') return;

            $this->softetherAccount->update(['online_status' => 'OFFLINE']);
        }
    }
}
