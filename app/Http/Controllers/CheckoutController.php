<?php

namespace App\Http\Controllers;

use App\Customer;
use App\SellOrder;
use App\SellOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
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
        // creating order
        $order = SellOrder::create([
            'branch_id' => session('shop')->id,
            'customer_id' => Auth::guard('customer')->id(),
            'status' => 0
        ]);

        // creating order details
        foreach (Auth::guard('customer')->user()->carts as $cart) {
            SellOrderDetail::create([
                'product_id' => $cart->product_id,
                'sell_order_id' => $order->id,
                'per_product_price' => $cart->product->product_purchased_price,
                'sell_unit' => $cart->product->product_selling_unit,
                'quantity' => $cart->quantity
            ]);

            $cart->delete();
        }

        Session::flash('success', 'Done.');
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
        $customer = Customer::find($id);
        return view('links.checkout.show', compact('customer'));
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
