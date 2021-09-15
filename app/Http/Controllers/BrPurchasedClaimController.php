<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductInStock;
use App\PurchasedClaim;
use App\PurchasedClaimDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrPurchasedClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claims = PurchasedClaim::orderBy('created_at', 'desc')->paginate(15);
        return view('branchadmin.purchasedclaim.index', compact('claims'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branchadmin.purchasedclaim.create');
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
            'quantity' => 'required|numeric|min:0|not_in:0',
            'defect_reason' => 'required'
        ]);

        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $product = Product::find($request->product_id);

        // inserting claim
        $check = PurchasedClaim::where('branch_id', $branch_id)->where('user_id', $request->user_id)->where('purchased_order_id', $request->purchased_order_id)->first();
        if ($check) {
            $result = PurchasedClaimDetail::where('purchased_claim_id', $check->id)->where('product_id', $request->product_id)->where('claim_status', 0)->first();
            if ($result) {
                Session::flash('warning', 'Product already added to supplier claim.');
                return redirect()->back();
            } else {
                // inserting claim details
                PurchasedClaimDetail::create([
                    'purchased_claim_id' => $check->id,
                    'product_id' => $product->id,
                    'total_quantity' => $request->quantity,
                    'defect_reason' => $request->defect_reason
                ]);

                Session::flash('info', 'Product added to supplier claim.');
                return redirect('/branchadmin/br-supplierclaim/' . $check->id);
            }
        } else {
            $claim = PurchasedClaim::create([
                'branch_id' => $branch_id,
                'user_id' => $request->user_id,
                'purchased_order_id' => $request->purchased_order_id
            ]);

            // inserting claim details
            PurchasedClaimDetail::create([
                'purchased_claim_id' => $claim->id,
                'product_id' => $request->product_id,
                'total_quantity' => $request->quantity,
                'defect_reason' => $request->defect_reason
            ]);

            Session::flash('info', 'Product added to supplier claim.');
            return redirect('/branchadmin/br-supplierclaim/' . $claim->id);
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
        $claim = PurchasedClaim::find($id);
        return view('branchadmin.purchasedclaim.show', compact('claim'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $claim = PurchasedClaim::find($id);
        return view('branchadmin.purchasedclaim.edit', compact('claim'));
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
        $claim = PurchasedClaim::find($request->claim_id);
        // finding stock of product

        foreach ($claim->purchasedClaimDetails->where('claim_status', 0) as $purchasedClaimDetail) {

            // finding product
            $product = Product::find($purchasedClaimDetail->product_id);

            // finding stock
            $stock = ProductInStock::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->where('product_id', $product->id)->first();

            // updating stock
            switch ($product->product_purchased_unit) {
                case 'Item':
                    $total = $stock->total_stock - $purchasedClaimDetail->total_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Pack':
                    $total = $stock->total_stock - $purchasedClaimDetail->total_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Kilogram':
                    $total = $stock->total_stock - $purchasedClaimDetail->total_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Liter':
                    $total = $stock->total_stock - $purchasedClaimDetail->total_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;

                case 'Foot':
                    $total = $stock->total_stock - $purchasedClaimDetail->total_quantity;
                    $stock->update([
                        'total_stock' => $total
                    ]);
                    break;
            }

            $purchasedClaimDetail->update([
                'claim_status' => 1
            ]);

        }

        Session::flash('info', 'Supplier claim updated.');
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
        $claim = PurchasedClaimDetail::find($request->claim_id);

        // updating stock

        $claim->delete();

        Session::flash('info', 'Product removed.');
        return redirect()->back();
    }
}
