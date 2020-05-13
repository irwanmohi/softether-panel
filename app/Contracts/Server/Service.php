<?php

namespace App\Contracts\Server;

use Illuminate\View\View;

interface Service {

    public const STATUS_ONLINE   = 'ONLINE';
    public const STATUS_OFFLINE  = 'OFFLINE';
    public const STATUS_UNKNOWN  = 'UNKNOWN';

    public function setName($name);
    public function getName();

    public function setStatus($status);
    public function getStatus();

    public function addPort($port);
    public function getPorts();

    public function getView() : View;

}
