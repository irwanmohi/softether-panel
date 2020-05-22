<?php

namespace App\Http\Controllers;

use App\Shorter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShortRedirectorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $short = Shorter::where('short_id', $id)->first();

        if( ! $short instanceof Shorter ) abort(404);

        if(
            ! is_null($short->expired_at) &&
            Carbon::parse($short->expired_at)->lt(now())
        ) return abort(404);

        return redirect()->away($short->target_url);
    }
}
