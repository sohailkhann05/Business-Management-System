<?php

namespace App\Http\Controllers;

use App\Branch;
use App\BranchAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrProfileController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = BranchAdmin::find($id);
        return view('branchadmin.profile.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = BranchAdmin::find($id);
        return view('branchadmin.profile.edit', compact('admin'));
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
