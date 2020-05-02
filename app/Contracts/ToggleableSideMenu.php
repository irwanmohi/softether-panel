<?php

namespace App\Contracts;

use SideMenuChild;

interface ToggleableSideMenu extends SideMenu {

    public function addChild(SideMenuChild $child);
    public function getChilds();

}
