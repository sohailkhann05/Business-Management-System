@extends('layouts.branch-layout')
@section('title','Sell Order Return details')
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
                        Sell Order Return details
                        <a style="float: right;" href="{{ route('br-sellorderreturn.index') }}"
                           class="btn btn-sm btn-default">
                            View All
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class=" mb-4">
                        Products of Invoice {{ $orderReturn->sellOrder->invoice_no }}
                    </h3>
                    <hr>
                    <div class="form-group">
                        <label for="">Select Product</label>
                        <small style="color: red;"> *</small>
                        {{ Form::hidden('sell_order_id',$orderReturn->sell_order_id,['id' => 'sell_order_id']) }}
                        <select class="form-control" id="product_id" name="product_id">
                            <option value="">Select Product</option>
                            @foreach($orderReturn->sellOrder->sellOrderDetails as $detail)
                                <option value="{{ $detail->product_id }}">{{ $detail->product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-default"
                                onclick="productSoldDetails('{{ $orderReturn->id }}')">Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h3>
                        Product Cart details
                    </h3>
                    <p class=" mb-4">Please write the product quantity that are returned.</p>
                    <hr>
                    <div id="product_details">
                        <p>Select Product to view details...</p>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <?php
                    $orderDetails = $orderReturn->sellOrderReturnDetails()->orderBy('created_at', 'asc')->get();
                    ?>
                    @if($orderDetails->where('status',1)->count() > 0)
                        <a href="{{ route('br-sellorderreturn.edit',$orderReturn->id) }}" class="btn btn-sm btn-white"
                           style="float: right;" title="Generate Report">
                            Generate Report
                        </a>
                        <h3 class=" mb-4">
                            Invoice {{ $orderReturn->sellOrder->invoice_no }} Return Products Cart
                        </h3>
                        <hr>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; $grandTotal = 0; ?>
                                @foreach($orderDetails->where('status',1) as $detail)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $detail->product->product_name }}</td>
                                        <td>{{ $detail->return_quantity }}</td>
                                        <td>{{ $detail->return_unit }}</td>
                                        <td>
                                            <?php $product = $detail->sellOrderReturn->sellOrder->sellOrderDetails->where('product_id', $detail->product_id)->first(); ?>
                                            {{ $product->per_product_price }}
                                        </td>
                                        <td>
                                            <?php $subTotal = $detail->return_quantity * $product->per_product_price;?>
                                            {{ $subTotal }}/-
                                        </td>
                                        <?php $grandTotal = $grandTotal + $subTotal; ?>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <h3 style="float: right;">Total: {{ $grandTotal }}/-</h3>
                        </div>
                    @endif
                    @if($orderDetails->where('status',0)->count() > 0)
                        <hr>
                        <button class="btn btn-sm btn-success" style="float: right;" data-toggle="modal"
                                data-target="#confirm_cart"
                                onclick="saveCart('{{ $orderReturn->id }}')" title="Save Changes">Save Changes
                        </button>
                        <h3 class=" mb-4">
                            Invoice {{ $orderReturn->sellOrder->invoice_no }} Return Products
                        </h3>
                        <hr>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($orderDetails->where('status',0) as $detail)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $detail->product->product_name }}</td>
                                        <td>{{ $detail->return_unit }}</td>
                                        <td id="edit_quantity_{{ $detail->id }}">
                                            {{ $detail->return_quantity }} &nbsp;
                                            <button type="button" class="btn btn-sm btn-default" title="Edit"
                                                    onclick="editQuantity('{{ $detail->id }}','{{ $detail->return_quantity }}')">
                                                <i class="ni ni-ruler-pencil"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                    data-toggle="modal" data-target="#confirm_deletion"
                                                    onclick="purchasedProduct('{{ $detail->id }}')" title="Remove">
                                                <i class="ni ni-fat-remove"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if($orderDetails->count() == 0)
                        <h3 class=" mb-4">
                            Invoice {{ $orderReturn->sellOrder->invoice_no }} Return Products
                        </h3>
                        <p>No product return details found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>

    <div class="modal fade" id="confirm_return_order" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
         aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-notification">Confirm Return Order</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">Are you sure?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ Form::open(['action' => 'BrSellOrderReturnDetailController@store','onsubmit' => 'return loadingCssConfirm(this);']) }}
                    {{ Form::hidden('return_unit',null,['id' => 'returnUnit']) }}
                    {{ Form::hidden('purchased_id',null,['id' => 'purchased_id']) }}
                    {{ Form::hidden('return_quantity_1',null,['id' => 'returnQuantity1']) }}
                    {{ Form::hidden('return_quantity_2',null,['id' => 'returnQuantity2']) }}
                    {{ Form::hidden('return_id',null,['id' => 'return_id']) }}
                    {{ Form::hidden('product_id',null,['id' => 'productId']) }}
                    <div class="form-group" id="adding-form-confirm">
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
    <div class="modal fade" id="confirm_deletion" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
         aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-notification">Delete Purchased Return Product</h3>
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
                    {{ Form::open(['method' => 'delete','action' => ['BrSellOrderReturnDetailController@destroy',Auth::guard('branch-admin')->id()],'onsubmit' => 'return loadingCssDelete(this);']) }}
                    {{ Form::hidden('order_return_id',null,['id' => 'orderReturnId']) }}
                    <div class="form-group" id="adding-form-delete">
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
                    {{ Form::open(['method' => 'put','action' => ['BrSellOrderReturnDetailController@update',Auth::guard('branch-admin')->id()],'onsubmit' => 'return loadingCssCart(this);']) }}
                    {{ Form::hidden('order_return_id',null,['id' => 'SellOrderReturnId']) }}
                    <div class="form-group" id="adding-form-cart">
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

        function productSoldDetails(order_return_id) {
            var purchased_order_id = $('#sell_order_id').val();
            var product_id = $('#product_id').val();
            if (product_id == '' || product_id == null) {
                document.getElementById('product_id').style.border = "1px solid #d71313";
            } else {
                document.getElementById('product_id').style.border = "1px solid #cad1d7";
                var data = "sell_order_id=" + purchased_order_id + "&product_id=" + product_id + "&order_return_id=" + order_return_id;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/branchsellproductdetails') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('product_details').innerHTML = data;
                    }
                });
            }
        }

        function returnOrder(return_id, product_id, purchased_id) {
            var return_unit = $('#return_unit').val();
            var return_quantity_1 = $('#return_quantity_1').val();
            var return_quantity_2 = $('#return_quantity_2').val();
            $('#productId').val(product_id);
            $('#return_id').val(return_id);
            $('#returnUnit').val(return_unit);
            $('#returnQuantity1').val(return_quantity_1);
            $('#returnQuantity2').val(return_quantity_2);
            $('#purchased_id').val(purchased_id);
        }

        function editQuantity(id, quantity) {
            var quantity_id = 'edit_quantity_' + id;
            var data = "quantity=" + quantity + "&id=" + id;
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/branchadmin/branch-edit-return-quantity') }}',
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
                url: '{{ URL::to('/branchadmin/branch-update-sell-return-quantity') }}',
                data: data,
                success: function (data) {
                    document.getElementById(quantity_id).innerHTML = data;
                }
            });
        }

        function purchasedProduct(return_id) {
            $('#orderReturnId').val(return_id);
        }

        function saveCart(id) {
            $('#SellOrderReturnId').val(id);
        }

        function loadingCssConfirm() {
            document.getElementById('adding-form-confirm').innerHTML = '<button class="btn btn-sm btn-disabled  ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
            return true;
        }

        function loadingCssDelete() {
            document.getElementById('adding-form-delete').innerHTML = '<button class="btn btn-sm btn-disabled  ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
            return true;
        }

        function loadingCssCart() {
            document.getElementById('adding-form-cart').innerHTML = '<button class="btn btn-sm btn-disabled  ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
            return true;
        }

    </script>

@endsection