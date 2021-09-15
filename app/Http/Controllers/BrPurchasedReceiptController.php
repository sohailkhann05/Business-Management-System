<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductInStock;
use App\PurchasedClaim;
use App\PurchasedClaimDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrPurchasedReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claims = PurchasedClaimDetail::orderBy('created_at', 'desc')->paginate(15);
        return view('branchadmin.purchasedreceipt.index', compact('claims'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branchadmin.purchasedreceipt.create');
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
            'received_quantity|numeric|min:1|not_in:0',
            'check' => 'required'
        ]);

        if ($request->received_quantity <= $request->total_quantity && $request->received_quantity > 0) {
            $claim = PurchasedClaimDetail::find($request->detail_id);
            $product = Product::find($claim->product_id);
            // finding stock
            $stock = ProductInStock::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->where('product_id', $product->id)->first();

            if ($request->check == 'No') {
                $claim->update([
                    'received_quantity' => $request->received_quantity,
                    'receipt_status' => 1
                ]);

                // updating stock
                switch ($product->product_purchased_unit) {
                    case 'Item':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Pack':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Kilogram':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Liter':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Foot':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;
                }

            } elseif ($request->check == 'Yes') {
                $remaining = $claim->total_quantity - $request->received_quantity;
                $claim->update([
                    'received_quantity' => $request->received_quantity,
                    'remaining_quantity' => $remaining
                ]);

                // updating stock
                switch ($product->product_purchased_unit) {
                    case 'Item':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Pack':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Kilogram':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Liter':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Foot':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;
                }
            }
            Session::flash('info', 'Receipt updated successfully.');
            return redirect()->back();
        } else {
            Session::flash('warning', 'Quantity must not be zero or greater from Claim Quantity.');
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
        $claim = PurchasedClaim::find($id);
        return view('branchadmin.purchasedreceipt.show', compact('claim'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'received_quantity|numeric|min:1|not_in:0',
            'check' => 'required'
        ]);

        $claim = PurchasedClaimDetail::find($request->receipt_id);
        $product = Product::find($claim->product_id);
        // finding stock
        $stock = ProductInStock::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->where('product_id', $product->id)->first();

        // sum of inserted quantity adding them with received quantity for updation
        $sum_quantity = $claim->received_quantity + $request->received_quantity;
        if ($sum_quantity <= $request->total_quantity && $request->received_quantity > 0) {
            if ($request->check == 'No') {
                $claim->update([
                    'received_quantity' => $sum_quantity,
                    'receipt_status' => 1
                ]);

                // updating stock
                switch ($product->product_purchased_unit) {
                    case 'Item':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Pack':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Kilogram':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Liter':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Foot':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;
                }

            } elseif ($request->check == 'Yes') {
                $remaining = $claim->total_quantity - $sum_quantity;
                $claim->update([
                    'received_quantity' => $sum_quantity,
                    'remaining_quantity' => $remaining
                ]);

                // updating stock
                switch ($product->product_purchased_unit) {
                    case 'Item':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Pack':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Kilogram':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Liter':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;

                    case 'Foot':
                        $total = $stock->total_stock + $request->received_quantity;
                        $stock->update([
                            'total_stock' => $total
                        ]);
                        break;
                }
            }
            Session::flash('info', 'Receipt updated successfully.');
            return redirect()->back();
        } else {
            Session::flash('warning', 'Quantity must not be zero or greater from Claim Quantity.');
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
        //
    }
}
