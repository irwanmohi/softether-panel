<?php

namespace App\Contracts;

interface ToggleableSideMenu extends SideMenu {

    public function addChild(SideMenuChild $child);
    public function getChilds();

}
