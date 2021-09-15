<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Home')</title>
    <!-- Fonts -->
    <!-- Favicon -->
    <link href="{{ asset('uploads/logo/logo.png') }}" rel="icon" type="image/png">
    <!-- All CSS Files -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Plugins css file -->
    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">
    <!-- Theme main style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{--Toaster--}}
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet"/>
    <!-- Button Css -->
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading-btn.css') }}" rel="stylesheet">

</head>
<body>

{{--Header Section--}}
<header class="header_area" id="top">
    <div class="header_inner">
        <!--header top css here-->
        <div class="header_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="header_top_menu text-right">
                            <ul>
                                @if(Auth::guard('customer')->user())
                                    <li><a href="{{ route('myaccount.index') }}">My Account</a></li>
                                    <li><a href="{{ route('wishlist.show',Auth::guard('customer')->id()) }}">My
                                            Wishlist</a></li>
                                    <li><a href="{{ route('cart.show',Auth::guard('customer')->id()) }}">Shopping
                                            Cart</a></li>
                                    <li>
                                        <a href="{{ route('checkout.show',Auth::guard('customer')->id()) }}">Checkout</a>
                                    </li>
                                @else
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header top css end-->

        <!--header middel css here-->
        <div class="header_middel">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3">
                        <div class="logo">
                            <a href=""><img src="" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="header_search">
                            <form action="">
                                <div class="select_categorie">
                                    <span class="categorie_toggle">All Categories <i
                                                class="fa fa-caret-down"></i></span>

                                    <div class="dropdown_categorie">
                                        <ul>
                                            <li><a href="">All Categories</a></li>
                                            <li><a href="">Accessories</a></li>
                                            <li><a href="">Bags</a></li>
                                            <li><a href="">Clothings</a></li>
                                            <li><a href="">_Women</a></li>
                                            <li><a href="">_Men</a></li>
                                            <li><a href="">_Teen</a></li>
                                            <li><a href="">_Kids</a></li>
                                            <li><a href="">Shoes</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <input placeholder="Search product..." type="text">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                    </div>
                </div>
            </div>
        </div>
        <!--header middel css here-->
    </div>

    <!--header bottom css here-->
    <div class="header_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9 col-md-12">
                    <div class="bottom_left">
                        <div class="home_icone">
                            <a href="{{ route('shop.show',session('shop')->id) }}"><i class="fa fa-home"></i></a>
                        </div>
                        <div class="menu_inner">
                            <div class="main_menu d-none d-lg-block">
                                <ul>
                                    <li><a style="color:#fff;">Categories <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu">
                                            @foreach(session('shop')->business->productCategories()->orderBy('product_category_name','asc')->get() as $category)
                                                <li><a href="{{ route('productcategory.show',$category->id) }}">
                                                        {{ $category->product_category_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('products.show',session('shop')->id) }}">Products</a></li>
                                    <li><a href="{{ route('about.show',session('shop')->id) }}">About</a></li>
                                    <li><a href="{{ route('contactus.show',session('shop')->id) }}">Contact Us</a></li>
                                    @if(Auth::guard('customer')->user())
                                        <li><a href="{{ route('myaccount.index') }}">Account</a></li>
                                        <li>
                                            <a class="nav-link" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="ni ni-user-run text-default"></i> Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    @elseif(Auth::guard('branch-admin')->user())
                                        <li><a href="{{ route('br-profile.show',Auth::guard('branch-admin')->id()) }}">Profile</a>
                                        </li>
                                    @else
                                        <li><a href="{{ route('customer.login') }}">Login</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="mobile-menu mobail_menu_inner d-lg-none mean-container">
                                <div class="mean-bar"><a href="#nav" class="meanmenu-reveal"
                                                         style="text-align: center; text-indent: 0px; font-size: 18px;"><span></span><span></span><span></span></a>
                                    <nav class="mean-nav">
                                        <ul style="display: none;">
                                            <li><a href="{{ route('products.show',session('shop')->id) }}">Products</a>
                                            </li>
                                            <li><a href="{{ route('about.show',session('shop')->id) }}">About</a></li>
                                            <li><a href="{{ route('contactus.show',session('shop')->id) }}">Contact
                                                    Us</a></li>
                                            @if(Auth::guard('customer')->user())
                                                <li><a href="{{ route('myaccount.index') }}">Account</a></li>
                                                <li>
                                                    <a class="nav-link" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        <i class="ni ni-user-run text-default"></i> Logout
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          style="display: none;">
                                                        @csrf
                                                    </form>
                                                </li>
                                            @else
                                                <li><a href="{{ route('customer.login') }}">Login</a></li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                                <div class="mean-push"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="contact_link text-right">
                        <ul>
                            <li><i class="fa  fa-phone"></i><strong>Phone:</strong> 0987. 654. 321</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header bottom css here-->
