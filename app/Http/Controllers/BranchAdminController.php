<?php

namespace App\Http\Controllers;

use App\BranchCustomer;
use App\Product;
use App\PurchasedClaim;
use App\PurchasedOrder;
use App\SellClaim;
use App\SellOrder;
use App\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchAdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $business_id = Auth::guard('branch-admin')->user()->branch->business_id;

        // finding all clients
        $customer = 0;
        $marketing_manager = 0;
        $supplier = 0;
        $vehicle = 0;
        $categories = UserCategory::where('business_id', $business_id)->get();
        foreach ($categories as $category) {
            foreach ($category->users as $user) {
                switch ($category->user_category_name) {
                    case 'Customer':
                        $customer++;
                        break;
                    case 'Marketing Manager':
                        $marketing_manager++;
                        break;
                    case 'Supplier':
                        $supplier++;
                        break;
                    case 'Vehicle':
                        $vehicle++;
                        break;
                }
            }
        }

        // finding all orders
        $purchases = PurchasedOrder::where('branch_id', $branch_id)->get()->count();
        $sells = SellOrder::where('branch_id', $branch_id)->get()->count();
        $sell_claims = SellClaim::where('branch_id', $branch_id)->get()->count();
        $purchase_claims = PurchasedClaim::where('branch_id', $branch_id)->get()->count();
        $online_customers = BranchCustomer::where('branch_id', $branch_id)->get()->count();

        // finding products
        $products = Product::where('branch_id', $branch_id)->orderBy('product_name', 'asc')->get();

        return view('branchadmin.dashboard', compact('customer', 'marketing_manager', 'supplier', 'vehicle', 'purchases', 'sells', 'purchase_claims', 'sell_claims', 'products','online_customers'));
    }
}
