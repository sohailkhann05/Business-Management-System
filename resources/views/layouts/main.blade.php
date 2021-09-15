<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Home')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
{{--Style--}}
<!-- Favicon -->
    <link href="{{ asset('uploads/logo/logo.png') }}" rel="icon" type="image/png">
    <!-- All CSS Files -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ asset('main/bootstrap.min.css') }}">
    <!-- Icon Font -->
    <link rel="stylesheet" href="{{ asset('main/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/et-line.css') }}">
    <!-- Plugins css file -->
    <link rel="stylesheet" href="{{ asset('main/plugins.css') }}">
    <!-- Theme main style -->
    <link rel="stylesheet" href="{{ asset('main/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('main/responsive.css') }}">
    <!-- Modernizr JS -->
    <script src="{{ asset('main/modernizr-2.8.3.min.js') }}"></script>
    <!-- Button Css -->
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading-btn.css') }}" rel="stylesheet">

</head>
<body>

{{--Header Section--}}
<div class="header-section section sticker stick">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- Logo -->
                <div class="logo float-left">
                    {{-- <a class="non-sticky" href="">BMS<img src="#" alt="logo-image"></a> --}}
                    <h3>B M S</h3>
                </div>
                <!-- Logo -->
                <div class="float-right">
                </div>
            </div>
        </div>
    </div>
</div>
{{--End Header Section--}}

@yield('body_content')

<!-- jQuery latest version -->
<script src="{{ asset('main/jquery-3.1.1.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('main/bootstrap.min.js') }}"></script>
<!-- Plugins js -->
<script src="{{ asset('main/plugins.js') }}"></script>
<!-- Main js -->
<script src="{{ asset('main/main.js') }}"></script>
<!-- CSS Loading Script -->
<script>

    function loadingCss() {
        document.getElementById('adding-form').innerHTML = '<button class="btn btn-sm btn-disabled ld-ext-right running" disabled>Please wait <div class="ld ld-ring ld-spin"></div></button>';
        return true;
    }

</script>
</body>
</html>
