<?php

namespace App\Contracts\Server;

interface ServerSoftware {

    public function setName($name);
    public function getName();

    public function setDescription($description);
    public function getDescription();

    public function setImagePath($image);
    public function getImagePath();

    public function getReservedPorts() : array;

    public function generateInstallationScript();
}
