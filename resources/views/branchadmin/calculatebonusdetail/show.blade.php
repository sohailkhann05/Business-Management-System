@extends('layouts.branch-layout')
@section('title','Bonus Report')
@section('body_content')

    @if(session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text"><strong>Success!</strong> {{ session('info') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Bonus Report
                        <button style="float: right;" class="btn btn-sm btn-primary" onclick="printDiv('print')"
                                style="cursor:pointer;">
                            <i class="fa fa-print"></i>
                            Print Report
                        </button>
                        <a href="{{ route('br-supplierbonusdetail.index') }}" class="btn btn-sm btn-white" style="float: right;">
                            View All
                        </a>
                    </h3>
                    <hr>
                    <?php
                    $supplier = $bonus->user;
                    $sales = 0;
                    ?>
                    <div id="print">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pl-md-5">
                                    <h2>Supplier Details</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <p>Name: {{ $supplier->name }}</p>
                                            <p>City: {{ $supplier->city }}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>Phone: {{ $supplier->phone }}</p>
                                            <p>Region: {{ $supplier->region }}</p>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <p>Address: {{ $supplier->address }}</p>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <br>
                                    <h2>Bonus Details</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <p>Start Date: {{ $bonus->start_date }}</p>
                                            <p>Percentage: {{ $bonus->percentage }}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>End Date: {{ $bonus->end_date }}</p>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <br>
                                    <h2>Product Details</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table align-items-center table-flush">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Unit Price</th>
                                                        <th scope="col">Sales</th>
                                                        <th scope="col">Sub Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($bonus->productBonusDetails as $bonusDetail)
                                                        <tr>
                                                            <td>
                                                                {{ $bonusDetail->product->product_name }}
                                                            </td>
                                                            <td>
                                                                Rs. {{ $bonusDetail->product->product_purchased_price }}
                                                            </td>
                                                            <td>
                                                                {{ $bonusDetail->total_sales }}
                                                                <?php $sales = $sales + $bonusDetail->total_sales; ?>
                                                            </td>
                                                            <td>
                                                                Rs. {{ $bonusDetail->total_amount }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><hr>
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <h4>Overall Sales: {{ $sales }}</h4>
                                            <h4>Total Amount: Rs. {{ $bonus->total }}/-</h4>
                                            <h4>Percentage: {{ $bonus->percentage }}%</h4>
                                            <h4>
                                                <?php $total_bonus = ($bonus->total * $bonus->percentage) / 100 ;?>
                                                Total Bonus: Rs. {{ $total_bonus }}/-
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

@endsection