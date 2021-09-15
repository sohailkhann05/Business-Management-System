@extends('layouts.branch-layout')
@section('title','Add Customer Claim')
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
                        Add Customer Claim
                        <a style="float: right;" href="{{ route('br-customerclaim.index') }}"
                           class="btn btn-sm btn-default">
                            View Customer Claim
                        </a>
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Enter Product name" type="text"
                                           id="search_text" onblur="getCustomer()">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="customer_id" id="customer" class="form-control">
                                    <option value="">Select Customer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="search_btn" class="btn btn-default" onclick="searchProduct()">
                                Search
                            </button>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    @if($errors->any())
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0 text-danger">Error's</h3>
                <hr>
                @foreach($errors->all() as $error)
                    <li class="text-warning" style="list-style-type: circle;">{{ $error }}</li>
                @endforeach
            </div>
        </div><br>
    @endif
    <div class="row" style="visibility: hidden;" id="search_div">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>Search result...</h3>
                    <hr>
                    <div id="search_result">
                    </div>
                </div>
            </div>
        </div>
    </div><br>

    <div class="modal fade" id="add_to_claim" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Add To Claim</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['action' => 'BrSellClaimController@store','onsubmit' => 'return loadingCss(this);']) }}
                    <input type="hidden" name="user_id" id="userId" value="">
                    <input type="hidden" name="sell_order_id" id="sellOrderId" value="">
                    <input type="hidden" name="product_id" id="productId" value="">
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <small> *</small>
                        <input type="number" required name="quantity" min="0" class="form-control"
                               placeholder="Quantity">
                    </div>
                    <div class="form-group">
                        <label for="">Defect Reason</label>
                        <small> *</small>
                        <textarea name="defect_reason" rows="2" required class="form-control"
                                  placeholder="Defect Reason..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" id="adding-form">
                        <button type="submit" class="btn btn-sm btn-default">Confirm</button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

@endsection
@section('script_content')

    <script>

        function getCustomer() {
            var search_data = $('#search_text').val();
            if (search_data != '') {
                var data = "product=" + search_data;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/sellclaimcustomer') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('customer').innerHTML = data;
                    }
                });
            }
        }

        function searchProduct() {
            var search_data = $('#search_text').val();
            var customer_id = $('#customer').val();
            if (search_data == '' || search_data == null || customer_id == '') {
                document.getElementById('search_text').style.border = "1px solid #d71313";
                document.getElementById('customer').style.border = "1px solid #d71313";
            } else {
                document.getElementById('search_div').style.visibility = 'visible';
                document.getElementById('search_result').innerHTML = '<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
                document.getElementById('search_text').style.border = "1px solid #cad1d7";
                document.getElementById('customer').style.border = "1px solid #cad1d7";
                // document.getElementById('search_btn').setAttribute('disabled', true);
                var data = "product=" + search_data + "&customer_id=" + customer_id;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/sellclaimsearch') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_result').innerHTML = data;
                    }
                });
            }
        }

        function addToClaim(user_id, sell_order_id, product_id) {
            $('#userId').val(user_id);
            $('#sellOrderId').val(sell_order_id);
            $('#productId').val(product_id);
        }

    </script>

@endsection