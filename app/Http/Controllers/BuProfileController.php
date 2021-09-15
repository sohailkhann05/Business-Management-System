<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BuProfileController extends Controller
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
        return abort(403, 'Unauthorized Action');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = BusinessAdmin::find($id);
        return view('businessadmin.profile.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = BusinessAdmin::find($id);
        return view('businessadmin.profile.edit', compact('admin'));
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
            'business_title' => 'required',
            'business_address' => 'required',
            'business_contact' => 'required',
            'business_secondary_address' => 'required',
            'business_website' => 'required',
            'business_fax_no' => 'required',
            'business_email_address' => 'required',
            'business_phone_no' => 'required',
            'business_details' => 'required'
        ]);

        $business = Business::find($id);
        $logo_path = $business->business_logo;
        $banner_path = $business->business_banner;

        // logo file uploads
        if ($request->has('business_logo')) {
            if ($business->business_logo != 'default_logo.jpg')
                unlink(public_path('uploads/logo/', $business->business_logo));
            $logo_file = $request->business_logo;
            $logo_name = time() . $logo_file->getClientOriginalName();
            $logo_file->move('public/uploads/logo/', $logo_name);
            $logo_path = $logo_name;
        }

        // banner file uploads
        if ($request->has('business_banner')) {
            if ($business->business_banner != 'default_bg.jpg')
                unlink(public_path('uploads/banner/', $business->business_banner));
            $banner_file = $request->business_banner;
            $banner_name = time() . $banner_file->getClientOriginalName();
            $banner_file->move('public/uploads/banner/', $banner_name);
            $banner_path = $banner_name;
        }

        $business->update([
            'business_title' => $request->business_title,
            'business_address' => $request->business_address,
            'business_contact' => $request->business_contact,
            'business_banner' => $banner_path,
            'business_logo' => $logo_path,
            'business_secondary_address' => $request->business_secondary_address,
            'business_website' => $request->business_website,
            'business_fax_no' => $request->business_fax_no,
            'business_email_address' => $request->business_email_address,
            'business_phone_no' => $request->business_phone_no,
            'business_details' => $request->business_details
        ]);

        Session::flash('info', 'Business profile updated successfully.');
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
