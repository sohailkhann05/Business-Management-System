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
    <hr>
    <h1 class="text-center">Trail Balance</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table text-center table-bordered">
                <tbody>
                <tr>
                    <td>Cash</td>
                    <td>{{ $cash }}/-</td>
                </tr>
                <tr>
                    <td>Bank</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Expenses</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Customers</td>
                    <td>{{ $customers_amount }}/-</td>
                </tr>
                <tr>
                    <td>Suppliers</td>
                    <td>{{ $suppliers_amount }}/-</td>
                </tr>
                <tr>
                    <td>Purchases</td>
                    <td>{{ $purchases_total }}/-</td>
                </tr>
                <tr>
                    <td>Sells</td>
                    <td>{{ $sell_total }}/-</td>
                </tr>
                <tr>
                    <td><h4>Total</h4></td>
                    <?php $total = $cash + $customers_amount + $suppliers_amount + $purchases_total + $sell_total; ?>
                    <td><h4>{{ $total }}/-</h4></td>
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
