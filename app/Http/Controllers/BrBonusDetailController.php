<?php

namespace App\Http\Controllers;

use App\ProductBonus;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\Request;

class BrBonusDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonuses = ProductBonus::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('branchadmin.calculatebonusdetail.index', compact('bonuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bonus = ProductBonus::find($id);
        return view('branchadmin.calculatebonusdetail.show', compact('bonus'));
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
        $grandTotal = 0;

        // finding current bonus record
        $bonus = ProductBonus::find($id);

        // calculating total sales record
        foreach ($bonus->productBonusDetails as $bonusDetail) {
            foreach ($bonusDetail->product->sellOrderDetails()->where('user_id', $bonus->user_id)->whereBetween('created_at', [$bonus->start_date, $bonus->end_date])->get() as $sellOrderDetail) {
                // calculating total amount
                $subTotal = $bonusDetail->product->product_purchased_price * $sellOrderDetail->quantity;
                $grandTotal = $grandTotal + $subTotal;

                // updating total sales & amount in product bonus details
                $bonusDetail->update([
                    'total_sales' => $sellOrderDetail->quantity,
                    'total_amount' => $subTotal
                ]);

            }
        }

        // updating bonus
        $bonus->update([
            'total' => $grandTotal,
            'status' => 1
        ]);

        // redirecting
        Session::flash('info', 'Bonus calculated successfully.');
        return redirect('/branchadmin/br-supplierbonusdetail/' . $bonus->id);
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
