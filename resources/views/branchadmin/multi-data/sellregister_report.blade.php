@if($orders_collection->count() > 0)
    <h3>
        Generate Report
        <button style="float: right;" class="btn btn-sm btn-primary" onclick="printDiv('print')"
                style="cursor:pointer;">
            <i class="fa fa-print"></i>
            Print Report
        </button>
    </h3>
    <hr>
    <?php
    $business = Auth::guard('branch-admin')->user()->branch->business;
    ?>
    <div id="print">
        <div class="row">
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
        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table text-center">
                    <thead>
                    <tr style="border-bottom: 2px dashed #333;">
                        <th><h4>Customer Name: {{ $customer->name }}</h4></th>
                        <th></th>
                        <th><h4>Customer Amount: {{ $customer->userAccount->balance_amount }}/-</h4></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $grandTotal = 0; ?>
                    @foreach($orders_collection as $order)
                        <tr style="border-bottom: 2px dashed #333;">
                            <th><h4>Invoice No: {{ $order->invoice_no }}</h4></th>
                            <th></th>
                            <th><h4>Order Date: {{ $order->created_at->toFormattedDateString() }}</h4></th>
                            <th></th>
                        </tr>
                        <tr style="border-bottom: 2px dashed #333;">
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th></th>
                        </tr>
                        @foreach($order->sellOrderDetails as $item)
                            <tr>
                                <td>{{ $item->product->product_name }}</td>
                                <td>{{ $item->quantity }} Items</td>
                                <td>
                                    <?php
                                    $total = $item->quantity * $item->per_product_price;
                                    $grandTotal = $grandTotal + $total;
                                    ?>
                                    {{ $total }}
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                        <tr>
                            <th></th>
                            <th><h4>Discount: {{ $order->discount_amount }}</h4></th>
                            <?php $remaining = $grandTotal - $order->discount_amount; ?>
                            <th><h4>Total: {{ $grandTotal }}/-</h4></th>
                            <th></th>
                        </tr>
                        <?php sub?>
                        <tr>
                            <th></th>
                            <th></th>
                            <th><h4>After Discount: {{ $remaining }}/-</h4></th>
                            <th></th>
                        </tr><br><br>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
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
@else
    <p>No record found...</p>
@endif
