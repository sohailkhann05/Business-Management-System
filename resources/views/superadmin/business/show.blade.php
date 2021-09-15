@extends('layouts.admin-layout')
@section('title','Business account')
@section('body_content')

    @if(session('create'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text"><strong>Success!</strong> {{ session('create') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <h3 class="mb-0">
                {{ $business->business_title }} Account
                <a href="{{ route('admin-business.index') }}" class="btn btn-sm btn-white"
                   style="float: right;">
                    View All
                </a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-default shadow border-0">
                        <img src="{{ asset('uploads/banner/'.$business->business_banner) }}" class="card-img-top"
                             alt="banner not found" height="314px">
                        <blockquote class="card-blockquote">
                            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 583 95" class="svg-bg">
                                <polygon points="0,52 583,95 0,95" class="fill-default"></polygon>
                                <polygon points="0,42 583,95 683,0 0,95" opacity=".2"
                                         class="fill-default"></polygon>
                            </svg>
                            <h4 class="display-3 font-weight-bold text-white">{{ $business->business_title }}</h4>
                            <a href="{{ route('admin-business.edit',$business->id) }}"
                               class="btn btn-sm btn-neutral">
                                Add Admin
                            </a>
                        </blockquote>
                    </div>
                </div>
            </div>
            <br>
            @if($business->businessAdmin()->count() > 0)
                <div class="row">
                    <div class="col-md-6">
                        <p>CEO Name: {{ $business->businessAdmin->name }}</p>
                        <p>Password: {{ $business->businessAdmin->hint }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>Email: {{ $business->businessAdmin->email }}</p>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <p>Title: {{ $business->business_title }}</p>
                    <p>Address: {{ $business->business_address }}</p>
                    <p>Website: {{ $business->business_website }}</p>
                    <p>Email address: {{ $business->business_email_address }}</p>
                    <p>Business details: {{ $business->business_details }}</p>
                </div>
                <div class="col-md-6">
                    <p>Contact: {{ $business->business_contact }}</p>
                    <p>Secondary address: {{ $business->business_secondary_address }}</p>
                    <p>Fax no: {{ $business->business_fax_no }}</p>
                    <p>Phone no: {{ $business->business_phone_no }}</p>
                    <p>Created: {{ $business->created_at->toFormattedDateString() }}</p>
                </div>
            </div>
        </div>
    </div><br>

@endsection