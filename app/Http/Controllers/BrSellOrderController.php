<?php

namespace App\Http\Controllers;

use App\PurchasedOrder;
use App\SellOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Milon\Barcode\DNS1D;

class BrSellOrderController extends Controller
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
        $orders = SellOrder::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->where('status', 0)->orderBy('created_at', 'asc')->paginate(15);
        return view('branchadmin.sellorder.index', compact('orders'));
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
        $order = SellOrder::find($id);
        return view('branchadmin.sellorder.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = SellOrder::find($id);
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $orders = PurchasedOrder::where('branch_id', $branch_id)->get();
        $select_suppliers = [];
        $supplier_id = null;
        foreach ($orders as $item) {
            if ($item->user->userCategory->user_category_name == 'Supplier') {
                if ($supplier_id == $item->user_id) {
                    continue;
                } else {
                    $select_suppliers[$item->user_id] = $item->user->name;
                    $supplier_id = $item->user_id;
                }
            }
        }
        return view('branchadmin.sellorder.edit', compact('order','select_suppliers'));
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

        $order = SellOrder::find($id);

        $subTotal = 0;
        $grandTotal = 0;
        foreach ($order->sellOrderDetails as $detail) {
            $detail->update([
                'user_id' => $request->supplier_id
            ]);

            $sum = $detail->per_product_price * $detail->quantity;
            $subTotal = $subTotal + $sum;
            $grandTotal = $grandTotal + $subTotal;
        }

        $order->update([
            'invoice_no' => $request->invoice_no,
            'belty_no' => $request->belty_no,
            'received_by' => $order->customer->name,
            'discount_amount' => $request->discount_amount,
            'description' => $request->description,
            'status' => 1,
            'total_amount' => $grandTotal
        ]);

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
        return abort(403, 'Unauthorized Action');
    }
}
