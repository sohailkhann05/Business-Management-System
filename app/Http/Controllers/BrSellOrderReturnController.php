<?php

namespace App\Http\Controllers;

use App\SellOrder;
use App\SellOrderReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrSellOrderReturnController extends Controller
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
        $orders = SellOrder::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->orderBy('created_at', 'desc')->paginate(15);
        return view('branchadmin.sellorderreturn.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branchadmin.sellorderreturn.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'deducted_amount' => 'required',
            'description' => 'required'
        ]);

        $order = SellOrderReturn::create([
            'sell_order_id' => $request->sell_order_id,
            'deducted_amount' => $request->deducted_amount,
            'description' => $request->description
        ]);

        Session::flash('info', 'Sell order return created, add products you returned');
        return redirect('/branchadmin/br-sellorderreturn/' . $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderReturn = SellOrderReturn::find($id);
        return view('branchadmin.sellorderreturn.show', compact('orderReturn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderReturn = SellOrderReturn::find($id);
        return view('branchadmin.sellorderreturn.edit', compact('orderReturn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(403, 'Unauthorized Action');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(403, 'Unauthorized Action');
    }
}
