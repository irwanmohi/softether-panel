<?php

namespace Modules\Coupon;

use Illuminate\Support\Facades\Artisan;

class HookInstall {

    public function __invoke() {
        // migrating database.
        Artisan::call('module:migrate Coupon');
    }
}
