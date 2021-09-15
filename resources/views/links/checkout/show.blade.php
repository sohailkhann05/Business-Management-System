@extends('layouts.template')
@section('title','Checkout')
@section('body_content')

    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('shop.show',session('shop')->id) }}">home</a></li>
                            <li>/</li>
                            <li>checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $carts = Auth::guard('customer')->user()->carts()->where('status', 0)->get();
    $grandTotal = 0;
    $cartTotal = 0;
    $sellOrders = \App\SellOrder::all();
    if ($sellOrders->count() > 0)
        $orders = Auth::guard('customer')->user()->sellOrders()->where('status', 0)->get();
    ?>

    <div class="Checkout_section">
        <div class="container">
            <div class="checkout_form">
                @if($carts->count() > 0)
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <h3>Billing Details</h3>
                            <div class="row">

                                <div class="col-lg-12 mb-20">
                                    <label>Full Name <span>*</span></label>
                                    <input type="text" name="name"
                                           value="{{ Auth::guard('customer')->user()->name }}" readonly>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label> Email Address <span>*</span></label>
                                    <input type="text" name="email"
                                           value="{{ Auth::guard('customer')->user()->email }}" readonly>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label>Phone<span>*</span></label>
                                    <input type="text" name="phone"
                                           value="{{ Auth::guard('customer')->user()->phone }}" readonly>
                                </div>
                                <div class="col-12 mb-20">
                                    <label for="country">Country <span>*</span></label>
                                    <input type="text" name="country"
                                           value="{{ Auth::guard('customer')->user()->country }}" readonly="">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Street address <span>*</span></label>
                                    <textarea class="form-control" readonly name="address"
                                              placeholder="Home Address">{{ Auth::guard('customer')->user()->address }}</textarea>
                                </div>
                                <div class="col-6 mb-20">
                                    <label>Town / City <span>*</span></label>
                                    <input type="text" name="city"
                                           value="{{ Auth::guard('customer')->user()->city }}" readonly>
                                </div>
                                <div class="col-6 mb-20">
                                    <label>State<span>*</span></label>
                                    <input type="text" name="region"
                                           value="{{ Auth::guard('customer')->user()->region }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <h3>Your order</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)
                                        <tr>
                                            <td> {{ $cart->product->product_name }} <strong>
                                                    × {{ $cart->quantity }}</strong></td>
                                            <td>
                                                <?php $price = $cart->product->product_purchased_price * $cart->quantity; ?>
                                                Rs.{{ $price }}/-
                                            </td>
                                        </tr>
                                        <?php
                                        $cartTotal = $cartTotal + $price;
                                        $grandTotal = $grandTotal + $cartTotal;
                                        ?>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Cart Subtotal</th>
                                        <td>Rs.{{ $cartTotal }}/-</td>
                                    </tr>
                                    <tr class="order_total">
                                        <th>Order Total</th>
                                        <td><strong>Rs.{{ $grandTotal }}/-</strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment_method">
                                <div class="order_button">
                                    <button type="button" class="btn btn-sm btn-success"
                                            data-toggle="modal" data-target="#confirm_order">
                                        Confirm Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                @endif
                @if($sellOrders->count() > 0)
                    @if($orders->count() > 0)
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <h3>Order Details</h3>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Order</th>
                                            <th scope="col">Order Status</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        $total = 0;
                                        $products = 1;
                                        ?>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                @foreach($order->sellOrderDetails as $detail)
                                                    <?php
                                                    $sum = $detail->per_product_price * $detail->quantity;
                                                    $total = $total + $sum;
                                                    $products++;
                                                    ?>
                                                @endforeach
                                                <td>
                                                    @if($order->status == 0)
                                                        Pending.
                                                    @endif
                                                </td>
                                                <td>
                                                    Rs.{{ $total }} For {{ $products }} Items.
                                                </td>
                                                <td>
                                                    {{ $order->created_at->toFormattedDateString() }}
                                                </td>
                                                <td>
                                                    View
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if($sellOrders->count() > 0)
                    @if($orders->count() == 0 && $carts->count() == 0)
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="coupon_code left">
                                    <h3>Shopping cart</h3>
                                    <div class="coupon_inner">
                                        <h5>Shopping Cart is empty.</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="banner_section banner_column1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single_banner">
                        <a href=""><img src="{{ asset('uploads/bg/banner7.jpg') }}" alt=""></a>
                        <div class="banner_popup">
                            <a class="video_popup"
                               href="https://www.youtube.com/watch?v=7OycwyrZ6Hc&amp;list=RDxyuLlnnfDcI&amp;index=9"><i
                                        class="fa fa-image"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm_order" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
         aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-notification">Confirm Order</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="heading mt-4">Are you sure?</h4>
                </div>
                <div class="modal-footer">
                    {{ Form::open(['action' => 'CheckoutController@store']) }}
                    <button type="submit" class="btn btn-success">Confirm</button>
                    {{ Form::close() }}
                    <button type="button" class="btn btn-neutral" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_content')

    <script>

        @if (Session::has('success'))
        toastr.success('Order has been sent!');
        @endif

        @if (Session::has('info'))
        toastr.info('Product already added to Cart!');
        @endif

    </script>

@endsection