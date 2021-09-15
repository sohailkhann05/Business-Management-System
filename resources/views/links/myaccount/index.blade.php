@extends('layouts.template')
@section('title','My Account')
@section('body_content')

    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('shop.show',session('shop')->id) }}">home</a></li>
                            <li>/</li>
                            <li>my account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                            <ul role="tablist" class="nav flex-column dashboard-list">
                                <li><a href="#account" data-toggle="tab" class="nav-link active">Account</a></li>
                                <li><a href="#orders" data-toggle="tab" class="nav-link">Orders</a></li>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">
                            <div class="tab-pane fade show active" id="account">
                                <h3>Account</h3>
                                <p>Name: {{ Auth::guard('customer')->user()->name }}
                                <p>E-Mail: {{ Auth::guard('customer')->user()->email }}
                                <p>Phone: {{ Auth::guard('customer')->user()->phone }}
                                <p>City: {{ Auth::guard('customer')->user()->city }}
                                <p>Country: {{ Auth::guard('customer')->user()->country }}
                                <p>Region: {{ Auth::guard('customer')->user()->region }}
                                <p>Address: {{ Auth::guard('customer')->user()->address }}
                            </div>
                            <div class="tab-pane fade" id="orders">
                                <h3>Orders</h3>
                                <div class="table-responsive">
                                    <?php
                                    $i = 1;
                                    $orders = Auth::guard('customer')->user()->sellOrders()->orderBy('created_at', 'asc')->get();
                                    ?>
                                    @if($orders->count() > 0)
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Details</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                                    <td>
                                                        @if($order->status == 1)
                                                            <span class="success">Completed</span>
                                                        @else
                                                            <span class="success">Pending.</span>
                                                        @endif
                                                    </td>
                                                    <td>Rs. {{ $order->total_amount }}/-</td>
                                                    <td><a href="" class="view">view</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No record found.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="banner_section banner_column1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single_banner">
                        <a href="index-5.html#"><img src="{{ asset('uploads/bg/banner7.jpg') }}" alt=""></a>
                        <div class="banner_popup">
                            <a class="video_popup"
                               href="https://www.youtube.com/watch?v=7OycwyrZ6Hc&amp;list=RDxyuLlnnfDcI&amp;index=9"><i
                                        class="fa fa-image"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection