@if($product)
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
    $orders = $product->productPurchased()->orderBy('created_at', 'asc')->whereBetween('created_at', [$from_date, $to_date])->get();
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
        <h2 class="text-center">{{ $product->product_name }} Stock Report</h2>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <table class="table text-center table-bordered">
                    <thead>
                    <tr>
                        <th>Product Name:</th>
                        <td>{{ $product->product_name }}</td>
                        <th>Total Stock:</th>
                        <td>{{ $product->productInStock->total_stock }}</td>
                    </tr>
                    </thead>
                </table>
                <table class="table text-center">
                    <thead class="thead-light">
                    <tr>
                        <th>Invoice</th>
                        <th>Order Date</th>
                        <th>Stock</th>
                        <th>Per Product</th>
                        <th>Total Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->purchasedOrder->invoice_no }}</td>
                            <td>{{ $order->purchasedOrder->created_at->toFormattedDateString() }}</td>
                            <td>{{ $order->per_product_price }}</td>
                            <td>{{ $order->product_purchased_quantity }} Items</td>
                            <td>
                                <?php
                                    $total = $order->per_product_price * $order->product_purchased_quantity;
                                ?>
                                {{ $total }}
                            </td>
                        </tr>
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
    <p>No product found.</p>
@endif
