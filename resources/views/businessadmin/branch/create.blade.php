@extends('layouts.business-layout')
@section('title','Create Branch')
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
    @if($errors->any())
        <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-white">
                <h3>Alert</h3>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div><br>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Create Branch
                        <a style="float: right;" href="{{ route('business-branch.index') }}"
                           class="btn btn-sm btn-white">
                            View All
                        </a>
                    </h3>
                    <hr>
                    {{ Form::open(['action' => 'BuBranchController@store','files' => true,'onsubmit' => 'return loadingCss(this);']) }}
                    <div class="pl-lg-4">
                        <div class="row">
                            {{ Form::hidden('business_id',$admin = Auth::guard('business-admin')->user()->business->id) }}
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Branch Title') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('branch_title',null,['class' => 'form-control','placeholder' => 'Branch Title','required']) }}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('','Address') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('branch_address',null,['class' => 'form-control','placeholder' => 'Full address','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Fax no') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('branch_fax_no',null,['class' => 'form-control','placeholder' => 'Fax no','required']) }}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('','Secondary Address') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('branch_secondary_address',null,['class' => 'form-control','placeholder' => 'Secondary address','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Email address') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('branch_email_address',null,['class' => 'form-control','required','placeholder' => 'Email address']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Banner file') }}
                                    {{ Form::file('branch_banner',['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Phone no') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('branch_phone_no',null,['class' => 'form-control','placeholder' => 'Phone no','required']) }}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Admin Name') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('name',null,['class' => 'form-control','placeholder' => 'Name','required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Email address') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('email',null,['class' => 'form-control','placeholder' => 'Email address','required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Password') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('password',null,['class' => 'form-control','placeholder' => 'Password','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" id="adding-form">
                                    <button type="submit" class="btn btn-sm btn-default">Create Branch</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div><br>

@endsection