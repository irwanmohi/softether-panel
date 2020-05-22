<?php

namespace App\Http\Livewire;

use App\Server;
use App\Facades\Byte;
use GuzzleHttp\Client;
use Livewire\Component;

class ServerCard extends Component
{

    public $server;

    public $services = [];

    protected $http;

    protected const MONITORING_PORT = 4210;
    protected const MONITORING_PATH = 'phpsysinfo';

    public $readyToLoad = false;

    public function mount(Server $server) {
        $this->server = $server;
    }

    public function render()
    {
        return view('livewire.server-card');
    }

    public function loadCard() {

        $this->http = new Client([
            'base_uri' => sprintf("http://%s:%s/%s/",
                $this->server->ip,
                self::MONITORING_PORT,
                self::MONITORING_PATH
            )
        ]);


        try {
            $json = json_decode(
                $this->http->get('xml.php?plugins=completed&json')->getBody()->getContents(),
                true
            );

            $rootDisk = collect($json['FileSystem']['Mount'] ?? [])->filter(function($file) {
                return ( is_array($file) && isset($file['@attributes']['MountPoint']) && $file['@attributes']['MountPoint'] && $file['@attributes']['MountPoint'] == '/');
            })->first();

            $ram = $json['Memory'];


            $this->services[] = [
                'name' => 'RAM',
                'percentage' => ((int) $ram['@attributes']['Percent'] ?? 0),
                'used' => Byte::format($ram['@attributes']['Used'] ?? 0),
                'total' => Byte::format($ram['@attributes']['Total'] ?? 0),
            ];

            $this->services[] = [
                'name' => 'DISK',
                'percentage' => ((int) $rootDisk['@attributes']['Percent'] ?? 0),
                'used' => Byte::format($rootDisk['@attributes']['Used'] ?? 0),
                'total' => Byte::format($rootDisk['@attributes']['Total'] ?? 0),
            ];

            $this->server->update(['status' => 'ONLINE']);

        } catch(\Exception $e) {

        }

        $this->readyToLoad = true;
    }
}
