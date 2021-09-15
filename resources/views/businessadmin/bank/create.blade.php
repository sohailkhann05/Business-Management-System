@extends('layouts.business-layout')
@section('title','Create Bank')
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
                        Create Bank
                        <a style="float: right;" href="{{ route('business-bank.index') }}"
                           class="btn btn-sm btn-white">
                            View All
                        </a>
                    </h3>
                    <hr>
                    {{ Form::open(['action' => 'BuBankController@store','onsubmit' => 'return loadingCss(this);']) }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Bank Branch') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('bank_branch',null,['class' => 'form-control','required','placeholder' => 'Bank Branch']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Account name') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('account_name',null,['class' => 'form-control','required','placeholder' => 'Account name']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Account no') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('account_no',null,['class' => 'form-control','required','placeholder' => 'Account no']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Total Amount') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('total_amount',null,['class' => 'form-control','required','placeholder' => 'Total amount']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="adding-form">
                                {{ Form::submit('Create Bank',['class' => 'btn btn-sm btn-default']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div><br>

@endsection