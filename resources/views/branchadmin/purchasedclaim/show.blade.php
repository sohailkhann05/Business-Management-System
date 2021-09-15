@extends('layouts.branch-layout')
@section('title','Supplier Claim')
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

    <?php $claims = $claim->purchasedClaimDetails->where('claim_status', 0); ?>
    <?php $claimed = $claim->purchasedClaimDetails->where('claim_status', 1); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        {{ $claim->user->name }} Claim
                        <a style="float: right;" href="{{ route('br-supplierclaim.index') }}"
                           class="btn btn-sm btn-default">
                            View All Claim
                        </a>
                    </h3>
                    <hr>
                    @if($claims->count() > 0)
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Enter Product name" type="text"
                                               id="search_text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="supplier_id" id="supplier" class="form-control">
                                        <option value="{{ $claim->user_id }}">{{ $claim->user->name }}</option>
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
                    @else
                        <p>Currently no product found on this claim with zero status.</p>
                    @endif
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
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Claimed Products Detail
                        @if($claims->count() > 0)
                            <button style="float: right;" type="button" class="btn btn-sm btn-success"
                                    data-toggle="modal" data-target="#confirm_claim"
                                    onclick="confirmClaim('{{ $claim->id }}')"
                                    title="">
                                Confirm Products Claim
                            </button>
                        @endif
                        @if($claimed->count() > 0)
                            <a href="{{ route('br-supplierclaim.edit',$claim->id) }}" style="float: right;"
                               class="btn btn-sm btn-default">
                                {{ $claim->user->name }} Claims
                            </a>
                        @endif
                    </h3>
                    <hr>
                    @if($claims->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sno = 1; ?>
                                @foreach($claims as $claimDetail)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $claimDetail->product->product_name }}</td>
                                        <td>{{ $claimDetail->total_quantity }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                    data-toggle="modal" data-target="#delete_product"
                                                    onclick="deleteProduct('{{ $claimDetail->id }}')"
                                                    title="Add to Claim">
                                                <i class="ni ni-fat-remove"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Currently no product found on this claim with zero status.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>
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
                    {{ Form::open(['action' => 'BrPurchasedClaimController@store','onsubmit' => 'return loadingCssAddClaim(this);']) }}
                    <input type="hidden" name="user_id" id="userId" value="">
                    <input type="hidden" name="purchased_order_id" id="purchasedOrderId" value="">
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
                    <div class="form-group" id="adding-form-add-claim">
                        <button type="submit" class="btn btn-sm btn-default">Confirm</button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete_product" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Delete Claim Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    {{ Form::open(['method' => 'delete','action' => ['BrPurchasedClaimController@destroy',Auth::guard('branch-admin')->id()],'onsubmit' => 'return loadingCssDeleteClaim(this);']) }}
                    <input type="hidden" name="claim_id" id="claimId" value="">
                    <div class="form-group" id="adding-form-delete-claim">
                        <button type="submit" class="btn btn-sm btn-default">Confirm</button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm_claim" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Confirm Claim Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    {{ Form::open(['method' => 'put','action' => ['BrPurchasedClaimController@update',Auth::guard('branch-admin')->id()],'onsubmit' => 'return loadingCssConfirmClaim(this);']) }}
                    <input type="hidden" name="claim_id" id="confirmClaimId" value="">
                    <div class="form-group" id="adding-form-confirm-claim">
                        <button type="submit" class="btn btn-sm btn-default">Confirm</button>
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

        function searchProduct() {
            var search_data = $('#search_text').val();
            var supplier_id = $('#supplier').val();
            if (search_data == '' || search_data == null || supplier_id == '') {
                document.getElementById('search_text').style.border = "1px solid #d71313";
                document.getElementById('supplier').style.border = "1px solid #d71313";
            } else {
                document.getElementById('search_div').style.visibility = 'visible';
                document.getElementById('search_result').innerHTML = '<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
                document.getElementById('search_text').style.border = "1px solid #fff";
                // document.getElementById('search_btn').setAttribute('disabled', true);
                var data = "product=" + search_data + "&supplier_id=" + supplier_id;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/purchasedclaimsearch') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_result').innerHTML = data;
                    }
                });
            }
        }

        function addToClaim(user_id, purchased_order_id, product_id) {
            $('#userId').val(user_id);
            $('#purchasedOrderId').val(purchased_order_id);
            $('#productId').val(product_id);
        }

        function deleteProduct(id) {
            $('#claimId').val(id);
        }

        function confirmClaim(id) {
            $('#confirmClaimId').val(id);
        }

        function loadingCssAddClaim() {
            document.getElementById('adding-form-add-claim').innerHTML = '<button class="btn btn-sm btn-disabled  ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
            return true;
        }

        function loadingCssDeleteClaim() {
            document.getElementById('adding-form-delete-claim').innerHTML = '<button class="btn btn-sm btn-disabled  ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
            return true;
        }

        function loadingCssConfirmClaim() {
            document.getElementById('adding-form-confirm-claim').innerHTML = '<button class="btn btn-sm btn-disabled  ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
            return true;
        }

    </script>

@endsection