<?php

namespace App\Contracts\Server;

use Illuminate\View\View;

interface ServerTab {

    public function setTitle($title);

    public function getTitle();

    public function setView(View $view);

    public function getView() : View;

}
