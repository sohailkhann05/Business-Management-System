<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CashAccount;
use App\Customer;
use App\Product;
use App\ProductPurchased;
use App\PurchasedClaim;
use App\PurchasedOrder;
use App\PurchasedOrderReturnDetail;
use App\SellClaim;
use App\SellOrder;
use App\SellOrderDetail;
use App\SellOrderReturnDetail;
use App\User;
use App\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function editQuantity(Request $request)
    {
        $id = $request->id;
        $product = ProductPurchased::find($id);
        $unit = $product->product_purchased_unit;
        $quantity = $request->quantity;
        return view('branchadmin.multi-data.editquantity', compact('quantity', 'id', 'unit'));
    }

    public function updateQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $product = ProductPurchased::find($id);
        $product->update([
            'product_purchased_quantity' => $quantity
        ]);

        return view('branchadmin.multi-data.updatequantity', compact('id', 'quantity'));
    }

    public function searchInvoice(Request $request)
    {
        $order = PurchasedOrder::where('invoice_no', $request->invoice_no)->first();
        return view('branchadmin.multi-data.purchasedordersearch', compact('order'));
    }

    public function branchSearchInvoice(Request $request)
    {
        $order = PurchasedOrder::where('invoice_no', $request->invoice_no)->first();
        return view('branchadmin.multi-data.branchsearchinvoice', compact('order'));
    }

    public function searchSellInvoice(Request $request)
    {
        $order = SellOrder::where('invoice_no', $request->invoice_no)->first();
        return view('branchadmin.multi-data.sellordersearch', compact('order'));
    }

    public function productDetails(Request $request)
    {
        $order_return_id = $request->order_return_id;
        $product = ProductPurchased::where('purchased_order_id', $request->purchased_order_id)->where('product_id', $request->product_id)->first();
        $unit = $product->product->product_purchased_unit;

        switch ($unit) {
            case 'Item':
                return view('branchadmin.multi-data.item_productcartdetails', compact('product', 'order_return_id'));
                break;
            case 'Pack':
                return view('branchadmin.multi-data.pack_productcartdetails', compact('product', 'order_return_id'));
                break;
            case 'Kilogram':
                return view('branchadmin.multi-data.kilogram_productcartdetails', compact('product', 'order_return_id'));
                break;
            case 'Liter':
                return view('branchadmin.multi-data.liter_productcartdetails', compact('product', 'order_return_id'));
                break;
            case 'Foot':
                return view('branchadmin.multi-data.foot_productcartdetails', compact('product', 'order_return_id'));
                break;
        }
    }

    public function sellProductDetails(Request $request)
    {
        $order_return_id = $request->order_return_id;
        $product = SellOrderDetail::where('sell_order_id', $request->sell_order_id)->where('product_id', $request->product_id)->first();
        $unit = $product->product->product_purchased_unit;
        switch ($unit) {
            case 'Item':
                return view('branchadmin.multi-data.item_sellproductcartdetails', compact('product', 'order_return_id'));
                break;
            case 'Pack':
                return view('branchadmin.multi-data.pack_sellproductcartdetails', compact('product', 'order_return_id'));
                break;
            case 'Kilogram':
                return view('branchadmin.multi-data.kilogram_sellproductcartdetails', compact('product', 'order_return_id'));
                break;
            case 'Liter':
                return view('branchadmin.multi-data.litersellproductcartdetails', compact('product', 'order_return_id'));
                break;
            case 'Foot':
                return view('branchadmin.multi-data.foot_sellproductcartdetails', compact('product', 'order_return_id'));
                break;
        }
    }

    public function editReturnQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        return view('branchadmin.multi-data.editreturnquantity', compact('quantity', 'id'));
    }

    public function updateReturnQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $returnOrder = PurchasedOrderReturnDetail::find($id);
        $returnOrder->update([
            'return_quantity' => $quantity
        ]);

        return view('branchadmin.multi-data.updatereturnquantity', compact('id', 'quantity'));
    }

    public function updateSellReturnQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $returnOrder = SellOrderReturnDetail::find($id);
        $returnOrder->update([
            'return_quantity' => $quantity
        ]);

        return view('branchadmin.multi-data.updatesellreturnquantity', compact('id', 'quantity'));
    }

    public function searchCustomer(Request $request)
    {
        $customers = User::where('user_category_id', $request->category_id)->where('name', 'Like', '%' . $request->name . '%')->get();
        return view('branchadmin.multi-data.searchcustomer', compact('customers'));
    }

    public function editUserQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        return view('branchadmin.multi-data.editquantity', compact('quantity', 'id'));
    }

    public function updateUserQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $returnOrder = Cart::find($id);
        $returnOrder->update([
            'quantity' => $quantity
        ]);

        return view('branchadmin.multi-data.updatequantity', compact('id', 'quantity'));
    }

    public function purchasedUnit(Request $request)
    {
        $product = Product::find($request->product_id);
        switch ($product->product_purchased_unit) {
            case 'Item':
                return view('branchadmin.multi-data.purchasedunit_item', compact('product'));
                break;
            case 'Pack':
                return view('branchadmin.multi-data.purchasedunit_pack', compact('product'));
                break;
            case 'Kilogram':
                return view('branchadmin.multi-data.purchasedunit_kilogram', compact('product'));
                break;
            case 'Liter':
                return view('branchadmin.multi-data.purchasedunit_liter', compact('product'));
                break;
            case 'Foot':
                return view('branchadmin.multi-data.purchasedunit_foot', compact('product'));
                break;
        }
    }

    public function editCustomerQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        return view('branchadmin.multi-data.editreturnquantity', compact('quantity', 'id'));
    }

    public function updateCustomerQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $cart = Cart::find($id);
        $cart->update([
            'quantity' => $quantity
        ]);

        return view('branchadmin.multi-data.customerupdatequantity', compact('id', 'quantity'));
    }

    public function searchType(Request $request)
    {
        switch ($request->search_type) {
            case 'Name':
                return view('branchadmin.multi-data.searchtype_name');
                break;
            case 'Phone':
                return view('branchadmin.multi-data.searchtype_phone');
                break;
        }
    }

    public function searchSupplierByName(Request $request)
    {
        $suppliers = User::where('name', 'LIKE', $request->supplier_name . '%')->get();
        return view('branchadmin.multi-data.searchresult_supplierphone', compact('suppliers'));
    }

    public function searchSupplierByPhone(Request $request)
    {
        $suppliers = User::where('phone', 'LIKE', $request->supplier_phone . '%')->get();
        return view('branchadmin.multi-data.searchresult_suppliername', compact('suppliers'));
    }

    public function searchTypeCustomer(Request $request)
    {
        switch ($request->search_type) {
            case 'Name':
                return view('branchadmin.multi-data.searchtypecustomer_name');
                break;
            case 'Phone':
                return view('branchadmin.multi-data.searchtypecustomer_phone');
                break;
        }
    }

    public function searchCustomerByName(Request $request)
    {
        $suppliers = User::where('user_category_id', $request->category_id)->where('name', 'LIKE', $request->supplier_name . '%')->get();
        return view('branchadmin.multi-data.searchresult_customerphone', compact('suppliers'));
    }

    public function searchCustomerByPhone(Request $request)
    {
        $suppliers = User::where('user_category_id', $request->category_id)->where('phone', 'LIKE', $request->supplier_phone . '%')->get();
        return view('branchadmin.multi-data.searchresult_customername', compact('suppliers'));
    }

    public function productSearch(Request $request)
    {
        $products = Product::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->where('product_name', 'LIKE', $request->search_text . '%')->get();
        return view('branchadmin.multi-data.searchproduct', compact('products'));
    }

    public function purchasedClaimSupplier(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $product = Product::where('branch_id', $branch_id)->where('product_name', 'LIKE', $request->product . '%')->first();
        if ($product != null) {
            $purchases = ProductPurchased::where('product_id', $product->id)->get();
            return view('branchadmin.multi-data.purchasedclaim_supplier', compact('purchases'));
        } else
            return null;
    }

    public function purchasedClaimSearch(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $product = Product::where('branch_id', $branch_id)->where('product_name', 'LIKE', $request->product . '%')->first();
        $orders = PurchasedOrder::where('user_id', $request->supplier_id)->get();
        $user = User::find($request->supplier_id);
        return view('branchadmin.multi-data.purchasedclaim_search', compact('orders', 'product', 'user'));
    }

    public function sellClaimCustomer(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $product = Product::where('branch_id', $branch_id)->where('product_name', 'LIKE', $request->product . '%')->first();
        if ($product != null) {
            $sells = SellOrderDetail::where('product_id', $product->id)->get();
            return view('branchadmin.multi-data.sellclaim_customer', compact('sells'));
        } else
            return null;
    }

    public function sellClaimSearch(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $product = Product::where('branch_id', $branch_id)->where('product_name', 'LIKE', $request->product . '%')->first();
        $sells = SellOrder::where('user_id', $request->customer_id)->get();
        $customer = User::find($request->customer_id);
        return view('branchadmin.multi-data.sellclaim_search', compact('sells', 'product', 'customer'));
    }

    public function getSupplier(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $category = UserCategory::where('user_category_name', 'Supplier')->first();
        $users = User::where('branch_id', $branch_id)->where('user_category_id', $category->id)->where('name', 'LIKE', $request->name . '%')->get();
        return view('branchadmin.multi-data.receipt_getsupplier', compact('users'));
    }

    public function getSupplierData(Request $request)
    {
        $supplier = User::find($request->supplier_id);
        return view('branchadmin.multi-data.receipt_getsupplierdata', compact('supplier'));
    }

    public function getCustomer(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $category = UserCategory::where('user_category_name', 'Customer')->first();
        $category->user_category_name;
        $users = User::where('branch_id', $branch_id)->where('user_category_id', $category->id)->where('name', 'LIKE', $request->name . '%')->get();
        return view('branchadmin.multi-data.receipt_getcustomer', compact('users'));
    }

    public function getCustomerData(Request $request)
    {
        $customer = User::find($request->customer_id);
        return view('branchadmin.multi-data.receipt_getcustomerdata', compact('customer'));
    }

    public function searchProductWise(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $product = Product::where('branch_id', $branch_id)->where('product_name', 'LIKE', $request->product_name . '%')->first();
        return view('branchadmin.multi-data.productwise_report', compact('product', 'from_date', 'to_date'));
    }

    public function purchaseRegister(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $supplier = User::find($request->supplier_id);
        $orders_collection = PurchasedOrder::where('branch_id', $branch_id)->where('user_id', $request->supplier_id)->whereBetween('created_at', [$request->from_date, $request->to_date])->with('productPurchased')->get();
        return view('branchadmin.multi-data.purchaseregister_report', compact('orders_collection', 'supplier'));
    }

    public function getCustomerType(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch->business_id;
        $category_collection = UserCategory::where('business_id', $branch_id)->where('user_category_name', $request->type)->with('users')->get();
        return view('branchadmin.multi-data.getcustomertype', compact('category_collection'));
    }

    public function sellRegister(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $customer = User::find($request->customer_id);
        $orders_collection = SellOrder::where('branch_id', $branch_id)->where('user_id', $customer->id)->whereBetween('created_at', [$request->from_date, $request->to_date])->with('sellOrderDetails')->get();
        return view('branchadmin.multi-data.sellregister_report', compact('orders_collection', 'customer'));
    }

    public function purchaseClaim(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $supplier = User::find($request->supplier_id);
        $claim_collection = PurchasedClaim::where('branch_id', $branch_id)->where('user_id', $supplier->id)->whereBetween('created_at', [$request->from_date, $request->to_date])->with('purchasedClaimDetails')->get();
        return view('branchadmin.multi-data.purchaseclaim_report', compact('claim_collection', 'supplier'));
    }

    public function sellClaim(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $customer = User::find($request->customer_id);
        $claim_collection = SellClaim::where('branch_id', $branch_id)->where('user_id', $customer->id)->whereBetween('created_at', [$request->from_date, $request->to_date])->with('sellClaimDetails')->get();
        return view('branchadmin.multi-data.sellclaim_report', compact('claim_collection', 'customer'));
    }

    public function grossProfitLoss(Request $request)
    {
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        if ($request->product_id == 'All Product') {
            $purchased_collection = PurchasedOrder::where('branch_id', $branch_id)->whereBetween('created_at', [$request->from_date, $request->to_date])->orderBy('created_at', 'asc')->with('productPurchased')->get();
            $sell_collection = SellOrder::where('branch_id', $branch_id)->whereBetween('created_at', [$request->from_date, $request->to_date])->orderBy('created_at', 'asc')->with('sellOrderDetails')->get();
            return view('branchadmin.multi-data.grossprofit_report_all', compact('purchased_collection', 'sell_collection'));
        } else {
            $product = Product::find($request->product_id);
            $purchased_collection = ProductPurchased::where('product_id', $request->product_id)->whereBetween('created_at', [$request->from_date, $request->to_date])->with('purchasedOrder')->get();
            $sell_collection = SellOrderDetail::where('product_id', $request->product_id)->whereBetween('created_at', [$request->from_date, $request->to_date])->with('sellOrder')->get();
            return view('branchadmin.multi-data.grossprofit_report_product', compact('purchased_collection', 'sell_collection', 'product'));
        }
    }

    public function trailBalance(Request $request)
    {
        // branch id
        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        $business_id = Auth::guard('branch-admin')->user()->branch->business_id;
        // cash amount
        $cash = CashAccount::where('branch_id', $branch_id)->first()->total_amount;
        // bank details
        $bank = 0;
        // expanses record
        $expense = 0;
        $labour = 0;
        // customers amount
        $customer_category_id = UserCategory::where('business_id', $business_id)->where('user_category_name', 'Customer')->first()->id;
        $customers = User::where('user_category_id', $customer_category_id)->with('userAccount')->get();
        $customers_amount = 0;
        foreach ($customers as $customer) {
            $customers_amount = $customers_amount + $customer->userAccount->balance_amount;
        }
        // customers amount
        $supplier_category_id = UserCategory::where('business_id', $business_id)->where('user_category_name', 'Supplier')->first()->id;
        $suppliers = User::where('user_category_id', $supplier_category_id)->with('userAccount')->get();
        $suppliers_amount = 0;
        foreach ($suppliers as $supplier) {
            $suppliers_amount = $suppliers_amount + $supplier->userAccount->balance_amount;
        }
        $salary = 0;

        // purchases amount
        $purchases = PurchasedOrder::where('branch_id', $branch_id)->with('productPurchased')->get();
        $purchases_total = 0;
        foreach ($purchases as $purchase) {
            foreach ($purchase->productPurchased as $item) {
                $sub_total = $item->product_purchased_quantity * $item->per_product_price;
                $purchases_total = $purchases_total + $sub_total;
            }
        }

        // sell amount
        $sells = SellOrder::where('branch_id', $branch_id)->with('sellOrderDetails')->get();
        $sell_total = 0;
        foreach ($sells as $sell) {
            foreach ($sell->sellOrderDetails as $item) {
                $sub_total = $item->quantity * $item->per_product_price;
                $sell_total = $sell_total + $sub_total;
            }
        }

        $labour_income = 0;
        return view('branchadmin.multi-data.trail_balance_report', compact('cash', 'customers_amount', 'suppliers_amount', 'purchases_total', 'sell_total'));
    }

    public function supplierLedger(Request $request)
    {
        $user = User::find($request->supplier_id);
        $user_details = $user->userAccount->userAccountDetails()->whereBetween('created_at', [$request->from_date, $request->to_date])->orderBy('created_at', 'desc')->get();
        return view('branchadmin.multi-data.supplierledger_report', compact('user', 'user_details'));
    }

    public function customerLedger(Request $request)
    {
        $user = User::find($request->customer_id);
        $user_details = $user->userAccount->userAccountDetails()->whereBetween('created_at', [$request->from_date, $request->to_date])->orderBy('created_at', 'desc')->get();
        return view('branchadmin.multi-data.customerledger_report', compact('user', 'user_details'));
    }
}
