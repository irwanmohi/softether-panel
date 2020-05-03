<?php

namespace App\Services;

use App\Contracts\SideMenu;

class MenuManager {

    protected $adminMenus = [];

    /**
     * Add Admin Menu.
     *
     * @param  SideMenu $menu
     * @return void
     */
    public function adminMenu(SideMenu $menu) {
        $this->adminMenus[] = $menu;
    }

    public function getAdminMenu() {
        return $this->adminMenus;
    }

}
