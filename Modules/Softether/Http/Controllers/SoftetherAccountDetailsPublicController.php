<?php

namespace Modules\Softether\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Softether\Entities\SoftetherAccount;

class SoftetherAccountDetailsPublicController extends Controller
{
    public function __invoke(Request $request, $payload)
    {

        try {

            $accountId = decrypt($payload);

            $account = SoftetherAccount::find($accountId);

            if( ! $account instanceof SoftetherAccount ) return abort(404);

            if( ! $account->allow_sharing ) return abort(404);

            return view('softether::softether-account-details-public', compact('account'));

        } catch(\Exception $e) {
            return abort(404);
        }

        // eventually.
        return abort(404);
    }
}
