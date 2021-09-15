@extends('layouts.branch-layout')
@section('title','Dashbaord')
@section('body_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>Shop Current Stock Exchange</h3>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <h3>Clients List</h3>
                            <hr>
                            <p>Customer's <span style="float: right;">({{ $customer }})</span></p>
                            <p>Marketing Manager's <span style="float: right;">({{ $marketing_manager }})</span></p>
                            <p>Supplier's <span style="float: right;">({{ $supplier }})</span></p>
                            <p>Vehicle's <span style="float: right;">({{ $vehicle }})</span></p>
                            <p>Online Customer's <span style="float: right;">({{ $online_customers }})</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <h3>Orders List</h3>
                            <hr>
                            <p>Purchases <span style="float: right;">({{ $purchases }})</span></p>
                            <p>Sells <span style="float: right;">({{ $sells }})</span></p>
                            <p>Purchase Claims <span style="float: right;">({{ $purchase_claims }})</span></p>
                            <p>Sell Claims <span style="float: right;">({{ $sell_claims }})</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>Products Stock</h3>
                    <hr>
                    @if($products->count() > 0)
                        @foreach($products as $product)
                            <p>{{ $product->product_name }} <span style="float: right;">({{ $product->productInStock->total_stock }})</span></p>
                        @endforeach
                    @else
                        <p>No product found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection