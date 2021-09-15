<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Customer;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
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
        $branch_id = session('shop')->id;
        if (Auth::guard('customer')->user()) {
            $customer_id = Auth::guard('customer')->id();

            $check = Cart::where('branch_id', $branch_id)->where('customer_id', $customer_id)->where('product_id', $request->product_id)->first();

            if ($check) {
                Session::flash('info', 'Product already added to Cart!');
                return redirect()->back();
            } else {
                Cart::create([
                    'branch_id' => $branch_id,
                    'customer_id' => $customer_id,
                    'product_id' => $request->product_id,
                    'quantity' => 1,
                    'status' => 0
                ]);

                Session::flash('success', 'Product added to Cart!');
                return redirect()->back();
            }

        } else {
            Session::flash('success', 'Product added to Cart!');
        }
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
        return view('links.cart.show', compact('customer'));
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
        $product = Cart::find($id);
        $product->delete();

        Session::flash('success', 'Done!');
        return redirect()->back();
    }
}
