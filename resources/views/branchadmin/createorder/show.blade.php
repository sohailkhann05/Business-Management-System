@extends('layouts.branch-layout')
@section('title','Create Order')
@section('body_content')

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
                        All Product Stock's
                        <div class="row" style="float: right;">
                            <div class="col-md-7">
                                <input class="form-control" placeholder="Product name" type="text"
                                       id="search_text" style="float: right;">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-default" onclick="searchProduct()">Search</button>
                            </div>
                        </div>
                    </h3>
                    <hr>
                    <div id="search_result"></div>
                    @if($products->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Purchased Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <?php $sno = 1; ?>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>
                                            {{ $product->product_name }}
                                        </td>
                                        <td>
                                            Rs. {{ $product->product_purchased_price }}
                                        </td>
                                        <?php
                                        $quantity = $product->productInStock->total_stock / $product->product_unit_quantity;
                                        ?>
                                        <td>{{ $quantity }} {{ $product->product_purchased_unit }}</td>
                                        <td>
                                            <a href="{{ route('br-productsetup.show',$product->id) }}" target="_blank"
                                               class="btn btn-sm btn-neutral">View</a>
                                        </td>
                                        <td id="product_{{ $product->id }}">
                                            <button type="button" class="btn btn-sm btn-white"
                                                    data-toggle="modal" data-target="#add_product"
                                                    onclick="addProduct('{{ $product->id }}','{{ $product->product_purchased_unit }}')">
                                                Add to Cart
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><br>
                        {{ $products->links() }}
                    @else
                        <p>No product record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>
    <?php $check = $customer->carts()->count(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    @if($check > 0)
                        <button type="button" class="btn btn-sm btn-success"
                                data-toggle="modal" data-target="#complete_order" style="float: right;">
                            Complete Order
                        </button>
                    @endif
                    <h3>
                        {{ $customer->name }} Cart
                    </h3>
                    <hr>
                    @if($check > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <?php $sno = 1; ?>
                                <tbody>
                                @foreach($customer->carts as $cart)
                                    <tr>
                                        <td>
                                            {{ $cart->product->product_name }}
                                        </td>
                                        <td>
                                            {{ $cart->product->product_selling_unit }}
                                        </td>
                                        <td>
                                            {{ $cart->product->product_purchased_price }}
                                        </td>
                                        <td id="edit_quantity_{{ $cart->id }}">
                                            {{ $cart->quantity }} &nbsp;
                                            <button class="btn btn-icon btn-sm btn-disabled" type="button"
                                                    onclick="editQuantity('{{ $cart->id }}','{{ $cart->quantity }}')">
                                                <span class="btn-inner--icon"><i class="ni ni-ruler-pencil"></i>
                                                </span>
                                            </button>
                                        </td>
                                        <td>
                                            {{ Form::open(['method' => 'delete','action' => ['BrCreateOrderController@destroy',$cart->id]]) }}
                                            <button class="btn btn-icon btn-sm btn-disabled" type="submit">
                                                <span class="btn-inner--icon"><i class="ni ni-fat-remove"></i>
                                                </span>
                                            </button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Cart is empty!</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>

    <div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Add To Cart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['action' => 'BrCreateOrderController@store','onsubmit' => 'return loadingCssCreate(this);']) }}
                    {{ Form::hidden('user_id',$customer->id,['required']) }}
                    {{ Form::hidden('product_id',null,['id' => 'productId','required']) }}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Select Supplier</label>
                            <small style="color: red;"> *</small>
                            {{ Form::select('supplier_id',['' => 'Select Supplier'] + $select_suppliers,null,['class' => 'form-control','required']) }}
                        </div>
                    </div>
                    <br>
                    <label>Product Quantity</label>
                    <small style="color: red;" id="label_of_quantity"></small>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="quantity_field_1"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="quantity_field_2"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" id="adding-form-create">
                        <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-neutral" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="complete_order" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Complete Order</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'put','action' => ['BrCreateOrderController@update',$customer->id],'onsubmit' => 'return loadingCss(this);']) }}
                    <div class="form-group">
                        <label for="">Invoice No</label>
                        <small style="color: red"> *</small>
                        {{ Form::text('invoice_no',null,['class' => 'form-control','required','placeholder' => 'Invoice No']) }}
                    </div>
                    <div class="form-group">
                        <label for="">Belty No</label>
                        <small style="color: red"> *</small>
                        {{ Form::text('belty_no',null,['class' => 'form-control','required','placeholder' => 'Belty No']) }}
                    </div>
                    <div class="form-group">
                        <label for="">Discount Amount</label>
                        <small style="color: red"> *</small>
                        {{ Form::text('discount_amount',null,['class' => 'form-control','required','placeholder' => 'Discount Amount']) }}
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <small style="color: red"> *</small>
                        {{ Form::textarea('description',null,['class' => 'form-control','required','rows' => 3,'placeholder' => 'Description']) }}
                    </div>
                    <div class="form-group">
                        <label for="">Amount</label>
                        <small style="color: red"> * Money for this order are given or not.</small>
                        {{ Form::number('amount',null,['class' => 'form-control','placeholder' => 'Amount','min' => 0]) }}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" id="adding-form">
                        <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-neutral" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_content')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function searchProduct() {
            var search_field = $('#search_text').val();
            if (search_field == '' || search_field == null) {
                document.getElementById('search_text').style.border = "1px solid #d71313";
            } else {
                document.getElementById('search_text').style.border = "1px solid #cad1d7";
                var data = "search_text=" + search_field;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/branchsearchproduct') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_result').innerHTML = data;
                    }
                });

            }

        }

        function editQuantity(id, quantity) {
            var quantity_id = 'edit_quantity_' + id;
            var data = "quantity=" + quantity + "&id=" + id;
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/edit-customer-quantity') }}',
                data: data,
                success: function (data) {
                    document.getElementById(quantity_id).innerHTML = data;
                }
            });
        }

        function updateQuantity(id) {
            var quantity_id = 'edit_quantity_' + id;
            var quantity = $('#update_quantity_' + id).val();
            var data = "quantity=" + quantity + "&id=" + id;
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/update-user-quantity') }}',
                data: data,
                success: function (data) {
                    document.getElementById(quantity_id).innerHTML = data;
                }
            });
        }

        function addProduct(id, unit) {
            $('#productId').val(id);
            if (unit == 'Item') {
                document.getElementById('label_of_quantity').innerHTML = 'e.g. 14 Items.';
                document.getElementById('quantity_field_1').innerHTML = '<input type="number" name="quantity_1" class="form-control" min="0">';
                document.getElementById('quantity_field_2').innerHTML = '<input type="number" name="quantity_2" value="0" readonly class="form-control" min="0">';
            }
            if (unit == 'Pack') {
                document.getElementById('label_of_quantity').innerHTML = 'e.g. 10 Packs & 3 Items.';
                document.getElementById('quantity_field_1').innerHTML = '<input type="number" name="quantity_1" class="form-control" min="0">';
                document.getElementById('quantity_field_2').innerHTML = '<input type="number" name="quantity_2" class="form-control" min="0">';
            }
            if (unit == 'Kilogram') {
                document.getElementById('label_of_quantity').innerHTML = 'e.g. 10 Kilograms & 3 Grams.';
                document.getElementById('quantity_field_1').innerHTML = '<input type="number" name="quantity_1" class="form-control" min="0">';
                document.getElementById('quantity_field_2').innerHTML = '<input type="number" name="quantity_2" class="form-control" min="0">';
            }
            if (unit == 'Liter') {
                document.getElementById('label_of_quantity').innerHTML = 'e.g. 10 Liters & 3 Milliliters.';
                document.getElementById('quantity_field_1').innerHTML = '<input type="number" name="quantity_1" class="form-control" min="0">';
                document.getElementById('quantity_field_2').innerHTML = '<input type="number" name="quantity_2" class="form-control" min="0">';
            }
            if (unit == 'Foot') {
                document.getElementById('label_of_quantity').innerHTML = 'e.g. 10 Feet & 3 Inches.';
                document.getElementById('quantity_field_1').innerHTML = '<input type="number" name="quantity_1" class="form-control" min="0">';
                document.getElementById('quantity_field_2').innerHTML = '<input type="number" name="quantity_2" class="form-control" min="0">';
            }
        }

        @if (Session::has('success'))
        toastr.success('Product added Cart!');
        @endif

        @if (Session::has('info'))
        toastr.info('Product quantity must be greater!');
        @endif

        @if (Session::has('warning'))
        toastr.warning('Product already added to Cart!');
        @endif

        @if (Session::has('stock'))
        toastr.warning('Products are out of Stock!');
        @endif

        @if (Session::has('delete'))
        toastr.success('Product removed from Cart!');

        @endif

        function loadingCssCreate() {
            document.getElementById('adding-form-create').innerHTML = '<button class="btn btn-sm btn-disabled  ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
            return true;
        }

    </script>

@endsection