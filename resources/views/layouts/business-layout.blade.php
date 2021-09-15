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
    <link type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
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
                    <i class="ni ni-single-02"></i> {{ Auth::guard('business-admin')->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a class="dropdown-item"
                       href="{{ route('business-profile.show',Auth::guard('business-admin')->user()->id) }}"
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
                            Logo
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
                    <a class="nav-link" href="{{ route('businessadmin.dashboard') }}" title="Dashboard">
                        <i class="ni ni-bullet-list-67 text-default"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('business-branch.index') }}" title="Branch">
                        <i class="ni ni-box-2 text-default"></i> Branch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('business-branchadmin.index') }}" title="Branch Admin">
                        <i class="ni ni-archive-2 text-default"></i>
                        Branch Admin &nbsp;
                        {{--<span class="badge badge-pill badge-danger text-uppercase">3</span>--}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('business-bank.index') }}" title="Bank">
                        <i class="ni ni-building text-default"></i> Bank</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('business-usercategory.index') }}" title="User Category">
                        <i class="ni ni-single-02 text-default"></i> User Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('business-employee.index') }}" title="Employee">
                        <i class="ni ni-satisfied text-default"></i> Employee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('business-productcategory.index') }}" title="Product Category">
                        <i class="ni ni-atom text-default"></i> Product Category</a>
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
                        <i class="ni ni-single-02"></i> {{ Auth::guard('business-admin')->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <a class="dropdown-item"
                           href="{{ route('business-profile.show',Auth::guard('business-admin')->user()->id) }}"
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
@yield('script_content')
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
