<?php

namespace App\Http\Controllers;

use App\CashAccount;
use App\CashAccountDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrCashController extends Controller
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
        $cashes = CashAccount::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->orderBy('created_at', 'asc')->get();
        return view('branchadmin.cash.index', compact('cashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branchadmin.cash.create');
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
            'total_amount' => 'required'
        ]);

        $cash = CashAccount::create([
            'branch_id' => Auth::guard('branch-admin')->user()->branch_id,
            'total_amount' => $request->total_amount
        ]);

        Session::flash('info', 'Cash account created successfully.');
        return redirect('/branchadmin/br-cash/' . $cash->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cash = CashAccount::find($id);
        return view('branchadmin.cash.show', compact('cash'));
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
//        $cash = CashAccount::find($id);
//        return view('branchadmin.cash.edit',compact('cash'));
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
            'transfer_amount' => 'required',
            'transfer_type' => 'required',
            'cash_description' => 'required'
        ]);

        if ($request->transfer_amount == '' || $request->transfer_amount == 0 || $request->transfer_amount < 0) {
            Session::flash('warning', 'Cash amount cannot be 0 or below 0.');
            return redirect()->back();
        } else {
            // Finding current cash account
            $cash = CashAccount::find($id);

            switch ($request->transfer_type) {
                case 'Withdraw':
                    // calculating total cash amount
                    $currentAmount = $cash->total_amount;
                    $subAmount = $currentAmount - $request->transfer_amount;
                    // updating cash amount
                    $cash->update([
                        'total_amount' => $subAmount
                    ]);
                    break;

                case 'Deposit':
                    // calculating total cash amount
                    $currentAmount = $cash->total_amount;
                    $subAmount = $currentAmount + $request->transfer_amount;
                    // updating cash amount
                    $cash->update([
                        'total_amount' => $subAmount
                    ]);
                    break;
            }

            // creating transaction history
            CashAccountDetail::create([
                'cash_account_id' => $cash->id,
                'cash_description' => $request->cash_description,
                'transfer_amount' => $request->transfer_amount,
                'transfer_type' => $request->transfer_type
            ]);

            Session::flash('info', 'Cash amount updated successfully.');
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
        return abort(403, 'Unauthorized Action');
    }
}
