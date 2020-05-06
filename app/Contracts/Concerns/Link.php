<?php

namespace App\Contracts\Concerns;

interface Link {

    public function setHref($href);
    public function getHref();

    public function setName($name);
    public function getName();

}
