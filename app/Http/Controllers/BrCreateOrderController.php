<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\ProductInStock;
use App\PurchasedOrder;
use App\SellOrder;
use App\SellOrderDetail;
use App\User;
use App\UserAccountDetail;
use App\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrCreateOrderController extends Controller
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
        $categories = UserCategory::where('business_id', Auth::guard('branch-admin')->user()->branch->business_id)->orderBy('user_category_name', 'asc')->get();
        return view('branchadmin.createorder.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->quantity_1 == 0 || $request->quantity_1 == '') {
            Session::flash('info', 'Done');
            return redirect()->back();
        } else {
            $branch_id = Auth::guard('branch-admin')->user()->branch_id;
            $check = Cart::where('branch_id', $branch_id)->where('user_id', $request->user_id)->where('product_id', $request->product_id)->first();
            if ($check) {
                Session::flash('warning', 'Done');
                return redirect()->back();
            } else {
                $product = Product::find($request->product_id);
                $subTotal = $request->quantity_1 / $product->product_unit_quantity;
                $total_quantity = $subTotal + $request->quantity_2;
                if ($product->productInStock->total_stock >= $request->quantity) {

                    Cart::create([
                        'branch_id' => $branch_id,
                        'user_id' => $request->user_id,
                        'supplier_id' => $request->supplier_id,
                        'product_id' => $request->product_id,
                        'quantity' => $total_quantity,
                        'status' => 0
                    ]);

                    Session::flash('success', 'Done');
                    return redirect()->back();

                } else {
                    Session::flash('stock', 'Done');
                    return redirect()->back();
                }

            }
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
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $orders = PurchasedOrder::where('branch_id', $branch_id)->get();
        $select_suppliers = [];
        $supplier_id = null;
        foreach ($orders as $order) {
            if ($order->user->userCategory->user_category_name == 'Supplier') {
                if ($supplier_id == $order->user_id) {
                    continue;
                } else {
                    $select_suppliers[$order->user_id] = $order->user->name;
                    $supplier_id = $order->user_id;
                }
            }
        }

        $customer = User::find($id);
        $products = Product::where('branch_id', $branch_id)->paginate(10);
        return view('branchadmin.createorder.show', compact('customer', 'products', 'select_suppliers'));
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
        $this->validate($request, [
            'invoice_no' => 'required|unique:sell_orders,invoice_no',
            'belty_no' => 'required',
            'discount_amount' => 'required',
            'description' => 'required',
        ]);

        $customer = User::find($id);
        $subTotal = 0;
        $grandTotal = 0;

        // creating sell order
        $order = SellOrder::create([
            'branch_id' => Auth::guard('branch-admin')->user()->branch_id,
            'user_id' => $id,
            'invoice_no' => $request->invoice_no,
            'belty_no' => $request->belty_no,
            'received_by' => $customer->name,
            'discount_amount' => $request->discount_amount,
            'description' => $request->description
        ]);

        // creating sell order details from cart
        foreach ($customer->carts as $cart) {
            $detail = SellOrderDetail::create([
                'product_id' => $cart->product_id,
                'sell_order_id' => $order->id,
                'user_id' => $cart->supplier_id,
                'per_product_price' => $cart->product->product_purchased_price,
                'sell_unit' => $cart->product->product_selling_unit,
                'quantity' => $cart->quantity
            ]);

            // finding stock of product
            $stock = ProductInStock::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->where('product_id', $cart->product_id)->first();

            switch ($cart->product->product_purchased_unit) {
                case 'Item':
                    $total = $stock->total_stock - $cart->quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Pack':
                    $total = $stock->total_stock - $cart->quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Kilogram':
                    $total = $stock->total_stock - $cart->quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Liter':
                    $total = $stock->total_stock - $cart->quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Foot':
                    $total = $stock->total_stock - $cart->quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;
            }

            $sum = $detail->per_product_price * $cart->quantity;
            $subTotal = $subTotal + $sum;
            $grandTotal = $grandTotal + $subTotal;
            $cart->delete();
        }

        $order->update([
            'status' => 1,
            'total_amount' => $grandTotal
        ]);

        if ($request->amount) {
            // Updating supplier total balance
            $currentBalance = $customer->userAccount->balance_amount - $request->amount;
            $totalBalance = $currentBalance + $grandTotal;
            $customer->userAccount->update([
                'balance_amount' => $totalBalance
            ]);

            // creating transaction history
            UserAccountDetail::create([
                'user_account_id' => $customer->userAccount->id,
                'amount' => $request->amount,
                'transfer_type' => 'Deposit',
                'description' => 'These amount are given while creating order.',
                'transfer_date' => $order->created_at
            ]);

        } else {

            // Updating supplier total balance
            $currentBalance = $customer->userAccount->balance_amount;
            $totalBalance = $currentBalance + $grandTotal;
            $customer->userAccount->update([
                'balance_amount' => $totalBalance
            ]);

            // creating transaction history
            UserAccountDetail::create([
                'user_account_id' => $customer->userAccount->id,
                'amount' => $grandTotal,
                'transfer_type' => 'Withdraw',
                'description' => 'These amount are charged while creating order.',
                'transfer_date' => $order->created_at
            ]);

        }
        Session::flash('success', 'Done.');
        return redirect('/branchadmin/br-sellorderdetail/' . $order->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        Session::flash('delete', 'Done');
        return redirect()->back();
    }
}
