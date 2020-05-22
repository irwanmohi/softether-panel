<?php

namespace App\Services;

use Str;
use Carbon\Carbon;
use App\Shorter as ShorterModel;

class Shorter {

    public function create($targetUrl, ?Carbon $date = null) {
        return ShorterModel::create([
            'short_id'   => $shortId = Str::random(10),
            'short_url'  => route('short', [$shortId]),
            'target_url' => $targetUrl,
            'expired_at' => $date
        ]);
    }

}
