@extends('layouts.business-layout')
@section('title',$admin->business->business_title)
@section('body_content')

    @if(session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text"><strong>Success!</strong> {{ session('info') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <h3>
                {{ $admin->business->business_title }} Profile
                <a style="float: right;" href="{{ route('business-profile.edit',$admin->id) }}"
                   class="btn btn-sm btn-default">
                    Update Profile
                </a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-default shadow border-0">
                        <img src="{{ asset('uploads/banner/'.$admin->business->business_banner) }}" class="card-img-top"
                             alt="banner not found" height="314px">
                        <blockquote class="card-blockquote">
                            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 583 95" class="svg-bg">
                                <polygon points="0,52 583,95 0,95" class="fill-default"></polygon>
                                <polygon points="0,42 583,95 683,0 0,95" opacity=".2"
                                         class="fill-default"></polygon>
                            </svg>
                            <h4 class="display-3 font-weight-bold text-white">{{ $admin->business->business_title }}</h4>
                        </blockquote>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <p>CEO Name: {{ $admin->name }}</p>
                    <p>Password: </p>
                </div>
                <div class="col-md-6">
                    <p>Email: {{ $admin->email }}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <p>Title: {{ $admin->business->business_title }}</p>
                    <p>Address: {{ $admin->business->business_address }}</p>
                    <p>Website: {{ $admin->business->business_website }}</p>
                    <p>Email address: {{ $admin->business->business_email_address }}</p>
                    <p>Business details: {{ $admin->business->business_details }}</p>
                </div>
                <div class="col-md-6">
                    <p>Contact: {{ $admin->business->business_contact }}</p>
                    <p>Secondary address: {{ $admin->business->business_secondary_address }}</p>
                    <p>Fax no: {{ $admin->business->business_fax_no }}</p>
                    <p>Phone no: {{ $admin->business->business_phone_no }}</p>
                    <p>Created: {{ $admin->business->created_at->toFormattedDateString() }}</p>
                </div>
            </div>
        </div>
    </div>
    <br>

@endsection