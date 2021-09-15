@extends('layouts.branch-layout')
@section('title','Sell Order Returns')
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
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Sell Order Returns
                        <a style="float: right;" href="{{ route('br-sellorderreturn.create') }}"
                           class="btn btn-sm btn-default">
                            Add Order Return
                        </a>
                        <p>Sell order are shown on recent activity.</p>
                    </h3>
                    <hr>
                    <?php
                    $i = $orders->count();
                    ?>
                    @if($i > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Invoice no</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Report</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    @if($order->sellOrderReturn != null)
                                        <tr>
                                            <td>{{ $order->invoice_no }}</td>
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                <a href="{{ route('br-sellorderreturn.show',$order->sellOrderReturn->id) }}"
                                                   class="btn btn-sm btn-white">View</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('br-sellorderreturn.edit',$order->sellOrderReturn->id) }}" class="btn btn-sm btn-white"
                                                   title="Generate Report">
                                                    Generate Report
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div><br>
                        {{ $orders->links() }}
                    @else
                        <p>No purchased order return record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>

@endsection