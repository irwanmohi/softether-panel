<?php

namespace App\Contracts;

interface SideMenu {

    public function setName($name);
    public function getName();

    public function setUrl($url);
    public function getUrl();

    public function setIcon($icon);
    public function getIcon();

    public function toggleable();

    public function isToggleable() : bool;

}
