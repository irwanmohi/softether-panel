<?php

namespace App\Services\SideMenu;

use App\Contracts\ToggleableSideMenu;

class ToggleableMenu extends SideMenu implements ToggleableSideMenu {

    protected $childs = [];

    public function addChild(SideMenuChild $child) {
        $this->childs[] = $child;

        return $this;
    }

    public function getChilds() {
        return $this->childs;
    }
}
