@extends('layouts.template')
@section('title','Wishlist')
@section('body_content')

    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('shop.show',session('shop')->id) }}">home</a></li>
                            <li>/</li>
                            <li>wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wishlist_area">
        <div class="container">
            <form action="wishlist.html#">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc wishlist">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product_remove">Delete</th>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product_quantity">Stock Status</th>
                                        <th class="product_total">Add To Cart</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="product_remove"><a href="wishlist.html#">X</a></td>
                                        <td class="product_thumb"><a href="wishlist.html#"><img src="{{ asset('uploads/product/product1.jpg') }}" alt=""></a></td>
                                        <td class="product_name"><a href="wishlist.html#">Handbag fringilla</a></td>
                                        <td class="product-price">£65.00</td>
                                        <td class="product_quantity">In Stock</td>
                                        <td class="product_total"><a href="wishlist.html#">Add To Cart</a></td>


                                    </tr>

                                    <tr>
                                        <td class="product_remove"><a href="wishlist.html#">X</a></td>
                                        <td class="product_thumb"><a href="wishlist.html#"><img src="{{ asset('uploads/product/product2.jpg') }}" alt=""></a></td>
                                        <td class="product_name"><a href="wishlist.html#">Handbags justo</a></td>
                                        <td class="product-price">£90.00</td>
                                        <td class="product_quantity">In Stock</td>
                                        <td class="product_total"><a href="wishlist.html#">Add To Cart</a></td>


                                    </tr>
                                    <tr>
                                        <td class="product_remove"><a href="wishlist.html#">X</a></td>
                                        <td class="product_thumb"><a href="wishlist.html#"><img src="{{ asset('uploads/product/product9.jpg') }}" alt=""></a></td>
                                        <td class="product_name"><a href="wishlist.html#">Handbag elit</a></td>
                                        <td class="product-price">£80.00</td>
                                        <td class="product_quantity">In Stock</td>
                                        <td class="product_total"><a href="wishlist.html#">Add To Cart</a></td>


                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </form>
            <div class="row">
                <div class="col-12">
                    <div class="wishlist_share">
                        <h4>Share on:</h4>
                        <ul>
                            <li><a href="wishlist.html#"><i class="fa fa-rss"></i></a></li>
                            <li><a href="wishlist.html#"><i class="fa fa-vimeo"></i></a></li>
                            <li><a href="wishlist.html#"><i class="fa fa-tumblr"></i></a></li>
                            <li><a href="wishlist.html#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="wishlist.html#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="banner_section banner_column1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single_banner">
                        <a href="index-5.html#"><img src="{{ asset('uploads/bg/banner7.jpg') }}" alt=""></a>
                        <div class="banner_popup">
                            <a class="video_popup" href="https://www.youtube.com/watch?v=7OycwyrZ6Hc&amp;list=RDxyuLlnnfDcI&amp;index=9"><i class="fa fa-image"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection