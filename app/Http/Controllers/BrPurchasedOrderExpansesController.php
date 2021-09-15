<?php

namespace App\Http\Controllers;

use App\PurchasedOrderExpanse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrPurchasedOrderExpansesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:branch-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(403, 'Unauthorized Action');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(403, 'Unauthorized Action');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'expanses_amount' => 'required',
            'description' => 'required'
        ]);

        PurchasedOrderExpanse::create([
            'purchased_order_id' => $request->purchased_order_id,
            'amount' => $request->expanses_amount,
            'description' => $request->description
        ]);

        Session::flash('info', 'Expanses added successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(403, 'Unauthorized Action');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(403, 'Unauthorized Action');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(403, 'Unauthorized Action');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(403, 'Unauthorized Action');
    }
}
