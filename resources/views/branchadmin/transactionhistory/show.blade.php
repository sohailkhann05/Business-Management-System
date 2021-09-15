@extends('layouts.branch-layout')
@section('title','Order History')
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
    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <h3>
                Transaction History
                @if($supplier->userCategory->user_category_name == 'Supplier')
                    <a style="float: right;" href="{{ route('br-supplier.show',$supplier->id) }}"
                       class="btn btn-sm btn-white">
                        Back To Profile
                    </a>
                @elseif($supplier->userCategory->user_category_name == 'Customer')
                    <a style="float: right;" href="{{ route('br-customer.show',$supplier->id) }}"
                       class="btn btn-sm btn-white">
                        Back To Profile
                    </a>
                @endif
            </h3>
            <p>Order on recent activity</p>
            <br>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $i-- }}</td>
                            <td>Rs. {{ $transaction->amount }}</td>
                            <td>{{ $transaction->transfer_type }}</td>
                            <td>{{ $transaction->transfer_date }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-white" data-toggle="modal"
                                        data-target="#transaction_details"
                                        onclick="transactionDetails('{{ $transaction->description }}')">
                                    View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><br>
    <div class="modal fade" id="transaction_details" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-default">Transaction Details</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="transaction_record_detail"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_content')

    <script>

        function transactionDetails(data) {
            document.getElementById('transaction_record_detail').innerHTML = data;
        }

    </script>

@endsection