</header>
{{--End Header Section--}}

@yield('body_content')

{{--Footer Section--}}
<footer class="footer_widgets_area">
    <div class="container">
        <div class="footer_top">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widgets_container">
                        <div class="footer_title">
                            <h3>Contact Us</h3>
                        </div>
                        <div class="footer_contact">
                            <p>
                                <i class="fa fa-map-marker"></i>
                                <span>Addresss: 123 Pall Mall, London England</span>
                            </p>
                            <p>
                                <i class="fa fa-envelope"></i>
                                <span>Email: info@roadthemes.com</span>
                            </p>
                            <p>
                                <i class="fa fa-phone"></i>
                                <span>Phone: (012) 345 6789</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="widgets_container">
                        <div class="footer_title">
                            <h3>Our services</h3>
                        </div>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="">Shipping &amp; Returns</a></li>
                                <li><a href="">Secure Shopping</a></li>
                                <li><a href="">International Shipping</a></li>
                                <li><a href="">Affiliates</a></li>
                                <li><a href="">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="widgets_container">
                        <div class="footer_title">
                            <h3>My Account</h3>
                        </div>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="cart.html">Shopping Cart</a></li>
                                <li><a href="">Wishlist</a></li>
                                <li><a href="">Custom Link</a></li>
                                <li><a href="">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="widgets_container">
                        <div class="footer_title">
                            <h3>Information</h3>
                        </div>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="">Our Blog</a></li>
                                <li><a href="">About Our Shop</a></li>
                                <li><a href="">Secure Shopping</a></li>
                                <li><a href="">Privacy Policy</a></li>
                                <li><a href="">Delivery infomation</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="widgets_container">
                        <div class="footer_title">
                            <h3>Business hours</h3>
                        </div>
                        <div class="footer_menu">
                            <ul>
                                <li>Mon - Fri: --8am - 5pm</li>
                                <li>Sat: -----8am - 11am</li>
                                <li>Sun: -----Closed</li>
                                <li>Sun: -----Closed</li>
                                <li>We work all holidays</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="row">
                <div class="col-12">
                    <div class="payment_icons">
                        <ul>
                            <li><img src="{{ asset('uploads/icon/payment1.png') }}" alt=""></li>
                            <li><img src="{{ asset('uploads/icon/payment2.png') }}" alt=""></li>
                            <li><img src="{{ asset('uploads/icon/payment3.png') }}" alt=""></li>
                            <li><img src="{{ asset('uploads/icon/payment4.png') }}" alt=""></li>
                        </ul>
                    </div>
                    <div class="copyright_info">
                        <p>Copyright © 2018 <a href="">M4U</a> All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
{{--End Footer Section--}}

<!-- jQuery latest version -->
<script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
<!-- Modernizr JS -->
<script src="{{ asset('js/modernizr-2.8.3.min.js') }}"></script>

<script src="{{ asset('js/popper.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Plugins js -->
<script src="{{ asset('js/plugins.js') }}"></script>

<script src="{{ asset('js/ajax-mail.js') }}"></script>
<!-- Main js -->
<script src="{{ asset('js/main.js') }}"></script>
<a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: inline-block;"><i
            class="fa fa-angle-double-up"></i></a>
{{--Toaster--}}
<script src="{{ asset('js/toastr.js') }}"></script>
<!-- CSS Loading Script -->
<script>

    function loadingCss() {
        document.getElementById('adding-form').innerHTML = '<button class="btn btn-sm btn-disabled ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
        return true;
    }

</script>
@yield('script_content')

</body>
</html>
