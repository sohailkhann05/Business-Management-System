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
                        <a style="float: right;" href="{{ route('br-purchasedorderreturn.show',$orderReturn->id) }}"
                           class="btn btn-sm btn-default">
                            Back To Order
                        </a>
                    </h3>
                    <hr>
                    <?php
                    $business = Auth::guard('branch-admin')->user()->branch->business;
                    ?>
                    <div id="print">
                        <div class="row mb-5">
                            <div class="col-md-3 text-center">
                                <img src="{{ asset('uploads/logo/'.$business->business_logo) }}"
                                     alt="Logo" class="img-fluid rounded-circle shadow" style="width: 120px;">
                            </div>
                            <div class="col-md-6 text-center">
                                <h1>{{ $business->business_title }}</h1>
                                <h4>{{ $business->business_phone_no }}</h4>
                                <p>{{ $business->business_address }}</p>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pl-md-5">
                                    <h2>Supplier Details</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <p>Name: {{ $orderReturn->purchasedOrder->user->name }}</p>
                                            <p>City: {{ $orderReturn->purchasedOrder->user->city }}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>Return Date: {{ $orderReturn->created_at->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <p>Address: {{ $orderReturn->purchasedOrder->user->address }}</p>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pl-md-5">
                                    <h2>Order Details</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <p>Invoice No: {{ $orderReturn->invoice_no }}</p>
                                            <p>Description: {{ $orderReturn->description }}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>Belty No: {{ $orderReturn->belty_no }}</p>
                                            <p>Discount: {{ $orderReturn->discount_amount }}</p>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <br>
                                    <table class="table align-items-center table-flush text-center">
                                        <thead>
                                        <tr>
                                            <th class="product_thumb">S.No</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Sub Total</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        $subTotal = 0;
                                        $grandTotal = 0;
                                        $i = 1;
                                        ?>
                                        <tbody>
                                        @foreach($orderReturn->purchasedOrderReturnDetails as $detail)
                                            <tr>
                                                <td>
                                                    {{ $i++ }}
                                                </td>
                                                <td>
                                                    {{ $detail->product->product_name }}
                                                </td>
                                                <td>
                                                    <?php $product = \App\ProductPurchased::where('purchased_order_id', $orderReturn->purchased_order_id)->where('product_id', $detail->product_id)->first(); ?>
                                                    Rs.{{ $product->per_product_price }}
                                                </td>
                                                <td>
                                                    {{ $detail->return_quantity }}
                                                </td>
                                                <td>
                                                    <?php $sum = $product->per_product_price * $detail->return_quantity; ?>
                                                    Rs.{{ $sum }}
                                                </td>
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
                        <br>
                        <div class="pl-md-5">
                            <hr>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <p>Total Amount: Rs. {{ $grandTotal }}/-</p>
                                    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($grandTotal, 'C39')}}"
                                         alt="barcode"/>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

@endsection