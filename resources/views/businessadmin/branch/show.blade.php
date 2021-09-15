@extends('layouts.business-layout')
@section('title',$branch->branch_title)
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
                {{ $branch->branch_title }} details
                <a style="float: right;" href="{{ route('business-branch.index') }}"
                   class="btn btn-sm btn-white">
                    View All
                </a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-default shadow border-0">
                        <img src="{{ asset('uploads/banner/'.$branch->branch_banner) }}" class="card-img-top"
                             alt="banner not found" height="314px">
                        <blockquote class="card-blockquote">
                            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 583 95" class="svg-bg">
                                <polygon points="0,52 583,95 0,95" class="fill-default"></polygon>
                                <polygon points="0,42 583,95 683,0 0,95" opacity=".2"
                                         class="fill-default"></polygon>
                            </svg>
                            <a href="{{ route('business-branch.edit',$branch->id) }}" class="btn btn-sm btn-neutral">Update
                                Branch</a>
                        </blockquote>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <p>Admin: {{ $branch->branchAdmin->name }}</p>
                    <p>Title: {{ $branch->branch_title }}</p>
                    <p>Branch E-Mail: {{ $branch->branch_email_address }}</p>
                    <p>Address: {{ $branch->branch_address }}</p>
                </div>
                <div class="col-md-6">
                    <p>Admin E-Mail: {{ $branch->branchAdmin->email }}</p>
                    <p>Phone no: {{ $branch->branch_phone_no }}</p>
                    <p>Fax no: {{ $branch->branch_fax_no }}</p>
                    <p>Secondary Address: {{ $branch->branch_secondary_address }}</p>
                </div>
            </div>
        </div>
    </div><br>

@endsection