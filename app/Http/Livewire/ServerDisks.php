<?php

namespace App\Http\Livewire;

use Percentage;
use App\Server;
use App\Facades\Byte;
use Livewire\Component;
use GuzzleHttp\Client;

class ServerDisks extends Component
{
    public $server;

    protected $http;

    public $disks;

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

        $this->getDiskDetails();
    }

    public function render()
    {
        return view('livewire.server-disks');
    }

    protected function getDiskDetails() {

        $boxesValue = [];

        try {

            $json = json_decode(
                $this->http->get('xml.php?plugins=completed&json')->getBody()->getContents(),
                true
            );

            $this->disks = collect($json['FileSystem']['Mount'] ?? [])->map(function($disk) {
                return [
                    'mount_point'                => $disk['@attributes']['MountPoint'],
                    'total_disk_space'           => Byte::format($disk['@attributes']['Total'] ?? 0),
                    'available_disk_space'       => Byte::format($disk['@attributes']['Free'] ?? 0),
                    'used_disk_space'            => Byte::format($disk['@attributes']['Used'] ?? 0),
                    'used_disk_percentage'       => $disk['@attributes']['Percent'] ?? 0,
                    'available_disk_percentage'  => ceil(
                        Percentage::calculate(
                            $disk['@attributes']['Free'] ?? 0,
                            $disk['@attributes']['Total'] ?? 0
                        )
                    )
                ];
            })->toArray();


        } catch(\Exception $e) {
            dd($e);
        }
    }
}
