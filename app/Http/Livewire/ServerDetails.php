<?php

namespace App\Http\Livewire;

use App\Contracts\Concerns\Colors;
use App\Server;
use Livewire\Component;
use App\Facades\Infobox as Box;
use App\Contracts\Infobox;
use App\Facades\Byte;
use GuzzleHttp\Client;

class ServerDetails extends Component
{

    public $server;

    protected $http;

    protected const MONITORING_PORT = 4210;
    protected const MONITORING_PATH = 'phpsysinfo';

    public $readyToLoad = false;

    public function mount(Server $server) {
        $this->server = $server;

    }

    public function render()
    {
        return view('livewire.server-details');
    }

    protected function generateServerBoxes() {

        $boxesValue = [];

        try {
            $json = json_decode(
                $this->http->get('xml.php?plugins=completed&json')->getBody()->getContents(),
                true
            );

            $rootDisk = collect($json['FileSystem']['Mount'] ?? [])->filter(function($file) {
                return ( is_array($file) && isset($file['@attributes']['MountPoint']) && $file['@attributes']['MountPoint'] && $file['@attributes']['MountPoint'] == '/');
            })->first();

            $boxesValue['total_cpu']                = count($json['Hardware']['CPU']['CpuCore'] ?? []);
            $boxesValue['total_ram']                = Byte::format($json['Memory']['@attributes']['Total'] ?? 0);
            $boxesValue['total_disk_space']         = Byte::format($rootDisk['@attributes']['Total'] ?? 0);
            $boxesValue['available_disk_space']     = Byte::format($rootDisk['@attributes']['Free'] ?? 0);
            $boxesValue['used_disk_space']          = Byte::format($rootDisk['@attributes']['Used'] ?? 0);
            $boxesValue['total_network_interface']  = count($json['Network']['NetDevice'] ?? []);

            //dd($boxesValue, $json);
        } catch(\Exception $e) {
        }

        $group = sprintf('server.%s', $this->server->id);

        Box::addBox('dual', function(Infobox $box) use($boxesValue) {
            $box->setTitle('TOTAL RAM');
            $box->setValue($boxesValue['total_ram'] ?? 'UNKNOWN');
            $box->setColor(Colors::LIGHT_BLUE);
            $box->setIcon('straighten');
        }, true, $group);

        Box::addBox('dual', function(Infobox $box) use($boxesValue) {
            $box->setTitle('TOTAL DISK SPACE');
            $box->setValue($boxesValue['total_disk_space'] ?? 'UNKNOWN');
            $box->setColor(Colors::DEEP_PURPLE);
            $box->setIcon('storage');
        }, true, $group);


        Box::addBox('dual', function(Infobox $box) use($boxesValue) {
            $box->setTitle('TOTAL CPU');
            $box->setValue($boxesValue['total_cpu'] ?? 'UNKNOWN');
            $box->setColor(Colors::PINK);
            $box->setIcon('memory');
        }, true, $group);


        Box::addBox('dual', function(Infobox $box) use($boxesValue) {
            $box->setTitle('NETWORK INTERFACES');
            $box->setValue($boxesValue['total_network_interface'] ?? 'UNKNOWN');
            $box->setColor(Colors::PURPLE);
            $box->setIcon('router');
        }, true, $group);
    }

    public function testDefer() {

        $this->http = new Client([
            'base_uri' => sprintf("http://%s:%s/%s/",
                $this->server->ip,
                self::MONITORING_PORT,
                self::MONITORING_PATH
            ),
            'connect_timeout' => 5
        ]);

        $this->generateServerBoxes();

        $this->readyToLoad = true;
    }
}
