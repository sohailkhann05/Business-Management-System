<?php

namespace App\Http\Controllers;

use App\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BuUserCategoryController extends Controller
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
        $categories = UserCategory::where('business_id', Auth::guard('business-admin')->user()->business_id)->orderBy('created_at', 'asc')->get();
        return view('businessadmin.usercategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('businessadmin.usercategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(403, 'Unauthorized Action');
//        $this->validate($request, [
//            'user_category_name' => 'required'
//        ]);
//
//        $category = UserCategory::where('business_id', Auth::guard('business-admin')->user()->business_id)->where('user_category_name', $request->user_category_name)->first();
//        if ($category) {
//            Session::flash('warning', 'User category already exists.');
//            return redirect()->back();
//        } else {
//
//            UserCategory::create([
//                'business_id' => Auth::guard('business-admin')->user()->business_id,
//                'user_category_name' => $request->user_category_name
//            ]);
//
//            Session::flash('info', 'User created updated successfully.');
//            return redirect()->back();
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = UserCategory::find($id);
        return view('businessadmin.usercategory.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = UserCategory::find($id);
        return view('businessadmin.usercategory.edit', compact('category'));
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
            'user_category_name' => 'required'
        ]);

        $category = UserCategory::where('business_id', Auth::guard('business-admin')->user()->business_id)->where('user_category_name', $request->user_category_name)->first();
        if ($category) {
            Session::flash('warning', 'User category already exists.');
            return redirect()->back();
        } else {

            $category = UserCategory::find($id);
            $category->update([
                'user_category_name' => $request->user_category_name
            ]);

            Session::flash('info', 'User category updated successfully.');
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
