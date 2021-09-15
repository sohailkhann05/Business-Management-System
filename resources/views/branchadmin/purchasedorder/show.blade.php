@extends('layouts.branch-layout')
@section('title','Purchased Order details')
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
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Purchased Order details
                        <a style="float: right;" href="{{ route('br-purchasedorder.index') }}"
                           class="btn btn-sm btn-default">
                            View All
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="title text-default mb-4">
                        Purchased Product's
                    </h3>
                    {{ Form::open(['action' => 'BrProductPurchasedController@store','onsubmit' => 'return loadingCss(this);']) }}
                    {{ Form::hidden('purchased_order_id',$order->id) }}
                    <div class="form-group">
                        {{ Form::label('','Select Product') }}
                        <small style="color: red;"> *</small>
                        {{ Form::select('product_id',['' => 'Select Product'] + $select_product,null,['class' => 'form-control','required','onClick' => 'purchasedUnit()','id' => 'product_id']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('','Per Product Price') }}
                        <small style="color: red;"> *</small>
                        {{ Form::text('per_product_price',null,['class' => 'form-control','required','placeholder' => 'Per Product Price']) }}
                    </div>
                    <div id="product_purchased_quantity">
                    </div>
                    <div class="form-group" id="adding-form">
                        {{ Form::submit('Add Product Purchased',['class' => 'btn btn-sm btn-default']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="title text-default mb-4">
                        Purchased Expanse's
                    </h3>
                    {{ Form::open(['action' => 'BrPurchasedOrderExpansesController@store','onsubmit' => 'return loadingCssBtn(this);']) }}
                    {{ Form::hidden('purchased_order_id',$order->id) }}
                    <div class="form-group">
                        {{ Form::label('','Expanses Amount') }}
                        <small style="color: red;"> *</small>
                        {{ Form::text('expanses_amount',null,['class' => 'form-control','required','placeholder' => 'Expanses Amount']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('','Description') }}
                        <small style="color: red;"> *</small>
                        {{ Form::textarea('description',null,['class' => 'form-control','required','placeholder' => 'Description','rows' => 5]) }}
                    </div>
                    <div class="form-group" id="adding-form-btn">
                        {{ Form::submit('Create Expanses',['class' => 'btn btn-sm btn-default']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <?php
                    $unsaveOrders = $order->productPurchased()->orderBy('created_at', 'asc')->where('status', 0)->get();
                    $savedOrders = $order->productPurchased()->orderBy('created_at', 'asc')->where('status', 1)->get();
                    $expanses = $order->purchasedOrderExpanses()->orderBy('created_at', 'asc')->get();
                    ?>
                    @if($savedOrders->count() > 0)
                        <div style="float: right;">
                            {{--onclick="printDiv('print')"--}}
                            <a href="{{ route('br-purchasedorder.edit',$order->id) }}" type="btn btn-sm btn-default"
                               class="btn btn-sm btn-white">
                                Generate Report
                            </a>
                        </div>
                        <h3 class="title text-default mb-4">Purchased Products Cart</h3>
                        <div id="print">
                            <div class="table-responsive">
                                <table class="table table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Sub Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; $grandTotal = 0; ?>
                                    @foreach($savedOrders as $item)
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $item->product->product_name }}</td>
                                            <td id="edit_quantity_{{ $item->id }}">
                                                <?php
                                                $quantity = $item->product_purchased_quantity / $item->product->product_unit_quantity;
                                                ?>
                                                {{ $quantity }} {{ $item->product->product_purchased_unit }}
                                            </td>
                                            <td>{{ $item->per_product_price }}/-</td>
                                            <td>
                                                <?php $subTotal = $item->product_purchased_quantity * $item->per_product_price;?>
                                                {{ $subTotal }}/-
                                            </td>
                                        </tr>
                                        <?php $grandTotal = $grandTotal + $subTotal; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <h3 style="float: right;">Total: {{ $grandTotal }}/-</h3>
                            </div>
                        </div>
                    @endif
                    @if($unsaveOrders->count() > 0)
                        <hr>
                        <div style="float: right;">
                            <button type="button" class="btn btn-sm btn-success"
                                    data-toggle="modal" data-target="#confirm_cart"
                                    onclick="saveCart('{{ $order->id }}')" title="Save Changes">
                                Save Changes
                            </button>
                        </div>
                        <h3 class="title text-default mb-4">Purchased Products Cart</h3>
                        <div class="table-responsive">
                            <table class="table table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($unsaveOrders as $item)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->product->product_purchased_unit }}</td>
                                        <td id="edit_quantity_{{ $item->id }}">
                                            <?php
                                            $quantity = $item->product_purchased_quantity / $item->product->product_unit_quantity;
                                            ?>
                                            {{ $quantity }}
                                            <button type="button" class="btn btn-sm btn-disabled" title="Edit"
                                                    onclick="editQuantity('{{ $item->id }}','{{ $item->product_purchased_quantity }}')">
                                                <i class="ni ni-ruler-pencil"></i>
                                            </button>
                                        </td>
                                        <td>{{ $item->per_product_price }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-disabled"
                                                    data-toggle="modal" data-target="#confirm_deletion"
                                                    onclick="purchasedProduct('{{ $item->id }}')" title="Remove">
                                                <i class="ni ni-fat-remove"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if($savedOrders->count() == 0 && $unsaveOrders->count() == 0)
                        <h3 class="title text-default mb-4">Purchased Products Cart</h3>
                        <p>No product record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="title text-default mb-4">
                        Purchased Expanses
                    </h3>
                    @if($expanses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($expanses as $expans)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $expans->amount }}</td>
                                        <td>{{ $expans->description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No expanses record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>
    <div class="modal fade" id="confirm_deletion" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
         aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-notification">Delete Purchased Product</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">Are you sure to delete?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ Form::open(['method' => 'delete','action' => ['BrProductPurchasedController@destroy',Auth::guard('branch-admin')->id()],'onsubmit' => 'return loadingCssBtnDelete(this);']) }}
                    {{ Form::hidden('product_id',null,['id' => 'productId']) }}
                    <div class="form-group" id="adding-form-btn-delete">
                        <button type="submit" class="btn btn-sm btn-white">Confirm</button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-link text-white" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm_cart" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
         aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-notification">Confirm Cart Changes</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">Are you sure to make changes?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ Form::open(['method' => 'put','action' => ['BrProductPurchasedController@update',Auth::guard('branch-admin')->id()],'onsubmit' => 'return loadingCssBtnConfirm(this);']) }}
                    {{ Form::hidden('order_id',null,['id' => 'orderId']) }}
                    <div class="form-group" id="adding-form-btn-confirm">
                        <button type="submit" class="btn btn-sm btn-white">Confirm</button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-link text-white" data-dismiss="modal">Close</button>
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

        function editQuantity(id, quantity) {
            var quantity_id = 'edit_quantity_' + id;
            var data = "quantity=" + quantity + "&id=" + id;
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/branchadmin/branch-edit-quantity') }}',
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
                url: '{{ URL::to('/branchadmin/branch-update-quantity') }}',
                data: data,
                success: function (data) {
                    document.getElementById(quantity_id).innerHTML = data;
                }
            });
        }

        function purchasedProduct(product_id) {
            $('#productId').val(product_id);
        }

        function saveCart(id) {
            $('#orderId').val(id);
        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        function purchasedUnit() {
            var product_id = $('#product_id').val();
            if (product_id != '') {
                var data = "product_id=" + product_id;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/branch-purchased-unit') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('product_purchased_quantity').innerHTML = data;
                    }
                });
            }
        }

        function loadingCssBtn() {
            document.getElementById('adding-form-btn').innerHTML = '<button class="btn btn-sm btn-disabled  ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
            return true;
        }

        function loadingCssBtnConfirm() {
            document.getElementById('adding-form-btn-confirm').innerHTML = '<button class="btn btn-sm btn-disabled  ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
            return true;
        }

        function loadingCssBtnDelete() {
            document.getElementById('adding-form-btn-delete').innerHTML = '<button class="btn btn-sm btn-disabled  ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
            return true;
        }

    </script>

@endsection