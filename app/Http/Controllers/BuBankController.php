<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\BankAccountDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BuBankController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:business-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = BankAccount::where('business_id', Auth::guard('business-admin')->user()->business_id)->orderBy('created_at', 'desc')->get();
        return view('businessadmin.bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('businessadmin.bank.create');
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
            'bank_branch' => 'required',
            'account_name' => 'required',
            'account_no' => 'required',
            'total_amount' => 'required'
        ]);

        $bank = BankAccount::create([
            'business_id' => Auth::guard('business-admin')->user()->business_id,
            'bank_branch' => $request->bank_branch,
            'account_name' => $request->account_name,
            'account_no' => $request->account_no,
            'total_amount' => $request->total_amount
        ]);

        Session::flash('info', 'Bank account created successfully.');
        return redirect('/businessadmin/business-bank/' . $bank->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank = BankAccount::find($id);
        return view('businessadmin.bank.show', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = BankAccount::find($id);
        return view('businessadmin.bank.edit',compact('bank'));
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
            'description' => 'required'
        ]);

        if ($request->transfer_amount == '' || $request->transfer_amount == 0 || $request->transfer_amount < 0) {
            Session::flash('warning', 'Cash amount cannot be 0 or below 0.');
            return redirect()->back();
        } else {
            // Finding Bank
            $bank = BankAccount::find($id);
            switch ($request->transfer_type) {
                case 'Withdraw':
                    // calculating total cash amount
                    $currentAmount = $bank->total_amount;
                    $subAmount = $currentAmount - $request->transfer_amount;
                    // updating cash amount
                    $bank->update([
                        'total_amount' => $subAmount
                    ]);
                    break;

                case 'Deposit':
                    // calculating total cash amount
                    $currentAmount = $bank->total_amount;
                    $subAmount = $currentAmount + $request->transfer_amount;
                    // updating cash amount
                    $bank->update([
                        'total_amount' => $subAmount
                    ]);
                    break;
            }
        }

        // Creating History
        BankAccountDetail::create([
            'bank_account_id' => $id,
            'transfer_amount' => $request->transfer_amount,
            'transfer_type' => $request->transfer_type,
            'description' => $request->description
        ]);

        Session::flash('info', 'Cash amount updated successfully.');
        return redirect()->back();
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
