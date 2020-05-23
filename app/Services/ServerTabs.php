<?php

namespace App\Services;

use Closure;
use App\Contracts\Server\ServerTab;

class ServerTabs {

    protected $tabs = [];

    public function addTab($group, Closure $callback) {

        $tab = app(ServerTab::class);

        $callback($tab);

        $this->tabs[$group][] = $tab;

        return $this;
    }

    public function getTabs($group) {
        return isset($this->tabs[$group]) ? $this->tabs[$group] : [];
    }
}
