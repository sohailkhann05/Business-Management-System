<?php

namespace App\Http\Controllers;

use App\Branch;
use App\BranchAdmin;
use App\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BuBranchController extends Controller
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
        $branches = Branch::where('business_id', $admin = Auth::guard('business-admin')->user()->business->id)->get();
        return view('businessadmin.branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('businessadmin.branch.create');
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
            'branch_title' => 'required',
            'branch_phone_no' => 'required',
            'branch_address' => 'required',
            'branch_fax_no' => 'required',
            'branch_secondary_address' => 'required',
            'branch_email_address' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // branch creation
        $banner_path = 'default_bg.jpg';
        $business_id = Auth::guard('business-admin')->user()->business_id;

        // banner upload
        if ($request->has('branch_banner')) {
            $banner_file = $request->branch_banner;
            $banner_name = time() . $banner_file->getClientOriginalName();
            $banner_file->move('public/uploads/banner/', $banner_name);
            $banner_path = $banner_name;
        }

        $branch = Branch::create([
            'business_id' => $request->business_id,
            'branch_title' => $request->branch_title,
            'branch_banner' => $banner_path,
            'branch_address' => $request->branch_address,
            'branch_phone_no' => $request->branch_phone_no,
            'branch_fax_no' => $request->branch_fax_no,
            'branch_email_address' => $request->branch_email_address,
            'branch_secondary_address' => $request->branch_secondary_address
        ]);

        // admin creation
        BranchAdmin::create([
            'branch_id' => $branch->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'hint' => $request->password
        ]);

        // creating user categories
        UserCategory::create([
            'business_id' => $business_id,
            'user_category_name' => 'Supplier'
        ]);

        UserCategory::create([
            'business_id' => $business_id,
            'user_category_name' => 'Customer'
        ]);

        UserCategory::create([
            'business_id' => $business_id,
            'user_category_name' => 'Vehicle'
        ]);

        UserCategory::create([
            'business_id' => $business_id,
            'user_category_name' => 'Marketing Manager'
        ]);

        Session::flash('info', 'Branch created successfully.');
        return redirect('/businessadmin/business-branch/' . $branch->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::find($id);
        return view('businessadmin.branch.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::find($id);
        return view('businessadmin.branch.edit', compact('branch'));
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
            'branch_title' => 'required',
            'branch_phone_no' => 'required',
            'branch_address' => 'required',
            'branch_fax_no' => 'required',
            'branch_secondary_address' => 'required',
            'branch_email_address' => 'required',
        ]);

        $branch = Branch::find($id);
        // branch creation
        $banner_path = $branch->branch_banner;

        // banner upload
        if ($request->has('branch_banner')) {
            if ($branch->branch_banner != 'default_bg.jpg')
                unlink(public_path('uploads/banner/', $branch->branch_banner));
            $banner_file = $request->branch_banner;
            $banner_name = time() . $banner_file->getClientOriginalName();
            $banner_file->move('public/uploads/banner/', $banner_name);
            $banner_path = $banner_name;
        }

        $branch->update([
            'branch_title' => $request->branch_title,
            'branch_banner' => $banner_path,
            'branch_address' => $request->branch_address,
            'branch_phone_no' => $request->branch_phone_no,
            'branch_fax_no' => $request->branch_fax_no,
            'branch_email_address' => $request->branch_email_address,
            'branch_secondary_address' => $request->branch_secondary_address
        ]);


        Session::flash('info', 'Branch updated successfully.');
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
        return abort(403, 'Unauthorized Action');
    }
}
