<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function customerBalance()
    {
        $business_id = Auth::guard('branch-admin')->user()->branch->business_id;
        $category = UserCategory::where('business_id', $business_id)->where('user_category_name', 'Customer')->first();
        $customers = User::where('user_category_id', $category->id)->orderBy('name', 'asc')->get();
        return view('branchadmin.reports.customer_balance', compact('customers'));
    }

    public function customerLedger()
    {
        return view('branchadmin.reports.customer_ledger');
    }

    public function grossProfitLoss()
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $products = Product::where('branch_id', $branch_id)->orderBy('product_name', 'asc')->get();
        return view('branchadmin.reports.gross_profit_loss', compact('products'));
    }

    public function openingStock()
    {
        return view('branchadmin.reports.opening_stock');
    }

    public function productWiseStock()
    {
        return view('branchadmin.reports.product_wise_stock');
    }

    public function purchaseRegister()
    {
        $business_id = Auth::guard('branch-admin')->user()->branch->business_id;
        $category_collection = UserCategory::where('business_id', $business_id)->where('user_category_name', 'Supplier')->with('users')->get();
        return view('branchadmin.reports.purchase_register', compact('category_collection'));
    }

    public function sellRegister()
    {
        return view('branchadmin.reports.sell_register');
    }

    public function supplierBalance()
    {
        return view('branchadmin.reports.supplier_balance');
    }

    public function supplierLedger()
    {
        $business_id = Auth::guard('branch-admin')->user()->branch->business_id;
        $category_collection = UserCategory::where('business_id', $business_id)->where('user_category_name', 'Supplier')->with('users')->get();
        return view('branchadmin.reports.supplier_ledger',compact('category_collection'));
    }

    public function trailBalance()
    {
        return view('branchadmin.reports.trail_balance');
    }

    public function purchaseClaim()
    {
        $business_id = Auth::guard('branch-admin')->user()->branch->business_id;
        $category_collection = UserCategory::where('business_id', $business_id)->where('user_category_name', 'Supplier')->with('users')->get();
        return view('branchadmin.reports.purchase_claim', compact('category_collection'));
    }

    public function sellClaim()
    {
        return view('branchadmin.reports.sell_claim');
    }
}