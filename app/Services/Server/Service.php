<?php

namespace App\Services\Server;

use App\Contracts\Server\Service as ServerService;
use Illuminate\View\View;

class Service implements ServerService {

    protected $name;

    protected $status;

    protected $ports = [];

    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function addPort($port) {
        $this->ports[] = $port;

        return $this;
    }

    public function getPorts() {
        return $this->ports;
    }

    public function getView() : View {
        return view('servers.service')->with([
            'status' => $this->status,
            'name'   => $this->name,
            'ports'  => $this->ports
        ]);
    }
}
