<?php

namespace Modules\Softether\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Softether\Entities\SoftetherServer;
use Modules\Softether\Entities\SoftetherAccount;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('softether::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('softether::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $accountId = decrypt($id);
        } catch(\Exception $e) {
            dd($e);

            return abort(404);
        }

        $account = SoftetherAccount::where('id', $accountId);

        if( ! user()->isAdmin() ) {
            $account->where('user_id', user()->id);
        }

        $account = $account->first();

        if( ! $account instanceof SoftetherAccount ) return abort(404);

        return view('softether::show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('softether::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function createAccount($server) {
        try {

            $serverId = decrypt($server);

            $softetherServer = SoftetherServer::find($serverId);

            if( ! $softetherServer instanceof SoftetherServer ) abort(404);

            if( ! user()->isAdmin() && user()->balance < $softetherServer->account_price ) abort(404);

        } catch(\Exception $e) {
            dd($e);
        }

        return view('softether::create_account', compact('softetherServer'));
    }
}
