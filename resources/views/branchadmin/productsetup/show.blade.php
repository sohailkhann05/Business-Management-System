@extends('layouts.branch-layout')
@section('title',$product->product_name)
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
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
            <span class="alert-inner--text"><strong>Warning!</strong> {{ session('warning') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div><br>
    @endif
    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <h3>
                {{ $product->product_name }} details
                <a style="float: right;" href="{{ route('br-productsetup.index') }}"
                   class="btn btn-sm btn-default">
                    View All
                </a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p>Category: {{ $product->productCategory->product_category_name }}</p>
                    <p>Product: {{ $product->product_name }}</p>
                    <p>Initial Price: {{ $product->product_initial_price }}/-</p>
                    <p>Purchased Price: {{ $product->product_purchased_price }}/-</p>
                    <p>Average Price: {{ $product->product_average_price }}/-</p>
                    <p>Purchased Unit: {{ $product->product_purchased_unit }}</p>
                    <p>Selling Unit: {{ $product->product_selling_unit }}</p>
                    <p>Purchased Price: {{ $product->product_purchased_price }}/-</p>
                    <p>Product Unit Quantity: {{ $product->product_unit_quantity }}</p>
                    <p>Product Description: {{ $product->description }}</p>
                    <p>Created: {{ $product->created_at->toFormattedDateString() }}</p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('uploads/products/'.$product->product_image) }}" alt="Error"
                         class="img-fluid rounded shadow-lg" style="width: 450px;">
                    <hr>
                    <div class="card shadow border-0">
                        <div class="card-body py-5">
                            <div class="icon icon-shape icon-shape-default rounded-circle mb-4">
                                <i class="ni ni-bag-17"></i>
                            </div>
                            <button style="float: right;" type="button" class="btn btn-sm btn-white"
                                    data-toggle="modal"
                                    data-target="#add_stock"
                                    onclick="productDetails('{{ $product->productInStock->id }}','{{ $product->productInStock->total_stock }}')">
                                <i class="ni ni-bag-17"></i> Stock Adjustment
                            </button>
                            <h6 class="text-primary text-uppercase">Current Stock</h6>
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="badge badge-circle badge-default mr-3">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="mb-0">
                                        <?php
                                        $quantity = $product->productInStock->total_stock / $product->product_unit_quantity;
                                        ?>
                                        {{ $quantity }} {{ $product->product_selling_unit }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="modal fade" id="add_stock" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Add Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'put','action' => ['BrStockAdjustmentController@update',Auth::guard('branch-admin')->user()->id],'onsubmit' => 'return loadingCss(this);']) }}
                    <input type="hidden" name="stock_id" id="stockId" value="">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="form-group">
                        @if($product->product_selling_unit == 'Item')
                            {{ Form::label('','Total Items') }}
                            <small style="color: red;"> * e.g. 15.</small>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::number('purchased_quantity_1',null,['class' => 'form-control','required','placeholder' => 'Total Items']) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::number('purchased_quantity_2',0,['class' => 'form-control','required','readonly']) }}
                                </div>
                            </div>
                        @elseif($product->product_selling_unit == 'Pack')
                            {{ Form::label('','Total Packs') }}
                            <small style="color: red;"> * e.g. 12 Packs & 2 Items.</small>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::number('purchased_quantity_1',null,['class' => 'form-control','required','placeholder' => 'Total Packs']) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::number('purchased_quantity_2',null,['class' => 'form-control','required','placeholder' => 'Total Items']) }}
                                </div>
                            </div>
                        @elseif($product->product_selling_unit == 'Kilogram')
                            {{ Form::label('','Total Kilograms') }}
                            <small style="color: red;"> * e.g. 12 KG & 2 grams.</small>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::number('purchased_quantity_1',null,['class' => 'form-control','required','placeholder' => 'Total Kilogram']) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::number('purchased_quantity_2',null,['class' => 'form-control','required','placeholder' => 'Total Grams']) }}
                                </div>
                            </div>
                        @elseif($product->product_selling_unit == 'Liter')
                            {{ Form::label('','Total Liters') }}
                            <small style="color: red;"> * e.g. 12 Liters & 2 Mililiters.</small>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::number('purchased_quantity_1',null,['class' => 'form-control','required','placeholder' => 'Total Liters']) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::number('purchased_quantity_2',null,['class' => 'form-control','required','placeholder' => 'Total Mililiters']) }}
                                </div>
                            </div>
                        @elseif($product->product_selling_unit == 'Foot')
                            {{ Form::label('','Total Feet') }}
                            <small style="color: red;"> * e.g. 12 Feets & 2 Inches.</small>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::number('purchased_quantity_1',null,['class' => 'form-control','required','placeholder' => 'Total Feet']) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::number('purchased_quantity_2',null,['class' => 'form-control','required','placeholder' => 'Total Inches']) }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" id="adding-form">
                        <button type="submit" class="btn btn-sm btn-default">Update Stock</button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_content')

    <script>

        function productDetails(stock_id, stock) {
            $('#stockId').val(stock_id);
        }

    </script>

@endsection