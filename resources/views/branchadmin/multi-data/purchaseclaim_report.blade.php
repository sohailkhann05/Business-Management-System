@if($claim_collection->count() > 0)
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
        <h1 class="text-center">Supplier Claim Details</h1><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th><h4>Supplier Name: {{ $supplier->name }}</h4></th>
                        <th></th>
                        <th><h4>Supplier Amount: {{ $supplier->userAccount->balance_amount }}/-</h4></th>
                        <th></th>
                    </tr>
                    <tr style="border-bottom: 2px dashed #333;">
                        <th><h4>Supplier Address: {{ $supplier->address }}</h4></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>                    </thead>
                    <tbody>
                    <?php $grandTotal = 0; ?>
                    @foreach($claim_collection as $claim)
                        <tr style="border-bottom: 2px dashed #333;">
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Defect Reason</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        @foreach($claim->purchasedClaimDetails as $item)
                            <tr>
                                <td>{{ $item->product->product_name }}</td>
                                <td>{{ $item->total_quantity }} Items</td>
                                <?php $reason = substr($item->defect_reason, 0, 60); ?>
                                <td>{{ $reason }}</td>
                                <td>{{ $claim->created_at->toFormattedDateString() }}</td>
                            </tr>
                        @endforeach
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
    <p>No claim found...</p>
@endif