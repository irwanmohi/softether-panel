<?php

namespace App\Contracts;

interface SideMenu {

    public function setName($name);
    public function getName();

    public function setUrl($url);
    public function getUrl();

    public function toggleable();

}
