@extends('layouts.template')
@section('title',$product->product_name)
@section('body_content')

    {{--Breadcrumb--}}
    <div class="breadcrumbs_area product_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('shop.show',session('shop')->id) }}">home</a></li>
                            <li>/</li>
                            <li>{{ $product->product_name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Breadcrumb--}}

    {{--Product details--}}
    <div class="product_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            <img id="zoom1" src="{{ asset('uploads/products/'.$product->product_image) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-7">
                    <div class="product_d_right">
                        <h1>{{ $product->product_name }}</h1>
                        <div class="product_price">
                            <span class="current_price">
                                Rs.{{ $product->product_purchased_price }}
                            </span>
                        </div>
                        <div class="product_desc">
                            <p>{{ $product->description }}</p>
                        </div>

                        <div class="box_quantity">
                            {{ Form::open(['action' => 'CartController@store']) }}
                            {{ Form::hidden('product_id',$product->id) }}
                            <button type="submit"
                                    class="button btn btn-sm btn-neutral" title="Add to Cart">
                                Add to Cart
                            </button>
                            {{ Form::close() }}
                        </div>
                        <div class="product_d_action">
                            <ul>
                                <li><a href="" title="Add to wishlist"><i class="fa fa-heart-o"
                                                                                               aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="priduct_social">
                            <h3>Share on:</h3>
                            <ul>
                                <li><a href=""><i class="fa fa-rss"></i></a></li>
                                <li><a href=""><i class="fa fa-vimeo"></i></a></li>
                                <li><a href=""><i class="fa fa-tumblr"></i></a></li>
                                <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                                <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 offset-lg-0 col-md-6 offset-md-3">
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
                                            <a href="" tabindex="0">
                                                <img class="primary_img"
                                                     src="{{ asset('uploads/product/product4.jpg') }}" alt="">
                                                <img class="secondary_img"
                                                     src="{{ asset('uploads/product/product5.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div>
                                        <div class="bestseller_content">
                                            <h3><a href="" tabindex="0">aliquam lobortis</a></h3>
                                            <div class="product_ratting">
                                                <ul>
                                                    <li><a href="" tabindex="0"><i
                                                                    class="fa fa-star"></i></a></li>
                                                    <li><a href="" tabindex="0"><i
                                                                    class="fa fa-star"></i></a></li>
                                                    <li><a href="" tabindex="0"><i
                                                                    class="fa fa-star"></i></a></li>
                                                    <li><a href="" tabindex="0"><i
                                                                    class="fa fa-star"></i></a></li>
                                                    <li><a href="" tabindex="0"><i
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
    </div>
    {{--End Product details--}}

    {{--Product Info--}}
    <div class="product_d_info">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">
                        <div class="product_info_button">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#info" role="tab"
                                       aria-controls="info" aria-selected="false">More info</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#sheet" role="tab"
                                       aria-controls="sheet" aria-selected="false">Data sheet</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#reviews" role="tab"
                                       aria-controls="reviews" aria-selected="false">Reviews</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="product_info_content">
                                    <p>Fashion has been creating well-designed collections since 2010. The brand offers
                                        feminine designs delivering stylish separates and statement dresses which have
                                        since evolved into a full ready-to-wear collection in which every item is a
                                        vital part of a woman's wardrobe. The result? Cool, easy, chic looks with
                                        youthful elegance and unmistakable signature style. All the beautiful pieces are
                                        made in Italy and manufactured with the greatest attention. Now Fashion extends
                                        to a range of accessories including shoes, hats, belts and more!</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="sheet" role="tabpanel">
                                <div class="product_d_table">
                                    <form action="">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="first_child">Compositions</td>
                                                <td>Polyester</td>
                                            </tr>
                                            <tr>
                                                <td class="first_child">Styles</td>
                                                <td>Girly</td>
                                            </tr>
                                            <tr>
                                                <td class="first_child">Properties</td>
                                                <td>Short Dress</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="product_info_content">
                                    <p>Fashion has been creating well-designed collections since 2010. The brand offers
                                        feminine designs delivering stylish separates and statement dresses which have
                                        since evolved into a full ready-to-wear collection in which every item is a
                                        vital part of a woman's wardrobe. The result? Cool, easy, chic looks with
                                        youthful elegance and unmistakable signature style. All the beautiful pieces are
                                        made in Italy and manufactured with the greatest attention. Now Fashion extends
                                        to a range of accessories including shoes, hats, belts and more!</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="product_info_content">
                                    <p>ReviewFashion has been creating well-designed collections since 2010. The brand
                                        offers
                                        feminine designs delivering stylish separates and statement dresses which have
                                        since evolved into a full ready-to-wear collection in which every item is a
                                        vital part of a woman's wardrobe. The result? Cool, easy, chic looks with
                                        youthful elegance and unmistakable signature style. All the beautiful pieces are
                                        made in Italy and manufactured with the greatest attention. Now Fashion extends
                                        to a range of accessories including shoes, hats, belts and more!</p>
                                </div>
                                <div class="product_info_inner">
                                    <div class="product_ratting mb-10">
                                        <ul>
                                            <li><a href=""><i class="fa fa-star"></i></a></li>
                                            <li><a href=""><i class="fa fa-star"></i></a></li>
                                            <li><a href=""><i class="fa fa-star"></i></a></li>
                                            <li><a href=""><i class="fa fa-star"></i></a></li>
                                            <li><a href=""><i class="fa fa-star"></i></a></li>
                                        </ul>
                                        <strong>Posthemes</strong>
                                        <p>09/07/2018</p>
                                    </div>
                                    <div class="product_demo">
                                        <strong>demo</strong>
                                        <p>That's OK!</p>
                                    </div>
                                </div>
                                <div class="product_review_form">
                                    <form action="">
                                        <h2>Add a review </h2>
                                        <p>Your email address will not be published. Required fields are marked </p>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="review_comment">Your review </label>
                                                <textarea name="comment" id="review_comment"></textarea>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="author">Name</label>
                                                <input id="author" type="text">

                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="email">Email </label>
                                                <input id="email" type="text">
                                            </div>
                                        </div>
                                        <button type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Product Info--}}

    {{--Related--}}
    <section class="product_section related_product">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h3>Related Products</h3>
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
                                            <a href=""><img
                                                        src="{{ asset('uploads/product/product5.jpg') }}"
                                                        alt=""></a>
                                            <div class="product_hover">
                                                <div class="product_ratting">
                                                    <ul>
                                                        <li><a href=""><i
                                                                        class="fa fa-star"></i></a></li>
                                                        <li><a href=""><i
                                                                        class="fa fa-star"></i></a></li>
                                                        <li><a href=""><i
                                                                        class="fa fa-star"></i></a></li>
                                                        <li><a href=""><i
                                                                        class="fa fa-star"></i></a></li>
                                                        <li><a href=""><i
                                                                        class="fa fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product_action">
                                                    <div class="action_button">
                                                        <ul>
                                                            <li><a class="add_links Wishlist"
                                                                   href="" title="Add to Wishlist"><i
                                                                            class="fa fa-heart"></i></a></li>
                                                            <li><a class="add_to_cart" href="">add
                                                                    to cart</a></li>
                                                            <li><a class="add_links Compare"
                                                                   href=""
                                                                   title="Add to Compare"><i class="fa fa-retweet"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="quick_button">
                                                        <a href="" data-toggle="modal"
                                                           data-target="#modal_box" title="quick_view"><i
                                                                    class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <h3><a href="">Aenean sagittis</a></h3>
                                            <span class="current_price">£510.00</span>
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
    {{--End Related--}}

    {{--Upspell Product--}}
    <section class="product_categorie upsell_product">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h3>Upsell Products</h3>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="product_area product_column4 owl-carousel owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage">
                                    <div class="owl-item" style="width: 300px;">
                                        <div class="col-lg-3">
                                            <div class="single_product">
                                                <div class="product_thumb">
                                                    <a href=""><img
                                                                src="{{ asset('uploads/product/product6.jpg') }}"
                                                                alt=""></a>
                                                    <div class="product_hover">
                                                        <div class="product_ratting">
                                                            <ul>
                                                                <li><a href=""><i
                                                                                class="fa fa-star"></i></a></li>
                                                                <li><a href=""><i
                                                                                class="fa fa-star"></i></a></li>
                                                                <li><a href=""><i
                                                                                class="fa fa-star"></i></a></li>
                                                                <li><a href=""><i
                                                                                class="fa fa-star"></i></a></li>
                                                                <li><a href=""><i
                                                                                class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="product_action">
                                                            <div class="action_button">
                                                                <ul>
                                                                    <li><a class="add_links Wishlist"
                                                                           href=""
                                                                           title="Add to Wishlist"><i
                                                                                    class="fa fa-heart"></i></a></li>
                                                                    <li><a class="add_to_cart"
                                                                           href="">add to cart</a>
                                                                    </li>
                                                                    <li><a class="add_links Compare"
                                                                           href=""
                                                                           title="Add to Compare"><i
                                                                                    class="fa fa-retweet"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="quick_button">
                                                                <a href="" data-toggle="modal"
                                                                   data-target="#modal_box" title="quick_view"><i
                                                                            class="fa fa-eye"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product_content">
                                                    <h3><a href="">Aenean sagittis</a></h3>
                                                    <span class="current_price">£510.00</span>
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
        </div>
    </section>
    {{--End Upspell Product--}}

    {{--Brand Section--}}
    <section class="product_categorie upsell_product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section_title">
                        <h3>BRAND & CLIENTS</h3>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="product_area product_column3 owl-carousel owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <div class="owl-item" style="width: 300px;">
                                    <div class="brands_items">
                                        <div class="single_brand">
                                            <a href=""><img
                                                        src="{{ asset('uploads/brand/brand4.png') }}"
                                                        alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 300px;">
                                    <div class="brands_items">
                                        <div class="single_brand">
                                            <a href=""><img
                                                        src="{{ asset('uploads/brand/brand4.png') }}"
                                                        alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 300px;">
                                    <div class="brands_items">
                                        <div class="single_brand">
                                            <a href=""><img
                                                        src="{{ asset('uploads/brand/brand4.png') }}"
                                                        alt=""></a>
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
    {{--End Brand Section--}}


@endsection
@section('script_content')

    <script>

        @if (Session::has('success'))
        toastr.success('Product added to Cart!');
        @endif

        @if (Session::has('info'))
        toastr.info('Product already added to Cart!');
        @endif

    </script>

@endsection
