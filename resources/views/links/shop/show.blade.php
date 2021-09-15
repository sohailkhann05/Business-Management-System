@extends('layouts.template')
@section('title',$shop->branch_title)
@section('body_content')

    {{--Shipping Section--}}
    <div class="shipping_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <p>

                            <img src="{{ asset('uploads/icon/shipping-icon.png') }}" alt="">
                            FREE SHIPPING ON ORDER OVER $99
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <p>
                            <img src="{{ asset('uploads/icon/comment-icon.png') }}" alt="">
                            FREE SHIPPING ON ORDER OVER $99
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <p>
                            <img src="{{ asset('uploads/icon/star-icon.png') }}" alt="">
                            FREE SHIPPING ON ORDER OVER $99
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <p>
                            <img src="{{ asset('uploads/icon/money-icon.png') }}" alt="">
                            FREE SHIPPING ON ORDER OVER $99
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Shipping Section--}}

    {{--Slider Section--}}
    <section class="slider_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <!--categorie menu start-->
                    <div class="categories_menu">
                        <div class="categories_title active">
                            <h2 class="categori_toggle"><i class="fa fa-bars"></i> categories</h2>
                        </div>
                        <div class="categories_menu_inner" style="display: block;">
                            <ul>
                                @foreach($shop->business->productCategories()->orderBy('product_category_name','asc')->get() as $category)
                                    <li>
                                        <a href="{{ route('productcategory.show',$category->id) }}"><i
                                                    class="fa fa-angle-right"></i>
                                            {{ $category->product_category_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--categorie menu end-->
                </div>
                <div class="col-lg-6 col-md-8">
                    <!--slider area start-->
                    <div class="card page-carousel">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item">
                                    <img class="d-block img-fluid" src="#" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p>Somewhere</p>
                                    </div>
                                </div>
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid" src="#" alt="Second slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p>Somewhere else</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid" src="#" alt="Third slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p>Here it is</p>
                                    </div>
                                </div>
                            </div>

                            <a class="left carousel-control carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="fa fa-angle-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <!--slider area end-->
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="best_seller_product">
                        <div class="best_seller_titile">
                            <h3>BEST SELLER</h3>
                        </div>
                        <div class="bestseller_slider bestseller_column3 slick-initialized slick-slider slick-vertical">
                            <div class="slick-list draggable" style="height: 621px; padding: 0px;">
                                <div class="slick-track">
                                    <div class="single_bestseller slick-slide slick-current slick-active slick-center"
                                         data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 238px;">
                                        <div class="bestseller_thumb">
                                            <a href="#" tabindex="0">
                                                <img class="primary_img"
                                                     src="{{ asset('uploads/product/product1.jpg') }}" alt="">
                                                <img class="secondary_img"
                                                     src="{{ asset('uploads/product/product2.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div>
                                        <div class="bestseller_content">
                                            <h3><a href="#" tabindex="0">aliquam lobortis</a></h3>
                                            <div class="product_ratting">
                                                <ul>
                                                    <li><a href="##" tabindex="0"><i
                                                                    class="fa fa-star"></i></a></li>
                                                    <li><a href="##" tabindex="0"><i
                                                                    class="fa fa-star"></i></a></li>
                                                    <li><a href="##" tabindex="0"><i
                                                                    class="fa fa-star"></i></a></li>
                                                    <li><a href="##" tabindex="0"><i
                                                                    class="fa fa-star"></i></a></li>
                                                    <li><a href="##" tabindex="0"><i
                                                                    class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product_price">
                                                <span>£80.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--End Slider Section--}}

    {{--Deal Section--}}
    <section class="deals_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="newsletter_follow">
                        <div class="newsletter_area">
                            <div class="newsletter_title">
                                <h3>Newsletter Signup</h3>
                            </div>
                            <div class="newsletter_desc">
                                <p>Subscribe to our newsletter and join our 36 subscribers.</p>
                                <form action="#">
                                    <input placeholder="Enter your email..." type="text">
                                    <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>

                                </form>
                            </div>
                        </div>
                        <div class="follow_us">
                            <h3>FOLLOW US</h3>
                            <ul>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8">
                    <div class="deals_product">
                        <div class="deals_product_title">
                            <h3>DEALS OF THE DAY</h3>
                        </div>
                        <div class="deals_product_active owl-carousel owl-loaded owl-drag">


                            <div class="owl-stage-outer">
                                <div class="single_deals_product">
                                    <div class="deals_product_content">
                                        <h3><a href="#">Elementum felis</a></h3>
                                        <div class="product_ratting">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="deals_product_price">
                                            <span class="current_price">£120.00</span>
                                            <span class="old_price">£125.00</span>
                                        </div>
                                        <div class="deals_product_action">
                                            <div class="add_to_cart">
                                                <a href="#">add to cart</a>
                                            </div>
                                            <div class="add_to_links">
                                                <ul>
                                                    <li><a href="#" title="Add to Wishlist"><i
                                                                    class="fa fa-heart"></i></a></li>
                                                    <li><a href="#" title="Add to Compare"><i
                                                                    class="fa fa-retweet"></i></a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="deals_product_thumb">
                                        <a href="#"><img
                                                    src="{{ asset('uploads/product/product1.jpg') }}" alt=""></a>
                                        <div class="quick_view">
                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                               title="quick_view"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="banner_section">
                        <div class="single_banner">
                            <a href="#"><img src="{{ asset('uploads/bg/banner1.jpg') }}" alt=""></a>
                            <div class="banner_popup">
                                <a class="video_popup"
                                   href="https://www.youtube.com/watch?v=7OycwyrZ6Hc&amp;list=RDxyuLlnnfDcI&amp;index=9"><i
                                            class="fa fa-film"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--End Deal Section--}}

    {{--Banner Section--}}
    <div class="banner_section banner_column3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single_banner">
                        <a href="#"><img src="{{ asset('uploads/bg/banner1.jpg') }}" alt=""></a>
                        <div class="banner_popup">
                            <a class="video_popup"
                               href="https://www.youtube.com/watch?v=7OycwyrZ6Hc&amp;list=RDxyuLlnnfDcI&amp;index=9"><i
                                        class="fa fa-image"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_banner">
                        <a href="#"><img src="{{ asset('uploads/bg/banner1.jpg') }}" alt=""></a>
                        <div class="banner_popup">
                            <a class="video_popup"
                               href=""><i
                                        class="fa fa-link"></i></a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_banner banner_3">
                        <a href="#"><img src="{{ asset('uploads/bg/banner1.jpg') }}" alt=""></a>
                        <div class="banner_popup">
                            <a class="video_popup"
                               href=""><i
                                        class="fa fa-tags"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Banner Section--}}

    {{--Product Section--}}
    <section class="product_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h3>FEATURED PRODUCTS</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product_area product_column4 owl-carousel owl-loaded owl-drag">


                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            <div class="owl-item" style="width: 300px;">
                                <div class="col-lg-3">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a href="#"><img
                                                        src="{{ asset('uploads/product/product1.jpg') }}"
                                                        alt=""></a>
                                            <div class="product_hover">
                                                <div class="product_ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product_action">
                                                    <div class="action_button">
                                                        <ul>
                                                            <li><a class="add_links Wishlist" href="#"
                                                                   title="Add to Wishlist"><i
                                                                            class="fa fa-heart"></i></a></li>
                                                            <li><a class="add_to_cart" href="#">add to
                                                                    cart</a></li>
                                                            <li><a class="add_links Compare" href="#"
                                                                   title="Add to Compare"><i class="fa fa-retweet"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="quick_button">
                                                        <a href="#" data-toggle="modal"
                                                           data-target="#modal_box" title="quick_view"><i
                                                                    class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <h3><a href="#">Aenean sagittis</a></h3>
                                            <span class="current_price">£510.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-dots disabled"></div>
                </div>
            </div>
        </div>
    </section>
    {{--End Product Section--}}


    {{--Banner Section--}}
    <div class="banner_section banner_column1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single_banner">
                        <a href="#"><img src="{{ asset('uploads/bg/banner1.jpg') }}" alt=""></a>
                        <div class="banner_popup">
                            <a class="video_popup"
                               href=""><i
                                        class="fa fa-tags"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Banner Section--}}

@endsection
