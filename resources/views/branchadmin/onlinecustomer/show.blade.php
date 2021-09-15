@extends('layouts.branch-layout')
@section('title',$customer->name)
@section('body_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        {{ $customer->name }}
                        <a href="{{ route('br-onlinecustomer.index') }}" class="btn btn-sm btn-default"
                           style="float: right;">
                            View All
                        </a>
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <h3>Name</h3>
                            <p>{{ $customer->name }}</p>
                            <h3>Phone</h3>
                            <p>{{ $customer->phone }}</p>
                            <h3>Region</h3>
                            <p>{{ $customer->region }}</p>
                        </div>
                        <div class="col-md-5">
                            <h3>Email</h3>
                            <p>{{ $customer->email }}</p>
                            <h3>City</h3>
                            <p>{{ $customer->city }}</p>
                            <h3>Country</h3>
                            <p>{{ $customer->country }}</p>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <h3>Address</h3>
                            <p>{{ $customer->address }}</p>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>Order History</h3>
                    <hr>
                    @if($customer->sellOrders()->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                $total = 0;
                                ?>
                                @foreach($customer->sellOrders()->orderBy('created_at','desc')->get() as $sellOrder)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $sellOrder->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            @if($sellOrder->status == 0)
                                                Pending.
                                            @elseif($sellOrder->status == 1)
                                                Accepted.
                                            @endif
                                        </td>
                                        @foreach($sellOrder->sellOrderDetails as $sellOrderDetail)
                                            <?php
                                            $subTotal = $sellOrderDetail->per_product_price * $sellOrderDetail->quantity;
                                            $total = $total + $subTotal;
                                            ?>
                                        @endforeach
                                        <td>
                                            Rs. {{ $total }}
                                        </td>
                                        <td>
                                            @if($sellOrder->status == 1)
                                                <a href="{{ route('br-onlinecustomer.edit',$sellOrder->id) }}"
                                                   class="btn btn-sm btn-white">
                                                    View Report
                                                </a>
                                            @else
                                                Pending
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No sell order record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>

@endsection