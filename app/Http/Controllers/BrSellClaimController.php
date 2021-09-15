<?php

namespace App\Http\Controllers;

use App\SellClaim;
use App\SellClaimDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrSellClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claims = SellClaim::orderBy('created_at', 'desc')->paginate(15);
        return view('branchadmin.sellclaim.index',compact('claims'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branchadmin.sellclaim.create');
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
        // inserting claim
        $check = SellClaim::where('branch_id', $branch_id)->where('user_id', $request->user_id)->where('sell_order_id', $request->sell_order_id)->first();
        if ($check) {
            $result = SellClaimDetail::where('sell_claim_id', $check->id)->where('product_id', $request->product_id)->where('claim_status', 0)->first();
            if ($result) {
                Session::flash('warning', 'Product already added to customer claim.');
                return redirect()->back();
            } else {
                // inserting claim details
                SellClaimDetail::create([
                    'sell_claim_id' => $check->id,
                    'product_id' => $request->product_id,
                    'total_quantity' => $request->quantity,
                    'defect_reason' => $request->defect_reason
                ]);

                // updating stock

                Session::flash('info', 'Product added to customer claim.');
                return redirect('/branchadmin/br-customerclaim/' . $check->id);
            }
        } else {
            $claim = SellClaim::create([
                'branch_id' => $branch_id,
                'user_id' => $request->user_id,
                'sell_order_id' => $request->sell_order_id
            ]);

            // inserting claim details
            SellClaimDetail::create([
                'sell_claim_id' => $claim->id,
                'product_id' => $request->product_id,
                'total_quantity' => $request->quantity,
                'defect_reason' => $request->defect_reason
            ]);

            // updating stock

            Session::flash('info', 'Product added to customer claim.');
            return redirect('/branchadmin/br-customerclaim/' . $claim->id);
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
        return view('branchadmin.sellclaim.show', compact('claim'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $claim = SellClaim::find($id);
        return view('branchadmin.sellclaim.edit', compact('claim'));
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
        $claim = SellClaim::find($request->claim_id);

        foreach ($claim->sellClaimDetails->where('claim_status', 0) as $sellClaimDetail) {
            $sellClaimDetail->update([
                'claim_status' => 1
            ]);
        }

        Session::flash('info', 'Customer claim updated.');
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
        $claim = SellClaimDetail::find($request->claim_id);
        $claim->delete();

        Session::flash('info', 'Product removed.');
        return redirect()->back();
    }
}
