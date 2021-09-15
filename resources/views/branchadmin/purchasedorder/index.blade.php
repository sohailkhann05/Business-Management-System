@extends('layouts.branch-layout')
@section('title','Purchased Orders')
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
    <?php $i = $orders->count(); ?>
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <h3>
                Search Order
                <a style="float: right;" href="{{ route('br-purchasedorder.create') }}"
                   class="btn btn-sm btn-default">
                    Add Purchased Order
                </a>
            </h3>
            <hr>
            @if($i > 0)
                <div class="row">
                    <div class="col-md-5">
                        <input class="form-control" placeholder="Enter Invoice No" type="text"
                               id="search_text">
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="search_btn" class="btn btn-default" onclick="searchInvoice()">Search
                        </button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div id="search_result"></div>
            @endif
        </div>
    </div><br>
    @if($i > 0)
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <h3>Purchased Order</h3>
                <p>Purchased orders are shown on recent order.</p>
                <hr>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Invoice no</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Belty no</th>
                            <th scope="col">Receiver</th>
                            <th scope="col">Date</th>
                            <th scope="col">Details</th>
                            <th scope="col">Report</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->invoice_no }}</td>
                                <td>
                                    <a href="{{ route('br-supplier.show',$order->user_id) }}">{{ $order->user->name }}
                                </td>
                                <td>{{ $order->belty_no }}</td>
                                <td>{{ $order->received_by }}</td>
                                <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                <td>
                                    <a href="{{ route('br-purchasedorder.show',$order->id) }}"
                                       class="btn btn-sm btn-white">View</a>
                                </td>
                                <td>
                                    <a href="{{ route('br-purchasedorder.edit',$order->id) }}"
                                       type="btn btn-sm btn-default"
                                       class="btn btn-sm btn-white">
                                        Generate Report
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                {{ $orders->links() }}
                @else
                    <p>No purchased order record found.</p>
                @endif
            </div>
        </div>
        </div>
        </div><br>

@endsection
@section('script_content')

    <script>

        function searchInvoice() {
            var search_data = $('#search_text').val();
            if (search_data == '' || search_data == null) {
                document.getElementById('search_text').style.border = "1px solid #d71313";
            } else {
                document.getElementById('search_result').innerHTML = '<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
                document.getElementById('search_text').style.border = "1px solid #cad1d7";
                // document.getElementById('search_btn').setAttribute('disabled', true);
                var data = "invoice_no=" + search_data;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/branchsearchinvoice') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_result').innerHTML = data;
                    }
                });
            }
        }

    </script>

@endsection