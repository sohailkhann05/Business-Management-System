@extends('layouts.branch-layout')
@section('title','Finalize Order')
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
                        Finalize Order
                        <a style="float: right;" href="{{ route('br-customerorder.show',$order->id) }}"
                           class="btn btn-sm btn-default">
                            Back to Order
                        </a>
                    </h3>
                    <hr>
                    {{ Form::open(['method' => 'put','action' => ['BrSellOrderController@update',$order->id],'onsubmit' => 'return loadingCss(this);']) }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Select Supplier</label>
                                <small style="color: red;"> *</small>
                                {{ Form::select('supplier_id',['' => 'Select Supplier'] + $select_suppliers,null,['class' => 'form-control','required']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Invoice No</label>
                                <small style="color: red;"> *</small>
                                {{ Form::text('invoice_no',null,['class' => 'form-control','required','placeholder' => 'Invoice No']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Belty No</label>
                                <small style="color: red;"> *</small>
                                {{ Form::text('belty_no',null,['class' => 'form-control','required','placeholder' => 'Belty No']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Discount Amount</label>
                                <small style="color: red;"> *</small>
                                {{ Form::text('discount_amount',null,['class' => 'form-control','required','placeholder' => 'Discount Amount']) }}
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Description</label>
                                <small style="color: red;"> *</small>
                                {{ Form::textarea('description',null,['class' => 'form-control','required','placeholder' => 'Description','rows' => 3]) }}
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="adding-form">
                                <button type="submit" class="btn btn-sm btn-success">Confirm Order</button>
                                <span class="badge badge-pill badge-danger text-uppercase">
                                Note: Order will be completed!
                            </span>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div><br>

@endsection