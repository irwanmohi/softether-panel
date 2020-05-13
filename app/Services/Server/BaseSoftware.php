<?php

namespace App\Services\Server;

use App\Server;
use App\Contracts\Server\ServerSoftware;

abstract class BaseSoftware implements ServerSoftware {

    protected $name, $description, $image;

    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setImagePath($image) {
        $this->image = $image;

        return $this;
    }

    public function getImagePath() {
        return $this->image;
    }

    public function getReservedPorts(): array
    {
        return [];
    }

    abstract public function generateInstallationScript();
}
