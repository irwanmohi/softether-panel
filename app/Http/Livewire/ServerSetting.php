<?php

namespace App\Http\Livewire;

use App\Server;
use GuzzleHttp\Client;
use Livewire\Component;

class ServerSetting extends Component
{

    public $server;

    public $serverName;

    public $serverAddress;

    public $serverCountry = "loading...";

    public $countryReadyToLoad = false;

    public function mount(Server $server) {
        $this->server = $server;

        $this->serverName    = $server->name;
        $this->serverAddress = $server->ip;
        $this->serverCountry = $server->country;
    }

    public function render()
    {
        return view('livewire.server-setting');
    }

    public function updateDetails() {

        sleep(2);

        $this->server->update(['name' => $this->serverName]);

    }

    public function prefetch() {

        $http = new Client([
            'base_uri' => "http://ip-api.com/json/"
        ]);

        try {

            $countryResponse = json_decode(
                $http->get($this->server->ip)
                     ->getBody()
                     ->getContents(),
                 true
            );

            if(
                ! is_null($countryResponse) &&
                isset($countryResponse['country'])
            ) {

                $this->serverCountry = $countryResponse['country'];

            }


        } catch(\Exception $e) {
            $this->countryReadyToLoad = true;
        }

        $this->countryReadyToLoad = true;
    }
}
