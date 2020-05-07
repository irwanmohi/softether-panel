<?php

namespace App\Services\Infobox;

use Illuminate\View\View;
use App\Contracts\Infobox;

class WhiteInfobox extends BaseInfobox implements Infobox {

    protected  $type = 'white';

    public function setType($type) {
        return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function getView() : View {
        return view('infobox.white')->with([
            'title' => $this->getTitle(),
            'value' => $this->getValue(),
            'color' => $this->getColor(),
            'icon'  => $this->getIcon()
        ]);
    }
}
