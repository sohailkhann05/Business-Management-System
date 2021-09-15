@extends('layouts.branch-layout')
@section('title','Customer Balance')
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
                        <h2 class="text-center">Customer Balances</h2>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pl-md-5">
                                    <table class="table text-center table-bordered">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Balance</th>
                                        </tr>
                                        </thead>
                                        <?php $i = 1; $grandTotal = 0;?>
                                        <tbody>
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->userAccount->balance_amount }}</td>
                                                <?php $grandTotal = $grandTotal + $customer->userAccount->balance_amount;?>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><h4>Balance: {{ $grandTotal }}</h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
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
                </div>
            </div>
        </div>
    </div><br>

@endsection