@extends('layouts.branch-layout')
@section('title','Create Purchased Order')
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
                        Create Purchased Order
                        <a style="float: right;" href="{{ route('br-purchasedorder.index') }}"
                           class="btn btn-sm btn-default">
                            View All
                        </a>
                    </h3><hr>
                    {{ Form::open(['action' => 'BrPurchasedOrderController@store','onsubmit' => 'return loadingCss(this);']) }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Select Supplier') }}
                                <small style="color: red;"> *</small>
                                {{ Form::select('user_id',['' => 'Select Supplier'] + $select_users,null,['class' => 'form-control','required']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Invoice No') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('invoice_no',null,['class' => 'form-control','required','placeholder' => 'Invoice no']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Belty No') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('belty_no',null,['class' => 'form-control','required','placeholder' => 'Belty no']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Received By') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('received_by',null,['class' => 'form-control','required','placeholder' => 'Received by']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Discount Amount') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('discount_amount',null,['class' => 'form-control','required','placeholder' => 'Discount amount']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Description') }}
                                <small style="color: red;"> *</small>
                                {{ Form::textarea('description',null,['rows' => 3,'class' => 'form-control','required','placeholder' => 'Description here...']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="adding-form">
                                {{ Form::submit('Create Purchase Order',['class' => 'btn btn-sm btn-default']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div><br>

@endsection