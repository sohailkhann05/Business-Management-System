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
        </div><br>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Update {{ $admin->business->business_title }}
                        <a style="float: right;" href="{{ route('business-profile.show',$admin->id) }}"
                           class="btn btn-sm btn-default">
                            View Profile
                        </a>
                    </h3>
                </div>
                <div class="card-body ">
                    {{ Form::open(['method' => 'put','action' => ['BuProfileController@update',$admin->business->id],'files' => true,'onsubmit' => 'return loadingCss(this);']) }}
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Business Title') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_title',$admin->business->business_title,['class' => 'form-control','placeholder' => 'Business title','required']) }}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('','Address') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_address',$admin->business->business_address,['class' => 'form-control','placeholder' => 'Full address','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Contact') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_contact',$admin->business->business_contact,['class' => 'form-control','placeholder' => 'Contact no','required']) }}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('','Secondary Address') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_secondary_address',$admin->business->business_secondary_address,['class' => 'form-control','placeholder' => 'Secondary address','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Website') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_website',$admin->business->business_website,['class' => 'form-control','required','placeholder' => 'Website']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Fax no') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_fax_no',$admin->business->business_fax_no,['class' => 'form-control','required','placeholder' => 'Fax no']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Email') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_email_address',$admin->business->business_email_address,['class' => 'form-control','required','placeholder' => 'E-mail address']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Phone no') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_phone_no',$admin->business->business_phone_no,['class' => 'form-control','placeholder' => 'Phone no','required']) }}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('','Business details') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_details',$admin->business->business_details,['class' => 'form-control','placeholder' => 'Business details','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Logo file') }}
                                    {{ Form::file('business_logo',['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Banner file') }}
                                    {{ Form::file('business_banner',['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" id="adding-form">
                                    <button type="submit" class="btn btn-sm btn-success">Update Business</button>
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