@extends('layouts.branch-layout')
@section('title','Create Product Setup')
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
                        Create Product Setup
                        <a style="float: right;" href="{{ route('br-productsetup.index') }}"
                           class="btn btn-sm btn-default">
                            View All
                        </a>
                    </h3><hr>
                    {{ Form::open(['action' => 'BrProductSetupController@store','files' => true,'onsubmit' => 'return loadingCss(this);']) }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Select Category') }}
                                <small style="color: red;"> *</small>
                                {{ Form::select('product_category_id',['' => 'Select Category'] + $select,null,['class' => 'form-control','required']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Product Name') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('product_name',null,['class' => 'form-control','required','placeholder' => 'Product name']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Initial Price') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('product_initial_price',null,['class' => 'form-control','required','placeholder' => 'Initial price']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Purchased Price') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('product_purchased_price',null,['class' => 'form-control','required','placeholder' => 'Purchased price']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Purchased Unit') }}
                                <small style="color: red;"> *</small>
                                {{ Form::select('product_purchased_unit',['' => 'Select Selling unit', 'Item' => 'Item', 'Pack' => 'Pack', 'Kilogram' => 'Kilogram', 'Liter' => 'Liter', 'Foot' => 'Foot'],null,['class' => 'form-control','required','id' => 'purchased_unit','onBlur' => 'getUnitQuantity()']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Product Image') }}
                                <small style="color: red;"> *</small>
                                {{ Form::file('product_image',['class' => 'form-control','required']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Selling Unit') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('product_selling_unit',null,['class' => 'form-control','required','id' => 'product_selling_unit','readonly']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Unit Quantity') }}
                                <small style="color: red;"> *</small>
                                <input type="text" name="product_unit_quantity" id="unit_quantity" class="form-control"
                                       value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><br>
                                {{ Form::label('','Do you get bonus on this Product?') }}
                                <input type="checkbox" name="bonus_check" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Description') }}
                                <small style="color: red;"> *</small>
                                {{ Form::textarea('description',null,['class' => 'form-control','required','placeholder' => 'Product Description','rows' => 2]) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label id="label1"></label>
                                <div id="product_quantity1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label id="label2"></label>
                                <div id="product_quantity2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="adding-form">
                                {{ Form::submit('Create Product',['class' => 'btn btn-sm btn-default']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div><br>

@endsection
@section('script_content')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getUnitQuantity() {
            var quantity = $('#purchased_unit').val();
            if (quantity != '') {
                if (quantity == 'Item') {
                    document.getElementById('unit_quantity').value = 1;
                    document.getElementById('product_selling_unit').value = 'Item';
                    document.getElementById('unit_quantity').setAttribute('readOnly', true);
                    document.getElementById('product_selling_unit').setAttribute('readOnly', true);
                    document.getElementById('product_quantity1').innerHTML = '<input type="number" name="quantity_1" class="form-control" required min="0">';
                    document.getElementById('label1').innerHTML = 'Items <small style="color: red;"> * Initial Stock</small>';
                    document.getElementById('label2').innerHTML = 'Empty';
                    document.getElementById('product_quantity2').innerHTML = '<input type="number" readonly value="0" name="quantity_2" class="form-control" required min="0">';
                }

                if (quantity == 'Pack') {
                    document.getElementById('unit_quantity').value = 0;
                    document.getElementById('product_selling_unit').value = 'Pack';
                    // document.getElementById('unit_quantity').setAttribute('readOnly', false);
                    document.getElementById('product_selling_unit').setAttribute('readOnly', true);
                    document.getElementById('product_quantity1').innerHTML = '<input type="number" name="quantity_1" class="form-control" required min="0">';
                    document.getElementById('label1').innerHTML = 'Packs <small style="color: red;"> * Initial Stock</small>';
                    document.getElementById('label2').innerHTML = 'Items <small style="color: red;"> * Initial Stock</small>';
                    document.getElementById('product_quantity2').innerHTML = '<input type="number" name="quantity_2" class="form-control" required min="0">';
                }

                if (quantity == 'Kilogram') {
                    document.getElementById('unit_quantity').value = 1000;
                    document.getElementById('product_selling_unit').value = 'Kilogram';
                    document.getElementById('unit_quantity').setAttribute('readOnly', true);
                    document.getElementById('product_selling_unit').setAttribute('readOnly', true);
                    document.getElementById('product_quantity1').innerHTML = '<input type="number" name="quantity_1" class="form-control" required min="0">';
                    document.getElementById('label1').innerHTML = 'Kilograms <small style="color: red;"> * Initial Stock</small>';
                    document.getElementById('label2').innerHTML = 'Grams <small style="color: red;"> * Initial Stock</small>';
                    document.getElementById('product_quantity2').innerHTML = '<input type="number" name="quantity_2" class="form-control" required min="0">';
                }

                if (quantity == 'Liter') {
                    document.getElementById('unit_quantity').value = 1000;
                    document.getElementById('product_selling_unit').value = 'Liter';
                    document.getElementById('unit_quantity').setAttribute('readOnly', true);
                    document.getElementById('product_selling_unit').setAttribute('readOnly', true);
                    document.getElementById('product_quantity1').innerHTML = '<input type="number" name="quantity_1" class="form-control" required min="0">';
                    document.getElementById('label1').innerHTML = 'Liter <small style="color: red;"> * Initial Stock</small>';
                    document.getElementById('label2').innerHTML = 'Milliliters <small style="color: red;"> * Initial Stock</small>';
                    document.getElementById('product_quantity2').innerHTML = '<input type="number" name="quantity_2" class="form-control" required min="0">';
                }

                if (quantity == 'Foot') {
                    document.getElementById('unit_quantity').value = 12;
                    document.getElementById('product_selling_unit').value = 'Foot';
                    document.getElementById('unit_quantity').setAttribute('readOnly', true);
                    document.getElementById('product_selling_unit').setAttribute('readOnly', true);
                    document.getElementById('product_quantity1').innerHTML = '<input type="number" name="quantity_1" class="form-control" required min="0">';
                    document.getElementById('label1').innerHTML = 'Feet <small style="color: red;"> * Initial Stock</small>';
                    document.getElementById('label2').innerHTML = 'Inches <small style="color: red;"> * Initial Stock</small>';
                    document.getElementById('product_quantity2').innerHTML = '<input type="number" name="quantity_2" class="form-control" required min="0">';
                }
            }
        }

    </script>

@endsection