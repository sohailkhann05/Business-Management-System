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
                Order History
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
            <?php
            $i = 1;
            $total = 0;
            ?>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                {{ $order->created_at->toFormattedDateString() }}
                            </td>
                            @foreach($order->sellOrderDetails as $detail)
                                <?php
                                $sum = $detail->per_product_price * $detail->quantity;
                                $total = $total + $sum;
                                ?>
                            @endforeach
                            <td>
                                Rs.{{ $total }}/-
                            </td>
                            <td>Completed.</td>
                            <td>
                                <a href="{{ route('br-sellorderdetail.show',$order->id) }}"
                                   class="btn btn-sm btn-white">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><br>

@endsection