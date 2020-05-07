<?php

namespace App\Services\Infobox;

use Illuminate\View\View;
use App\Contracts\Infobox;

class FullColorInfobox extends BaseInfobox implements Infobox {

    protected  $type = 'full-color';

    public function setType($type) {
        return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function getView() : View {
        return view('infobox.full-color')->with([
            'title' => $this->getTitle(),
            'value' => $this->getValue(),
            'color' => $this->getColor(),
            'icon'  => $this->getIcon()
        ]);
    }
}
