@extends('layouts.admin-layout')
@section('title','Create Business')
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
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card bg-secondary shadow border-0">
                <div class="card-header bg-white">
                    <h3>
                        Create Business
                        <a href="{{ route('admin-business.index') }}" class="btn btn-sm btn-white"
                           style="float: right;">
                            View All
                        </a>
                    </h3>
                    <hr>
                    {{ Form::open(['action' => 'AdBusinessController@store','files' => true,'onsubmit' => 'return loadingCss(this);']) }}
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Business Title') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_title',null,['class' => 'form-control','placeholder' => 'Business title','required']) }}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('','Address') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_address',null,['class' => 'form-control','placeholder' => 'Full address','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Contact') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_contact',null,['class' => 'form-control','placeholder' => 'Contact no','required']) }}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('','Secondary Address') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_secondary_address',null,['class' => 'form-control','placeholder' => 'Secondary address','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Website') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_website',null,['class' => 'form-control','required','placeholder' => 'Website']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Fax no') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_fax_no',null,['class' => 'form-control','required','placeholder' => 'Fax no']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Email') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_email_address',null,['class' => 'form-control','required','placeholder' => 'E-mail address']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Phone no') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_phone_no',null,['class' => 'form-control','placeholder' => 'Phone no','required']) }}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('','Business details') }}
                                    <span style="color: red;"> *</span>
                                    {{ Form::text('business_details',null,['class' => 'form-control','placeholder' => 'Business details','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Logo file') }}
                                    <small style="color: red;"> * Can be empty if no logo.</small>
                                    {{ Form::file('business_logo',['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('','Banner file') }}
                                    <small style="color: red;"> * Can be empty if no banner.</small>
                                    {{ Form::file('business_banner',['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" id="adding-form">
                                    <button type="submit" class="btn btn-sm btn-default">Create Business</button>
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