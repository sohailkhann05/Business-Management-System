<?php

namespace App\Http\Controllers;

use App\User;
use App\UserAccount;
use App\UserAccountDetail;
use App\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = UserCategory::where('business_id', Auth::guard('branch-admin')->user()->branch->business_id)->orderBy('user_category_name', 'asc')->get();
        $clients = User::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->orderBy('name', 'asc')->paginate(15);
        return view('branchadmin.customer.index', compact('clients', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = UserCategory::where('business_id', Auth::guard('branch-admin')->user()->branch->business_id)->orderBy('user_category_name', 'asc')->get();
        $select_category = [];
        foreach ($categories as $category) {
            if ($category->user_category_name == 'Supplier')
                continue;
            else
                $select_category[$category->id] = $category->user_category_name;
        }
        return view('branchadmin.customer.create', compact('select_category'));
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
            'user_category_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'address' => 'required',
            'region' => 'required'
        ]);

        $path = 'default.png';
        if ($request->has('profile_picture')) {
            $file = $request->profile_picture;
            $name = time() . $file->getClientOriginalName();
            $file->move('public/uploads/client/', $name);
            $path = $name;
        }

        $user = User::create([
            'user_category_id' => $request->user_category_id,
            'branch_id' => Auth::guard('branch-admin')->user()->branch_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'region' => $request->region,
            'profile_picture' => $path,
            'hint' => $request->password
        ]);

        UserAccount::create([
            'user_id' => $user->id,
            'balance_amount' => 0
        ]);

        Session::flash('info', 'Customer created successfully.');
        return redirect('/branchadmin/br-customer/' . $user->id);

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
        return view('branchadmin.customer.show', compact('client'));

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
            'amount' => 'required',
            'transfer_type' => 'required',
            'transfer_date' => 'required',
            'description' => 'required'
        ]);

        if ($request->amount == 0 || $request->amount < 0) {
            Session::flash('warning', 'Amount cannot be 0 or below 0.');
            return redirect()->back();
        } else {
            $client = User::find($id);

            // updating current balance amount
            switch ($request->transfer_type) {
                case 'Withdraw':
                    $currentBalance = $client->userAccount->balance_amount;
                    $totalBalance = $currentBalance + $request->amount;
                    $client->userAccount->update([
                        'balance_amount' => $totalBalance
                    ]);
                    break;

                case 'Deposit':
                    $currentBalance = $client->userAccount->balance_amount;
                    $totalBalance = $currentBalance - $request->amount;
                    $client->userAccount->update([
                        'balance_amount' => $totalBalance
                    ]);
                    break;
            }

            // creating transaction history
            UserAccountDetail::create([
                'user_account_id' => $client->userAccount->id,
                'amount' => $request->amount,
                'transfer_type' => $request->transfer_type,
                'description' => $request->description,
                'transfer_date' => $request->transfer_date
            ]);

            Session::flash('info', 'Transaction executed successfully.');
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
