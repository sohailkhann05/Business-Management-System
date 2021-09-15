<?php

namespace App\Http\Controllers;

use App\Product;
use App\PurchasedOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrPurchasedOrderController extends Controller
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
        return view('branchadmin.purchasedorder.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select_users = [];
        foreach (Auth::guard('branch-admin')->user()->branch->users as $user) {
            if ($user->userCategory->user_category_name == 'Supplier') {
                $select_users[$user->id] = $user->name;
            }
        }

        return view('branchadmin.purchasedorder.create', compact('select_users'));
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
            'invoice_no' => 'required|unique:purchased_orders,invoice_no',
            'belty_no' => 'required',
            'received_by' => 'required',
            'discount_amount' => 'required',
            'description' => 'required',
        ]);

        $order = PurchasedOrder::create([
            'branch_id' => Auth::guard('branch-admin')->user()->branch_id,
            'user_id' => $request->user_id,
            'invoice_no' => $request->invoice_no,
            'belty_no' => $request->belty_no,
            'received_by' => $request->received_by,
            'discount_amount' => $request->discount_amount,
            'description' => $request->description
        ]);

        Session::flash('info', 'Purchased order created successfully.');
        return redirect('/branchadmin/br-purchasedorder/' . $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = PurchasedOrder::find($id);
        $select_product = [];
        $products = Product::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->orderBy('product_name', 'asc')->get();
        foreach ($products as $product) {
            $select_product[$product->id] = $product->product_name;
        }
        return view('branchadmin.purchasedorder.show', compact('order', 'select_product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = PurchasedOrder::find($id);
        return view('branchadmin.purchasedorder.edit',compact('order'));
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
