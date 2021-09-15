@extends('layouts.main')
@section('body_content')

    <div class="hero-section section overlay" style="background-image: url('{{ asset('uploads/img/header_bg.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="hero-content text-center col-xs-12">
                    <h1><strong>MalakandSoft </strong> Web & IT Solutions</h1>
                    <hr>
                    <a href="{{ route('businessadmin.login') }}" class="btn btn-sm btn-default">Business Login</a>
                    <a href="{{ route('branchadmin.login') }}" class="btn btn-sm btn-default">Branch Login</a>
                </div>
            </div>
        </div>
    </div>

@if($branches->count() > 0)
    <div class="demo-section section pt-120 pb-70">
        <div class="container">
            <div class="row">
                <div class="section-style">
                    <div class="section-title col-xs-12 mb-70">
                        <h1>Shops</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($branches as $branch)
                    <div class="col-md-4 col-sm-6 col-12 mb-50">
                        <div class="demo-item">
                            <a href="{{ route('shop.show',$branch->id) }}" class="image"><img src="{{ asset('uploads/img/home-1.png') }}">
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                            <h4 class="title">
                                <a href="{{ route('shop.show',$branch->id) }}">{{ $branch->branch_title }}</a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

    <div class="feature-section section bg-gray pt-120 pb-70">
        <div class="container">
            <div class="row">
                <div class="section-style">
                    <div class="section-title col-xs-12 mb-70">
                        <h1>Malakand<b>Soft</b> Services</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="single-feature col-lg-4 col-md-6 col-sm-6 mb-50">
                <span class="icon float-left">
                        <i class="fa fa-html5"></i>
                    </span>
                    <div class="content fix">
                        <h4>Web Development</h4>
                        <p>
                            Web app development is the creation of application programs that reside on remote servers and are delivered to the user's device over the Internet. Web apps are sometimes contrasted with native apps, which are applications that are developed specifically for a particular platform or device and installed on that device.
                        </p>
                    </div>
                </div>
                <div class="single-feature col-lg-4 col-md-6 col-sm-6 mb-50">
                <span class="icon float-left">
                        <i class="fa fa-android"></i>
                    </span>
                    <div class="content fix">
                        <h4>Android Development</h4>
                        <p>
                            Android software development is the process by which new applications are created for devices running the Android operating system. Google states that, "Android apps can be written using Kotlin, Java, and C++ languages" using the Android software development kit, while using other languages is also possible.
                        </p>
                    </div>
                </div>
                <div class="single-feature col-lg-4 col-md-6 col-sm-6 mb-50">
                <span class="icon float-left">
                        <i class="fa fa-windows"></i>
                    </span>
                    <div class="content fix">
                        <h4>Desktop Development</h4>
                        <p>
                            Desktop application runs stand alone in a desktop or laptop computer. Contrasting with Web-based application, which requires the Web browser to run. ... Developing Desktop applications which can be locally installed on the computer using software such as Click Once or Windows Installer (MSI) and run on the Windows Desktop.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-section section pt-65 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-center">Copyright © 2019 Malakand<b>Soft</b>. All rights reserved.</h3>
                </div>
            </div>
        </div>
    </div>

@endsection