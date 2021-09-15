<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BuProductCategoryController extends Controller
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
        $categories = ProductCategory::where('business_id', Auth::guard('business-admin')->user()->business_id)->orderBy('created_at', 'asc')->get();
        return view('businessadmin.productcategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('businessadmin.productcategory.create');
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
            'product_category_name' => 'required'
        ]);

        $category = ProductCategory::where('business_id', Auth::guard('business-admin')->user()->business_id)->where('product_category_name', $request->product_category_name)->first();
        if ($category) {
            Session::flash('warning', 'Product category already exists.');
            return redirect()->back();
        } else {
            ProductCategory::create([
                'business_id' => Auth::guard('business-admin')->user()->business_id,
                'product_category_name' => $request->product_category_name
            ]);

            Session::flash('info', 'Product category created successfully.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = ProductCategory::find($id);
        return view('businessadmin.productcategory.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ProductCategory::find($id);
        return view('businessadmin.productcategory.edit', compact('category'));
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
            'product_category_name' => 'required'
        ]);

        $category = ProductCategory::where('business_id', Auth::guard('business-admin')->user()->business_id)->where('product_category_name', $request->product_category_name)->first();
        if ($category) {
            Session::flash('warning', 'Product category already exists.');
            return redirect()->back();
        } else {

            $category = ProductCategory::find($id);
            $category->update([
                'product_category_name' => $request->product_category_name
            ]);

            Session::flash('info', 'Product category updated successfully.');
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
