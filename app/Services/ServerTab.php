<?php

namespace App\Services;

use Illuminate\View\View;
use App\Contracts\Server\ServerTab as ServerTabContracts;

class ServerTab implements ServerTabContracts {

    protected $title;

    protected $view;

    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setView(View $view) {
        $this->view = $view;

        return $this;
    }

    public function getView() : View {
        return $this->view;
    }

}
