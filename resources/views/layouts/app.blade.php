<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="University of Malakand">
    <meta name="author" content="MalakandSoft">
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
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<!-- Main content -->
<div class="main-content">

    <div class="header bg-gradient-default pb-6">
    </div>
    <div class="container">
        @yield('body_content')
    </div>
</div>

<!-- Core -->
<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>