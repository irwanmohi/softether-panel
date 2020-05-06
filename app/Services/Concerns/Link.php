<?php

namespace App\Services\Concerns;

use App\Contracts\Concerns\Link as LinkContract;

class Link implements LinkContract {

    protected $href;

    protected $name;

    public function setHref($href) {
        $this->href = $href;

        return $this;
    }

    public function getHref() {
        return $this->href;
    }

    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    public function getName() {
        return $this->name;
    }
}
