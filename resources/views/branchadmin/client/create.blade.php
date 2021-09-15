@extends('layouts.branch-layout')
@section('title','Create Supplier')
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
                    <h3>Create Supplier</h3>
                    <hr>
                    {{ Form::open(['action' => 'BrClientController@store','files' => true,'onsubmit' => 'return loadingCss(this);']) }}
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <h3>Personal Details</h3>
                            <hr>
                            <div class="form-group">
                                {{ Form::label('','Select Category') }}
                                <small style="color: red;"> *</small>
                                {{ Form::select('user_category_id',$select_category,null,['class' => 'form-control','required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('','Name') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('name',null,['class' => 'form-control','required','placeholder' => 'Name']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('','Email') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('email',null,['class' => 'form-control','required','placeholder' => 'Email address']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('','Password') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('password',null,['class' => 'form-control','required','placeholder' => 'Password']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('','Select Photo') }}
                                <small style="color: red;"> * Can be empty if no picture.</small>
                                {{ Form::file('profile_picture',['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('','Phone No') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('phone',null,['class' => 'form-control','required','placeholder' => 'Contact no']) }}
                            </div>
                            <div class="form-group" id="adding-form">
                                {{ Form::submit('Create Supplier',['class' => 'btn btn-sm btn-default']) }}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h3>Address Details</h3>
                            <hr>
                            <div class="form-group">
                                {{ Form::label('','Address') }}
                                <small style="color: red;"> *</small>
                                {{ Form::textarea('address',null,['class' => 'form-control','required','placeholder' => 'Address','rows' => 6]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('','City') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('city',null,['class' => 'form-control','required','placeholder' => 'City']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('','Country') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('country',null,['class' => 'form-control','required','placeholder' => 'Country']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('','Select Region') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('region',null,['class' => 'form-control','required','placeholder' => 'Region']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div><br>

@endsection