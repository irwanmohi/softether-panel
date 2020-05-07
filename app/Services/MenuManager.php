<?php

namespace App\Services;

use App\Contracts\SideMenu;

class MenuManager {

    /**
     * The menu for admin setting.
     *
     * @var  array $adminMenus
     */
    protected $adminMenus = [];

    /**
     * All Menus.
     *
     * @var  array $menus
     */
    protected $menus = [];

    /**
     * Add Admin Menu.
     *
     * @param  SideMenu $menu
     * @return void
     */
    public function adminMenu(SideMenu $menu) {
        $this->adminMenus[] = $menu;

        return $this;
    }

    public function getAdminMenu() {
        return $this->adminMenus;
    }

    public function addMenu(SideMenu $menu, $show = true) {
        if ( is_callable($show) && true === $show() ) {
            $this->menus[] = $menu;
        }

        if( is_bool($show) && true == $show ) {
            $this->menus[] = $menu;
        }

        return $this;
    }

    public function getMenu() {
        return $this->menus;
    }

}
