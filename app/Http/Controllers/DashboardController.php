<?php

namespace App\Http\Controllers;

use App\Events\Dashboard\DashboardLoading;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        event(new DashboardLoading);

        return view('dashboard');
    }
}
