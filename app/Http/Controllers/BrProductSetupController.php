<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Product;
use App\ProductCategory;
use App\ProductInStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrProductSetupController extends Controller
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
        $product_setups = Product::where('branch_id', Auth::guard('branch-admin')->user()->branch_id)->orderBy('product_name', 'asc')->paginate(15);
        return view('branchadmin.productsetup.index', compact('product_setups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = Branch::find(Auth::guard('branch-admin')->user()->branch_id);
        $product_categories = ProductCategory::where('business_id', $branch->business_id)->orderBy('product_category_name', 'asc')->get();
        $select = [];
        foreach ($product_categories as $product_category) {
            $select[$product_category->id] = $product_category->product_category_name;
        }

        return view('branchadmin.productsetup.create', compact('select'));
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
            'product_category_id' => 'required',
            'product_name' => 'required',
            'product_initial_price' => 'required',
            'product_purchased_price' => 'required',
            'product_selling_unit' => 'required',
            'product_purchased_unit' => 'required',
            'product_unit_quantity' => 'required',
            'product_image' => 'required|image',
            'description' => 'required'
        ]);

        $branch_id = Auth::guard('branch-admin')->user()->branch_id;
        // initial price
        $initial_price = $request->product_initial_price;
        $unit_quantity = $request->product_unit_quantity;
        $initial_price = $initial_price / $unit_quantity;
        $average_price = $initial_price;

        // purchased price
        $purchased_price = $request->product_purchased_price / $unit_quantity;

        // product image
        $file = $request->product_image;
        $name = time() . $file->getClientOriginalName();
        $file->move('public/uploads/products/', $name);

        if ($request->bonus_check)
            $bonus = $request->bonus_check;
        else
            $bonus = 0;

        // inserting product setups
        $product = Product::create([
            'product_category_id' => $request->product_category_id,
            'branch_id' => $branch_id,
            'product_name' => $request->product_name,
            'product_initial_price' => $initial_price,
            'product_purchased_price' => $purchased_price,
            'product_average_price' => $average_price,
            'product_selling_unit' => $request->product_selling_unit,
            'product_purchased_unit' => $request->product_purchased_unit,
            'product_unit_quantity' => $request->product_unit_quantity,
            'description' => $request->description,
            'product_image' => $name,
            'bonus_check' => $bonus
        ]);

        $sum = $request->quantity_1 * $product->product_unit_quantity;
        $total_stock = $sum + $request->quantity_2;

        // inserting product initial stock
        ProductInStock::create([
            'branch_id' => $branch_id,
            'product_id' => $product->id,
            'total_stock' => $total_stock
        ]);

        Session::flash('info', 'Product setup added successfully.');
        return redirect('/branchadmin/br-productsetup/' . $product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('branchadmin.productsetup.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('branchadmin.productsetup.edit', compact('product'));
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
        return abort(403, 'Unauthorized Action');
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
