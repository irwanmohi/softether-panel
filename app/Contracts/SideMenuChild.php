<?php

namespace App\Contracts;

interface SideMenuChild {

    public function setName($name);
    public function getName();

    public function setUrl($url);
    public function getUrl();

}
