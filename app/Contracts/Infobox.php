<?php

namespace App\Contracts;

use Illuminate\View\View;

interface Infobox {

    public function setIcon($icon);
    public function getIcon();

    public function setTitle($title);
    public function getTitle();

    public function setValue($value);
    public function getValue();

    public function setColor($color);
    public function getColor();

    public function setType($type);
    public function getType();

    public function getView() : View;

}
