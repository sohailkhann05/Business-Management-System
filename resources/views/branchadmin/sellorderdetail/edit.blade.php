@extends('layouts.branch-layout')
@section('title','Generate Report')
@section('body_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Generate Report
                        <button style="float: right;" class="btn btn-sm btn-primary" onclick="printDiv('print')"
                                style="cursor:pointer;">
                            <i class="fa fa-print"></i>
                            Print Report
                        </button>
                        <a style="float: right;" href="{{ route('br-sellorderdetail.show',$order->id) }}"
                           class="btn btn-sm btn-default">
                            Back To Order
                        </a>
                    </h3>
                    <hr>
                    <?php
                    $business = Auth::guard('branch-admin')->user()->branch->business;
                    $customer = $order->customer;
                    if ($customer)
                        $customer = $order->customer;
                    else
                        $customer = $order->user;
                    ?>
                    <div id="print">
                        <div class="row mb-5">
                            <div class="col-md-3 text-center">
                                <img src="{{ asset('uploads/logo/'.$business->business_logo) }}"
                                     alt="Logo" class="img-fluid rounded-circle shadow" style="width: 120px;">
                            </div>
                            <div class="col-md-6 text-center">
                                <h1 style="font-size: 50px;">{{ $business->business_title }}</h1>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pl-md-5">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <p>Invoice Number: {{ $order->invoice_no }}</p>
                                            <p>Client Name: {{ $order->user->name }}</p>
                                            <p>Address: {{ $order->user->address }}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>Belty No: {{ $order->belty_no }}</p>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <br>
                                    <table class="table text-center table-bordered">
                                        <thead class="thead-light">
                                        <tr>
                                            <th class="product_name">Product</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product-price">Price</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        $subTotal = 0;
                                        $grandTotal = 0;
                                        ?>
                                        <tbody>
                                        @foreach($order->sellOrderDetails as $detail)
                                            <tr>
                                                <td>
                                                    {{ $detail->product->product_name }}
                                                </td>
                                                <td>
                                                    {{ $detail->quantity }}
                                                </td>
                                                <td>
                                                    Rs.{{ $detail->per_product_price }}
                                                </td>
                                                <?php $sum = $detail->per_product_price * $detail->quantity; ?>
                                            </tr>
                                            <?php
                                            $subTotal = $subTotal + $sum;
                                            $grandTotal = $grandTotal + $subTotal;
                                            ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pl-md-5">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <h3>Mobile: {{ $business->business_phone_no }}</h3>
                                            <h4>Email: {{ $business->business_email_address }}</h4><br><br>
                                            <h4>Signature: _________________________</h4><br><br>
                                            <h4>Stamp:</h4>
                                        </div>
                                        <div class="col-md-5">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td><h4>Total</h4></td>
                                                    <td><h4>{{ $grandTotal }}/-</h4></td>
                                                </tr>
                                                <tr>
                                                    <td><h4>Discount</h4></td>
                                                    <td><h4>{{ $order->discount_amount }}/-</h4></td>
                                                </tr>
                                                <tr>
                                                    <td><h4>After Discount</h4></td>
                                                    <td><h4>{{ $grandTotal - $order->discount_amount }}/-</h4></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="pl-md-5">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <h3>{{ $business->business_address }}</h3><br>
                                    <p style="float: left;">Date: {{ now()->toFormattedDateString() }}</p>
                                    <p style="float: right;">www.malakandsoft.net</p>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

@endsection
