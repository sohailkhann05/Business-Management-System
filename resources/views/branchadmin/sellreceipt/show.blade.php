@extends('layouts.branch-layout')
@section('title','Customer Receipt')
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
                        Customer Receipt
                        <a style="float: right;" href="{{ route('br-customerreceipt.index') }}"
                           class="btn btn-sm btn-default">
                            View All Receipt
                        </a>
                    </h3>
                    <hr>
                    <div class="row" style="background-color: #cad1d7; padding: 10px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <p>Customer: {{ $claim->user->name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p>Phone: {{ $claim->user->phone }}</p>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Received Quantity</th>
                                <th scope="col">Remaining Quantity</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php $i = 1; ?>
                            @foreach($claim->sellClaimDetails()->orderBy('created_at','desc')->get() as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>{{ $item->total_quantity }}</td>
                                    <td>
                                        @if($item->receipt_status == 1)
                                            Completed
                                        @elseif($item->receipt_status == 0)
                                            Remaining
                                        @endif
                                    </td>
                                    <td>{{ $item->received_quantity }}</td>
                                    <td>
                                        @if($item->receipt_status == 1)
                                            -
                                        @else
                                            {{ $item->remaining_quantity }}
                                        @endif
                                    </td>
                                    <td>{{ $item->updated_at->toFormattedDateString() }}</td>
                                    <td>
                                        @if($item->receipt_status == 1)
                                            -
                                        @else
                                            <button type="button" class="btn btn-sm btn-default" data-toggle="modal"
                                                    data-target="#update_quantity" title="Updated Quantity"
                                                    onclick="updateQuantity('{{ $item->id }}','{{ $item->total_quantity }}','{{ $item->received_quantity }}')">
                                                Updated Receipt
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

    <div class="modal fade" id="update_quantity" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Update Receipt</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'put','action' => ['BrSellReceiptController@update',Auth::guard('branch-admin')->id()],'onsubmit' => 'return loadingCss(this);']) }}
                    <input type="hidden" name="receipt_id" id="receiptId" value="">
                    <input type="hidden" name="total_quantity" id="totalQuantity" value="">
                    <input type="hidden" name="received_quantity" id="receivedQuantity" value="">
                    <div class="form-group">
                        <label for="">Received Quantity</label>
                        <small style="color: red;"> *</small>
                        <input type="number" min="1" name="received_quantity" class="form-control" placeholder="Received Quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="">Will you receive more quantity of this Claim?</label>
                        <small style="color: red;"> * Please Check Carefully!</small><br>
                        <input type="radio" name="check" value="Yes" required> Yes &nbsp;
                        <input type="radio" name="check" value="No" required> No
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" id="adding-form">
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

        function updateQuantity(detail_id,total_quantity,received_quantity) {
            $('#receiptId').val(detail_id);
            $('#totalQuantity').val(total_quantity);
            $('#receivedQuantity').val(received_quantity);
        }

    </script>

@endsection