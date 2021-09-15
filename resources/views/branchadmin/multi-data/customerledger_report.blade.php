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
    <h1 class="text-center">Customer Ledger <br>({{ $user->name }})</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table text-center">
                <thead class="thead-light">
                <tr>
                    <th>S.No</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
                </thead>
                <?php $sno = 1; ?>
                <tbody>
                @foreach($user_details as $detail)
                    <tr>
                        <td>{{ $sno++ }}</td>
                        <td>{{ $detail->amount }}</td>
                        <td>{{ $detail->transfer_type }}</td>
                        <td>{{ $detail->description }}</td>
                        <td>{{ $detail->transfer_date }}</td>
                    </tr>
                @endforeach
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