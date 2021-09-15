@extends('layouts.template')
@section('title','Cart')
@section('body_content')

    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('shop.show',session('shop')->id) }}">home</a></li>
                            <li>/</li>
                            <li>cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shopping_cart_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <?php
                        $carts = Auth::guard('customer')->user()->carts()->where('status',0)->get();
                        $grandTotal = 0;
                        $cartTotal = 0;
                        ?>
                        @if(Auth::guard('customer')->user())
                            @if($carts->count() > 0)
                                <div class="cart_page table-responsive">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Total</th>
                                            <th class="product_remove">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($carts as $cart)
                                            <tr>
                                                <td class="product_thumb">
                                                    <img src="{{ asset('uploads/products/'.$cart->product->product_image) }}"
                                                         alt=""
                                                         title="" img-fluid rounded shadow-lg>
                                                </td>
                                                <td class="product_name">
                                                    {{ $cart->product->product_name }}
                                                </td>
                                                <td class="product-price">
                                                    Rs.{{ $cart->product->product_purchased_price }}
                                                </td>
                                                <td class="product_quantity" id="edit_quantity_{{ $cart->id }}">
                                                    {{ $cart->quantity }} &nbsp;
                                                    <button type="button" class="btn btn-sm btn-default" title="Edit"
                                                            onclick="editQuantity('{{ $cart->id }}','{{ $cart->quantity }}')">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                                <td class="product_total">
                                                    <?php $subTotal = $cart->product->product_purchased_price * $cart->quantity; ?>
                                                    {{ $subTotal }}
                                                </td>
                                                <td class="product_remove">
                                                    {{ Form::open(['method' => 'delete','action' => ['CartController@destroy',$cart->id]]) }}
                                                    <button type="submit" class="btn ">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                    {{ Form::close() }}
                                                </td>
                                            </tr>
                                            <?php
                                            $cartTotal = $cartTotal + $subTotal;
                                            $grandTotal = $grandTotal + $cartTotal;
                                            ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart_submit">
                                    <button type="button" class="btn btn-sm btn-success"
                                            data-toggle="modal" data-target="#confirm_cart">
                                        Update Cart
                                    </button>
                                </div>
                            @else
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
            @if($carts->count() > 0)
                <div class="coupon_area">
                    <div class="row">
                        <div class="col-lg-5 col-md-5"></div>
                        <div class="col-lg-7 col-md-7">
                            <div class="coupon_code right">
                                <h3>Cart Totals</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal">
                                        <p>Subtotal</p>
                                        <p class="cart_amount">Rs.{{ $grandTotal }}/-</p>
                                    </div>
                                    <div class="cart_subtotal ">
                                        <p>Shipping</p>
                                        <p class="cart_amount"></p>
                                    </div>
                                    <div class="cart_subtotal">
                                        <p>Total</p>
                                        <p class="cart_amount">Rs.{{ $grandTotal }}/-</p>
                                    </div>
                                    <div class="checkout_btn">
                                        <a href="{{ route('checkout.show',Auth::guard('customer')->id()) }}">Proceed to Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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

    <div class="modal fade" id="confirm_cart" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
         aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-notification">Cart Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="heading mt-4">Are you sure?</h4>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('cart.show',session('shop')->id) }}" class="btn btn-success">Confirm</a>
                    <button type="button" class="btn btn-neutral" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_content')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function editQuantity(id, quantity) {
            var quantity_id = 'edit_quantity_' + id;
            var data = "quantity=" + quantity + "&id=" + id;
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/edit-customer-quantity') }}',
                data: data,
                success: function (data) {
                    document.getElementById(quantity_id).innerHTML = data;
                }
            });
        }

        function updateQuantity(id) {
            var quantity_id = 'edit_quantity_' + id;
            var quantity = $('#update_quantity_' + id).val();
            var data = "quantity=" + quantity + "&id=" + id;
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/update-customer-quantity') }}',
                data: data,
                success: function (data) {
                    document.getElementById(quantity_id).innerHTML = data;
                }
            });
        }

        @if (Session::has('success'))
        toastr.success('Product has been removed from Cart!');
        @endif

        @if (Session::has('info'))
        toastr.info('Product already added to Cart!');
        @endif

    </script>

@endsection