<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductBonus;
use App\ProductBonusDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrBonusController extends Controller
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
        ProductBonus::create([
            'branch_id' => Auth::guard('branch-admin')->user()->branch_id,
            'user_id' => $request->user_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'percentage' => $request->percentage
        ]);

        Session::flash('info', 'Resource created, complete bonus calculation.');
        return redirect('/branchadmin/br-supplierbonus/' . $request->user_id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = User::find($id);
        return view('branchadmin.calculatebonus.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //    $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $user = User::find($id);
        return view('branchadmin.calculatebonus.edit', compact('user'));
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
        ProductBonusDetail::create([
            'product_bonus_id' => $id,
            'product_id' => $request->product_id
        ]);

        Session::flash('info', 'Product added');
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
        $bonus = ProductBonusDetail::find($id);
        $bonus->delete();

        Session::flash('info', 'Product removed');
        return redirect()->back();
    }
}
