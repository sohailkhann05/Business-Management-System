@extends('layouts.branch-layout')
@section('title','Order Details')
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
                        Order details
                        @if($order->status == 0)
                            <span class="badge badge-pill badge-danger text-uppercase">
                                Pending.
                            </span>
                        @else
                            <span class="badge badge-pill badge-success text-uppercase">Completed.</span>
                        @endif
                        <a style="float: right;" href="{{ route('br-customerorder.index') }}"
                           class="btn btn-sm btn-default">
                            View All
                        </a>
                    </h3><hr>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th class="product_thumb">Image</th>
                                <th class="product_name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product_quantity">Quantity</th>
                                <th class="product_total">Sub Total</th>
                            </tr>
                            </thead>
                            <?php
                            $subTotal = 0;
                            $grandTotal = 0;
                            ?>
                            <tbody>
                            @foreach($order->sellOrderDetails as $detail)
                                <tr>
                                    <td>
                                        <img src="{{ asset('uploads/products/'.$detail->product->product_image) }}"
                                             alt="Rounded image"
                                             class="img-fluid rounded shadow" style="width: 150px;">
                                    </td>
                                    <td>
                                        {{ $detail->product->product_name }}
                                    </td>
                                    <td>
                                        Rs.{{ $detail->per_product_price }}
                                    </td>
                                    <td>
                                        {{ $detail->quantity }}
                                    </td>
                                    <td>
                                        <?php $sum = $detail->per_product_price * $detail->quantity; ?>
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
                    <div class="card-footer py-4">
                        <div class="row">
                            <div class="col-md-7">
                                <a href="{{ route('br-customerorder.edit',$order->id) }}" class="btn btn-sm btn-success ">
                                    Approve Order
                                </a>
                                <button class="btn btn-sm btn-danger">Cancel Order</button>
                            </div>
                            <div class="col-md-5">
                                <h3 style="float: right;">Total: Rs.{{ $grandTotal }}/-</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

@endsection
@section('script_content')

    <script>

        @if (Session::has('success'))
        toastr.success('Order has been approved successfully!');
        @endif

    </script>

@endsection