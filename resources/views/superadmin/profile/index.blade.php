@extends('layouts.admin-layout')
@section('title','My Profile')
@section('body_content')

    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="card-body pt-0 pt-md-4">
                    <div class="text-center">
                        <h3>
                            {{ $admin->name }}
                        </h3>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>
                            Created: {{ $admin->created_at->toFormattedDateString() }}
                        </div>
                        <div class="h5 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>
                            {{ $admin->email }}
                        </div>
                        <hr class="my-4">
                        <p>Text</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Update Account</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('','Name') }}
                                        <span style="color: red;"> *</span>
                                        {{ Form::text('name',$admin->name,['class' => 'form-control','placeholder' => 'Enter name','required']) }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('','Email') }}
                                        <span style="color: red;"> *</span>
                                        {{ Form::text('email',$admin->email,['class' => 'form-control','placeholder' => 'Enter email','required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::submit('Update Profile',['class' => 'btn btn-sm btn-success']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection