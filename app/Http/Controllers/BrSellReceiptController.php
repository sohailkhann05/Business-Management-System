<?php

namespace App\Http\Controllers;

use App\SellClaim;
use App\SellClaimDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrSellReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claims = SellClaimDetail::orderBy('created_at', 'desc')->paginate(15);
        return view('branchadmin.sellreceipt.index', compact('claims'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branchadmin.sellreceipt.create');
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
            $claim = SellClaimDetail::find($request->detail_id);
            if ($request->check == 'No') {
                $claim->update([
                    'received_quantity' => $request->received_quantity,
                    'receipt_status' => 1
                ]);

                // updating stock

            } elseif ($request->check == 'Yes') {
                $remaining = $claim->total_quantity - $request->received_quantity;
                $claim->update([
                    'received_quantity' => $request->received_quantity,
                    'remaining_quantity' => $remaining
                ]);

                // updating stock
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
        $claim = SellClaim::find($id);
        return view('branchadmin.sellreceipt.show',compact('claim'));
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

        $claim = SellClaimDetail::find($request->receipt_id);
        // sum of inserted quantity adding them with received quantity for updation
        $sum_quantity = $claim->received_quantity + $request->received_quantity;
        if ($sum_quantity <= $request->total_quantity && $request->received_quantity > 0) {
            if ($request->check == 'No') {
                $claim->update([
                    'received_quantity' => $sum_quantity,
                    'receipt_status' => 1
                ]);

                // updating stock

            } elseif ($request->check == 'Yes') {
                $remaining = $claim->total_quantity - $sum_quantity;
                $claim->update([
                    'received_quantity' => $sum_quantity,
                    'remaining_quantity' => $remaining
                ]);

                // updating stock
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
