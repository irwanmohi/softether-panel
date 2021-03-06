<?php

namespace Modules\ResellerModule\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        return view('resellermodule::resellers.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('resellermodule::resellers.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:App\User,email',
            'password'  => 'required',
            'balance'   => 'required|integer|min:0'
        ]);

        if( user()->role != 'admin' ) {

            if( user()->balance < $request->balance ) {

                return response()->json([
                    'errors' => [
                        'balance' => [
                            'Your balance amount is not met the amount required to transfer the balance to the reseller.'
                        ]
                    ]
                ], 422);
            }

            user()->decrement('balance', $request->balance);
        }

        $user = User::create([
            'parent_id' => user()->id,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'balance'   => $request->balance,
            'role'      => (user()->isAdmin()) ? 'reseller' : 'sub-reseller'
        ]);

        return response()->json($user);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('resellermodule::resellers.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('resellermodule::resellers.index');
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
}
