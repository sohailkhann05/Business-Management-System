<?php

namespace App\Http\Controllers;

use App\PurchasedOrder;
use App\PurchasedOrderReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrPurchasedOrderReturnController extends Controller
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
        $orders = PurchasedOrder::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->orderBy('created_at', 'desc')->paginate(15);
        return view('branchadmin.purchasedorderreturn.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branchadmin.purchasedorderreturn.create');
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
            'deducted_amount' => 'required',
            'description' => 'required'
        ]);

        $order = PurchasedOrderReturn::create([
            'purchased_order_id' => $request->purchased_order_id,
            'deducted_amount' => $request->deducted_amount,
            'description' => $request->description
        ]);

        Session::flash('info', 'Purchased order return created, add products you returned');
        return redirect('/branchadmin/br-purchasedorderreturn/' . $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderReturn = PurchasedOrderReturn::find($id);
        return view('branchadmin.purchasedorderreturn.show', compact('orderReturn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderReturn = PurchasedOrderReturn::find($id);
        return view('branchadmin.purchasedorderreturn.edit', compact('orderReturn'));
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
