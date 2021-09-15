@extends('layouts.branch-layout')
@section('title','Customer Orders')
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
                        All New Orders
                    </h3><hr>
                    <?php
                    $i = 1;
                    $total = 0;
                    $products = 1;
                    ?>
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        @foreach($order->sellOrderDetails as $detail)
                                            <?php
                                            $sum = $detail->per_product_price * $detail->quantity;
                                            $total = $total + $sum;
                                            $products++;
                                            ?>
                                        @endforeach
                                        <td>
                                            Rs.{{ $total }} For {{ $products }} Items.
                                        </td>
                                        <td>
                                            {{ $order->created_at->toFormattedDateString() }}
                                        </td>
                                        <td>
                                            <a href="{{ route('br-customerorder.show',$order->id) }}" class="btn btn-sm btn-white">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><br>
                        {{ $orders->links() }}
                    @else
                        <p>No new orders record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>

@endsection