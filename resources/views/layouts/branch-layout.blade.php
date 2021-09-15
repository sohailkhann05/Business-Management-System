<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Business Management System">
    <meta name="author" content="Adnan Khalil & Sohail Khan">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link href="{{ asset('uploads/logo/logo.png') }}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('assets/css/argon.css?v=1.0.1') }}" rel="stylesheet">
    {{--Toaster--}}
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet"/>
    <style>
        .spinner {
            margin: 100px auto 0;
            width: 70px;
            text-align: center;
        }

        .spinner > div {
            width: 18px;
            height: 18px;
            background-color: #333;

            border-radius: 100%;
            display: inline-block;
            -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        }

        .spinner .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .spinner .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }

        @-webkit-keyframes sk-bouncedelay {
            0%, 80%, 100% {
                -webkit-transform: scale(0)
            }
            40% {
                -webkit-transform: scale(1.0)
            }
        }

        @keyframes sk-bouncedelay {
            0%, 80%, 100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }
            40% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
            }
        }

    </style>
    <!-- Button Css -->
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading-btn.css') }}" rel="stylesheet">
</head>

<body>

<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="ni ni-single-02"></i> {{ Auth::guard('branch-admin')->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a class="dropdown-item"
                       href="{{ route('br-profile.show',Auth::guard('branch-admin')->user()->id) }}"
                       title="Profile">
                        <i class="ni ni-circle-08 text-default"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run text-default"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="">
                            Business Management System
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('branchadmin.dashboard') }}" title="Dashboard">
                        <i class="ni ni-bullet-list-67 text-default"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('br-cash.index') }}" title="Cash">
                        <i class="ni ni-credit-card text-default"></i> Cash</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('br-productsetup.create') }}" title="Product Setup">
                        <i class="ni ni-basket text-default"></i> Product Setup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active collapsed" href="#customer-tab" data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="customer-tab">
                        <i class="ni ni-satisfied" style="color: #525f7f;"></i>
                        <span class="nav-link-text" style="color: #525f7f;">Customers</span>
                    </a>
                    <div class="collapse" id="customer-tab">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-customer.index') }}" title="All List">All List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-supplier.create') }}" title="Add Supplier">Add Supplier</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-customer.create') }}" title="Add Customer">Add Customer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-onlinecustomer.index') }}"
                                   title="Online Customer">Online Customer</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active collapsed" href="#purchased-tab" data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="purchased-tab">
                        <i class="ni ni-delivery-fast" style="color: #525f7f;"></i>
                        <span class="nav-link-text" style="color: #525f7f;">Purchased Invoice</span>
                    </a>
                    <div class="collapse" id="purchased-tab">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-purchasedorder.create') }}"
                                   title="Purchased Order">Purchased Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-purchasedorderreturn.create') }}"
                                   title="Purchased Return">Purchased Return</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active collapsed" href="#sell-tab" data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sell-tab">
                        <i class="ni ni-delivery-fast" style="color: #525f7f;"></i>
                        <span class="nav-link-text" style="color: #525f7f;">Sell Invoice</span>
                    </a>
                    <div class="collapse" id="sell-tab">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-createorder.create') }}"
                                   title="Create Order">Create Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-sellorderdetail.index') }}"
                                   title="Sell Order">Sell Reports</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-sellorderreturn.create') }}"
                                   title="Sell Order Return">Sell Order Return</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active collapsed" href="#claims-tab" data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="claims-tab">
                        <i class="ni ni-archive-2" style="color: #525f7f;"></i>
                        <span class="nav-link-text" style="color: #525f7f;">Claims</span>
                    </a>
                    <div class="collapse" id="claims-tab">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-customerclaim.index') }}"
                                   title="Sell Order">Customer Claims</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-supplierclaim.index') }}"
                                   title="Create Order">Supplier Claims</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active collapsed" href="#receipt-tab" data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="receipt-tab">
                        <i class="ni ni-archive-2" style="color: #525f7f;"></i>
                        <span class="nav-link-text" style="color: #525f7f;">Receipt</span>
                    </a>
                    <div class="collapse" id="receipt-tab">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-customerreceipt.index') }}"
                                   title="Sell Order">Customer Receipt</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('br-supplierreceipt.index') }}"
                                   title="Create Order">Supplier Receipt</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active collapsed" href="#reports-tab" data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="reports-tab">
                        <i class="ni ni-paper-diploma" style="color: #525f7f;"></i>
                        <span class="nav-link-text" style="color: #525f7f;">Reports</span>
                    </a>
                    <div class="collapse" id="reports-tab">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link active collapsed" href="#customer_reports" data-toggle="collapse"
                                   role="button"
                                   aria-expanded="false" aria-controls="customer_reports">
                                    <span class="nav-link-text" style="color: #525f7f;">Customer</span>
                                </a>
                                <div class="collapse" id="customer_reports">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('customerbalance') }}"
                                               title="Customer Balances">Customer Balances</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('sellclaim') }}"
                                               title="Customer Claim">Customer
                                                Claim</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('customerledger') }}"
                                               title="Customer Ledger">Customer Ledger</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('br-sellorderdetail.index') }}"
                                               title="Sell Reports">Sell Invoice</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('sellregister') }}"
                                               title="Sell Registration">Sell Register</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active collapsed" href="#supplier_reports" data-toggle="collapse"
                                   role="button"
                                   aria-expanded="false" aria-controls="supplier_reports">
                                    <span class="nav-link-text" style="color: #525f7f;">Supplier</span>
                                </a>
                                <div class="collapse" id="supplier_reports">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('supplierbalance') }}"
                                               title="Supplier Balance">Supplier Balance</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('purchaseclaim') }}"
                                               title="Supplier Claim">Supplier Claim</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('supplierledger') }}"
                                               title="Supplier Ledger">Supplier Ledger</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('br-purchasedorder.index') }}"
                                               title="Purchased Reports">Purchase Invoice</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('purchaseregister') }}"
                                               title="Purchase Register">Purchase Register</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active collapsed" href="#shop_reports" data-toggle="collapse"
                                   role="button"
                                   aria-expanded="false" aria-controls="shop_reports">
                                    <span class="nav-link-text" style="color: #525f7f;">Shop</span>
                                </a>
                                <div class="collapse" id="shop_reports">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link text-info"
                                               href="{{ route('br-supplierbonusdetail.index') }}"
                                               title="Bonus Reports">Bonus Reports</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('grossprofileloss') }}"
                                               title="Gross Profit & Loss">Gross Profit &
                                                Loss</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('openingstock') }}"
                                               title="Opening Stock">Opening
                                                Stock</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('productwisestock') }}"
                                               title="Product Wise Stock">Product Wise Stock</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-info" href="{{ route('trailbalance') }}"
                                               title="Trail Balance">Trail
                                                Balance</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('br-customerorder.index') }}" title="Customer Order">
                        <i class="ni ni-money-coins text-default"></i>
                        Online Order &nbsp;&nbsp;
                        <span class="badge badge-pill badge-danger text-uppercase">
                            <i class="ni ni-bell-55"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href=""></a>
            <!-- Form -->
            <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                <div class="form-group mb-0">
                </div>
            </form>
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="ni ni-single-02"></i> {{ Auth::guard('branch-admin')->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <a class="dropdown-item"
                           href="{{ route('br-profile.show',Auth::guard('branch-admin')->user()->id) }}"
                           title="Profile">
                            <i class="ni ni-circle-08 text-default"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run text-default"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="header bg-gradient-default pb-6">
    </div>
    <div class="container">
        <br>
        @yield('body_content')
    </div>
</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<!-- Core -->
<script src="{{ asset('assets/vendor/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/headroom/headroom.min.js') }}"></script>
<!-- Optional JS -->
<script src="{{ asset('assets/vendor/onscreen/onscreen.min.js') }}"></script>
<script src="{{ asset('assets/vendor/nouislider/js/nouislider.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
<script src="{{ asset('assets/js/argon.js?v=1.0.1') }}"></script>
<script src="{{ asset('js/toastr.js') }}"></script>
<script>

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

</script>
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
