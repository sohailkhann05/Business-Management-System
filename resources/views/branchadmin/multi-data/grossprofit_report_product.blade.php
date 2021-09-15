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
    <br>
    <h1 class="text-center">Gross Profit and Loss Datewise <br>({{ $product->product_name }})</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table text-center table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Purchased Quantity</th>
                    <th>Sold Quantity</th>
                    <th>Sold Price</th>
                    <th>Income</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total_sell = 0;
                $total_sell_price = 0;
                $total_purchased = 0;
                $total_purchased_price = 0;
                ?>
                <tr>
                    @foreach($purchased_collection as $purchased)
                        <?php
                        $total_purchased = $total_purchased + $purchased->product_purchased_quantity;
                        $sub_purchased_total = $purchased->product_purchased_quantity * $product->product_initial_price;
                        $total_purchased_price = $total_purchased_price + $sub_purchased_total;
                        ?>
                    @endforeach
                    <td>{{ $total_purchased }} Items</td>
                        @foreach($sell_collection as $sell)
                            <?php
                            $total_sell = $total_sell + $sell->quantity;
                            $sub_sell_total = $sell->quantity * $product->product_purchased_price;
                            $total_sell_price = $total_sell_price + $sub_sell_total;
                            ?>
                        @endforeach
                    <td>{{ $total_sell }} Items.</td>
                    <td>{{ $sub_sell_total }}/-</td>
                        <?php $income = $sub_sell_total - $total_purchased_price; ?>
                    <td>{{ $income }}/-</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
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