<?php

namespace App\Services\Infobox;

use Illuminate\View\View;
use App\Contracts\Infobox;

abstract class BaseInfobox implements Infobox {

    protected $icon, $title, $value, $color, $type;

    public function setIcon($icon) {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    public function getValue() {
        return $this->value;
    }

    public function setColor($color) {
        $this->color = $color;

        return $this;
    }

    public function getColor() {
        return $this->color;
    }

    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    public function getType() {
        return $this->type;
    }

    abstract public function getView() : View;
}
