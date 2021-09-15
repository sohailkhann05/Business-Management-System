<?php

namespace App\Http\Controllers;

use App\BonusCheck;
use App\Product;
use App\ProductBonus;
use App\ProductInStock;
use App\ProductPurchased;
use App\PurchasedOrder;
use App\User;
use App\UserAccountDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrProductPurchasedController extends Controller
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
            'product_id' => 'required',
            'per_product_price' => 'required'
        ]);

        $check = ProductPurchased::where('purchased_order_id', $request->purchased_order_id)->where('product_id', $request->product_id)->first();
        if ($check) {
            Session::flash('warning', 'Product already added to cart.');
            return redirect()->back();
        } else {
            // calculating total quantity
            $product = Product::find($request->product_id);
            $subQuantity = $request->purchased_quantity_1 * $product->product_unit_quantity;
            $purchasedQuantity = $subQuantity + $request->purchased_quantity_2;

            // creating purchased products
            ProductPurchased::create([
                'purchased_order_id' => $request->purchased_order_id,
                'product_id' => $request->product_id,
                'per_product_price' => $request->per_product_price,
                'product_purchased_quantity' => $purchasedQuantity,
                'product_purchased_unit' => $request->product_purchased_unit,
                'status' => 0
            ]);

            Session::flash('info', 'Product added to cart');
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
        $order = PurchasedOrder::find($request->order_id);
        $grandTotal = 0;

        foreach ($order->productPurchased as $item) {
            // finding stock of product
            $stock = ProductInStock::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->where('product_id', $item->product_id)->first();

            // updating stock
            switch ($item->product_purchased_unit) {
                case 'Item':
                    $total = $stock->total_stock + $item->product_purchased_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Pack':
                    $total = $stock->total_stock + $item->product_purchased_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Kilogram':
                    $total = $stock->total_stock + $item->product_purchased_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Liter':
                    $total = $stock->total_stock + $item->product_purchased_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Foot':
                    $total = $stock->total_stock + $item->product_purchased_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;
            }

            $subTotal = $item->product_purchased_quantity * $item->per_product_price;
            $grandTotal = $grandTotal + $subTotal;

            // inserting bonus products
            if ($item->product->bonus_check) {
                $productInBonusTb = BonusCheck::where('user_id', $order->user_id)->where('product_id', $item->product_id)->first();
                if (!$productInBonusTb) {
                    BonusCheck::create([
                        'user_id' => $order->user_id,
                        'product_id' => $item->product_id
                    ]);
                }
            }

            // updating current product for order purchased
            $item->update([
                'status' => 1
            ]);
        }

        // Updating supplier total balance
        $supplier = User::find($order->user_id);
        $currentBalance = $supplier->userAccount->balance_amount;
        $totalBalance = $currentBalance + $grandTotal;
        $supplier->userAccount->update([
            'balance_amount' => $totalBalance
        ]);

        // creating transaction history
        UserAccountDetail::create([
            'user_account_id' => $supplier->userAccount->id,
            'amount' => $grandTotal,
            'transfer_type' => 'Withdraw',
            'description' => '.',
            'transfer_date' => $order->created_at
        ]);

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
        $product = ProductPurchased::find($request->product_id);
        $product->delete();

        Session::flash('info', 'Product removed from the Cart successfully.');
        return redirect()->back();
    }
}
