<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductInStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrStockAdjustmentController extends Controller
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
        return abort(403, 'Unauthorized Action');
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
        if ($request->purchased_quantity_1 == null || $request->purchased_quantity_2 == null) {
            Session::flash('warning', 'Stock quantity must not be empty.');
            return redirect()->back();
        } else {
            $stock = ProductInStock::find($request->stock_id);
            $product = Product::find($request->product_id);

            $sum = $request->purchased_quantity_1 * $product->product_unit_quantity;
            $subTotal = $sum + $request->purchased_quantity_2;
            $total = $stock->total_stock + $subTotal;
            $stock->update([
                'total_stock' => $total
            ]);

            Session::flash('info', 'Stock updated successfully.');
            return redirect()->back();
        }
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
