@extends('layouts.admin-layout')
@section('title',$business->business_title)
@section('body_content')

    @if(session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text"><strong>Success!</strong> {{ session('create') }}</span>
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
            <div class="card-body ">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>
    @endif
    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <h3>
                Business CEO
                <a href="{{ route('admin-business.show',$business->id) }}" class="btn btn-sm btn-white"
                   style="float: right;">
                    Back To Business
                </a>
            </h3><hr>
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
            @else
                {{ Form::open(['method' => 'put','action' => ['AdBusinessController@update',$business->id],'onsubmit' => 'return loadingCss(this);']) }}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('','Name') }}
                            <span style="color: red;"> *</span>
                            {{ Form::text('name',null,['class' => 'form-control','required','placeholder' => 'Enter name']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('','Email') }}
                            <span style="color: red;"> *</span>
                            {{ Form::text('email',null,['class' => 'form-control','required','placeholder' => 'E-mail address']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('','Password') }}
                            <span style="color: red;"> *</span>
                            {{ Form::text('password',null,['class' => 'form-control','required','placeholder' => 'Enter password']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="adding-form">
                            {{ Form::submit('Create CEO',['class' => 'btn btn-sm btn-default']) }}
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            @endif
            <hr>
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