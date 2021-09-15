<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductInStock;
use App\ProductPurchased;
use App\PurchasedOrderReturn;
use App\PurchasedOrderReturnDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrPurchasedOrderReturnDetailController extends Controller
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
        // checking conditions
        $purchasedProduct = ProductPurchased::find($request->purchased_id);
        $returnProduct = PurchasedOrderReturnDetail::where('purchased_order_return_id', $request->return_id)->where('product_id', $request->product_id)->first();
        $product = Product::find($request->product_id);

        // validating quantity
        if ($returnProduct) {
            $minQuantity = $request->return_quantity_1 / $product->product_unit_quantity;
            $subTotal = $minQuantity + $request->return_quantity_2;
            $sum = $returnProduct->return_quantity + $subTotal;
        } else {
            $minQuantity = $request->return_quantity_1 / $product->product_unit_quantity;
            $sum = $minQuantity + $request->return_quantity_2;
        }

        $purchasedQuantity = $purchasedProduct->product_purchased_quantity;

        if ($purchasedQuantity >= $sum) {

            // inserting order return details
            PurchasedOrderReturnDetail::create([
                'purchased_order_return_id' => $request->return_id,
                'product_id' => $request->product_id,
                'return_unit' => $request->return_unit,
                'return_quantity' => $sum,
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
        $orderReturn = PurchasedOrderReturn::find($request->order_return_id);
        foreach ($orderReturn->purchasedOrderReturnDetails as $item) {

            // finding stock of product
            $stock = ProductInStock::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->where('product_id', $item->product_id)->first();

            switch ($item->return_unit) {
                case 'Item':
                    $total = $stock->total_stock - $item->return_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Pack':
                    $total = $stock->total_stock - $item->return_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Kilogram':
                    $total = $stock->total_stock - $item->return_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Liter':
                    $total = $stock->total_stock - $item->return_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Foot':
                    $total = $stock->total_stock - $item->return_quantity;
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
    public
    function destroy(Request $request, $id)
    {
        $returnOrder = PurchasedOrderReturnDetail::find($request->order_return_id);
        $returnOrder->delete();

        Session::flash('info', 'Product removed from the Return Products Cart.');
        return redirect()->back();
    }
}
