@extends('layouts.template')
@section('title','Products')
@section('body_content')

    <div class="shop_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Shop All Products</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('shop.show',session('shop')->id) }}">home</a></li>
                            <li>/</li>
                            <li>All Products</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <!--shop wrapper start-->
                    <!--shop toolbar start-->
                    <div class="shop_toolbar">

                    </div>
                    <!--shop toolbar end-->

                    <!--shop tab product start-->
                    <div class="tab-content">
                        @foreach($products as $product)
                            <div class="tab-pane list_view fade show active" id="list" role="tabpanel">
                                <div class="product_list_item">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="product_thumb">
                                                <a href="{{ route('productdetails.show',$product->id) }}">
                                                    <img class="primary_img"
                                                         src="{{ asset('uploads/products/'.$product->product_image) }}"
                                                         alt="{{ $product->product_name }}"
                                                         title="{{ $product->product_name }}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8">
                                            <div class="product_content">
                                                <div class="product_name">
                                                    <h2><a href="{{ route('productdetails.show',$product->id) }}">
                                                            {{ $product->product_name }}
                                                        </a>
                                                    </h2>
                                                </div>
                                                <div class="product_price">
                                                    <span class="current_price">Rs.{{ $product->product_purchased_price }}</span>
                                                </div>
                                                <div class="product_desc">
                                                    <p>
                                                        {{ $product->description }}
                                                    </p>
                                                </div>

                                                <div class="product_action">
                                                    <ul>
                                                        <li>
                                                            {{ Form::open(['action' => 'CartController@store']) }}
                                                            {{ Form::hidden('product_id',$product->id) }}
                                                            <button type="submit"
                                                                    class="button btn btn-sm btn-neutral" title="Add to Cart">
                                                                Add to Cart
                                                            </button>
                                                            {{ Form::close() }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><hr>
                        @endforeach
                    </div><br>
                    <!--shop tab product end-->
                    <!--shop toolbar start-->
                    <div class="shop_toolbar t_bottom">
                        <div class="pagination">
                            {{ $products->links() }}
                        </div>
                    </div>
                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
                <div class="col-lg-3 col-md-12">
                    <!--sidebar widget start-->
                    <div class="sidebar_widget">
                        <div class="widget_list widget_categories">
                            <h2>Product categories</h2>
                            <ul>
                                @foreach(session('shop')->business->productCategories()->orderBy('product_category_name','asc')->get() as $category)
                                    <li><a href="{{ route('productcategory.show',$category->id) }}">
                                            {{ $category->product_category_name }}
                                        </a>
                                        <span>({{ $category->products()->count() }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--sidebar widget end-->
                </div>
            </div>
        </div>
    </div>

    {{--Banner Section--}}
    <div class="banner_section banner_column1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single_banner">
                        <a href=""><img src="{{ asset('uploads/bg/banner1.jpg') }}" alt=""></a>
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