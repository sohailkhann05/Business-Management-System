<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdBusinessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:super-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = Business::orderBy('created_at','desc')->get();
        return view('superadmin.business.index',compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.business.create');
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

        $logo_path = 'default_logo.jpg';
        $banner_path = 'default_bg.jpg';

        // logo file uploads
        if ($request->has('business_logo')) {
            $logo_file = $request->business_logo;
            $logo_name = time() . $logo_file->getClientOriginalName();
            $logo_file->move('public/uploads/logo/', $logo_name);
            $logo_path = $logo_name;
        }

        // banner file uploads
        if ($request->has('business_banner')) {
            $banner_file = $request->business_banner;
            $banner_name = time() . $banner_file->getClientOriginalName();
            $banner_file->move('public/uploads/banner/', $banner_name);
            $banner_path = $banner_name;
        }

        $business = Business::create([
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

        Session::flash('create','Business account created successfully.');
        return redirect('/superadmin/admin-business/'.$business->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business = Business::find($id);
        return view('superadmin.business.show',compact('business'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business = Business::find($id);
        return view('superadmin.business.edit',compact('business'));
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
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        BusinessAdmin::create([
            'business_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'hint' => $request->password
        ]);

        Session::flash('info','CEO created successfully.');
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
