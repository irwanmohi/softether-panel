<?php

use App\Services\Infobox\{
    DualInfobox,
    FullColorInfobox,
    PlainInfobox,
    WhiteInfobox
};

return [
    'plain' => PlainInfobox::class,
    'full-color' => FullColorInfobox::class,
    'white' => WhiteInfobox::class,
    'dual' => DualInfobox::class
];
