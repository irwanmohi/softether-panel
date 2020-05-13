<?php

namespace App\Http\Livewire;

use App\Facades\Byte;
use App\Server;
use Livewire\Component;
use GuzzleHttp\Client;

class ServerNetwork extends Component
{

    public $server;

    protected $http;

    public $networkInterfaces = [];

    protected const MONITORING_PORT = 4210;
    protected const MONITORING_PATH = 'phpsysinfo';

    public function mount(Server $server) {
        $this->server = $server;

        $this->http = new Client([
            'base_uri' => sprintf("http://%s:%s/%s/",
                $server->ip,
                self::MONITORING_PORT,
                self::MONITORING_PATH
            )
        ]);

        $this->getNetworkDetails();
    }

    public function render()
    {
        return view('livewire.server-network');
    }

    protected function getNetworkDetails() {

        try {

            $json = json_decode(
                $this->http->get('xml.php?plugins=completed&json')->getBody()->getContents(),
                true
            );

            $this->networkInterfaces = collect($json['Network']['NetDevice'] ?? [])->map(function($interface) {
                return [
                    'interface' => $interface['@attributes']['Name'],
                    'rx'        => Byte::format($interface['@attributes']['RxBytes'] ?? 0),
                    'tx'        => Byte::format($interface['@attributes']['TxBytes'] ?? 0),
                    'err'       => $interface['@attributes']['Err'] ?? 0,
                    'drop'      => $interface['@attributes']['Drops'] ?? 0,
                    'info'      => $interface['@attributes']['Info']
                ];
            })->toArray();


        } catch(\Exception $e) {
            dd($e);
        }
    }
}
