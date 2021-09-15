<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductInStock;
use App\SellOrderDetail;
use App\SellOrderReturn;
use App\SellOrderReturnDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrSellOrderReturnDetailController extends Controller
{
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
        // checking conditions
        $purchasedProduct = SellOrderDetail::find($request->purchased_id);
        $returnProduct = SellOrderReturnDetail::where('sell_order_return_id', $request->return_id)->where('product_id', $request->product_id)->first();

        // validating quantity
        if ($returnProduct)
            $sum = $returnProduct->return_quantity + $request->return_quantity;
        else
            $sum = $request->return_quantity;
        $purchasedQuantity = $purchasedProduct->quantity;

        if ($purchasedQuantity >= $sum) {
            $product = Product::find($request->product_id);

            // calculating total quantity
            $subTotal = $request->return_quantity_1 / $product->product_unit_quantity;
            $total_quantity = $subTotal + $request->return_quantity_2;

            // inserting order return details
            SellOrderReturnDetail::create([
                'sell_order_return_id' => $request->return_id,
                'product_id' => $request->product_id,
                'return_unit' => $request->return_unit,
                'return_quantity' => $total_quantity,
                'status' => 0
            ]);

            Session::flash('info', 'Product return details added');
            return redirect()->back();
        } else {
            Session::flash('warning', 'Product quantity exceeds from the current Stock!');
            return redirect()->back();
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
        $orderReturn = SellOrderReturn::find($request->order_return_id);
        foreach ($orderReturn->sellOrderReturnDetails as $item) {

            // finding stock of product
            $stock = ProductInStock::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->where('product_id', $item->product_id)->first();

            switch ($item->return_unit) {
                case 'Item':
                    $total = $stock->total_stock + $item->return_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Pack':
                    $total = $stock->total_stock + $item->return_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Kilogram':
                    $total = $stock->total_stock + $item->return_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Liter':
                    $total = $stock->total_stock + $item->return_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Foot':
                    $total = $stock->total_stock + $item->return_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;
            }

            $item->update([
                'status' => 1
            ]);

        }

        Session::flash('info', 'Changes has been saved successfully.');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $returnOrder = SellOrderReturnDetail::find($request->order_return_id);
        $returnOrder->delete();

        Session::flash('info', 'Product removed from the Return Products Cart.');
        return redirect()->back();

    }
}
