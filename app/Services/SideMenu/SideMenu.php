<?php

namespace App\Services\SideMenu;

use App\Contracts\SideMenu as SideMenuContract;
use App\Contracts\ToggleableSideMenu;

class SideMenu implements SideMenuContract {

    protected $toggleable = false;

    protected $name;
    protected $url;
    protected $icon;
    protected $isActive = false;

    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setIcon($icon) {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function toggleable() {
        $this->toggleable = true;

        return $this;
    }

    public function isToggleable() : bool {
        return (bool) $this->toggleable || $this instanceof ToggleableSideMenu;
    }

    public function setActive()
    {
        $this->isActive = true;

        return $this;
    }

    public function isActive() : bool {
        return $this->isActive;
    }
}
