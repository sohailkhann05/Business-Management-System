<?php

namespace App\Http\Controllers\Auth;

use App\BranchCustomer;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class CustomerRegistration extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/myaccount';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|regex:/^[A-Z a-z]*$/',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|confirmed',
            'phone' => 'required|regex:/^[0-9]*$/',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'region' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            'region' => $data['region'],
        ]);

        // adding customer to particular branch
        $branch_id = session('shop')->id;
        $branchCustomer = BranchCustomer::where('branch_id', $branch_id)->where('customer_id', $customer->id)->first();
        if (!$branchCustomer) {
            BranchCustomer::create([
                'branch_id' => $branch_id,
                'customer_id' => $customer->id
            ]);
        }

        Auth::guard('customer')->login($customer);
        return $customer;
    }
}
