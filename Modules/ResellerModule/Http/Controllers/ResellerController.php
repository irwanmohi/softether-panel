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
        $resellers = User::where('role', 'reseller')->where('id', '!=', user()->id);

        if( user()->role == 'reseller' ) {

            $resellers->where('parent_id', user()->id);

        }

        if( setting('reseller_module_allow_reseller_to_add_another_reseller')->value )  {

            $resellers->orWhere('role', 'sub-reseller');

        }

        $resellers = $resellers->get();

        return view('resellermodule::resellers.index', compact('resellers'));
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
                            'Your balance amount is not met the amount of transferred balance to the reseller.'
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
        return view('resellermodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('resellermodule::edit');
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
