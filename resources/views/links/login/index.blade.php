@extends('layouts.template')
@section('title','Login')
@section('body_content')

    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('shop.show',session('shop')->id) }}">home</a></li>
                            <li>/</li>
                            <li>login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="customer_login">
        <div class="container">
            <div class="row">
                <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form">
                        <h2>login</h2>
                        <form action="{{ route('customer.login') }}" method="post">
                            {{ csrf_field() }}
                            <p>
                                <label>Email <span>*</span></label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <p>
                                <label>Passwords <span>*</span></label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <div class="login_submit">
                                <a href="">Lost your password?</a>
                                <label for="remember">
                                    <input id="remember" type="checkbox">
                                    Remember me
                                </label>
                                <button type="submit">login</button>

                            </div>

                        </form>
                    </div>
                </div>
                <!--login area start-->

                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        @if($errors->any())
                            <div class="card shadow border-0">
                                <div class="card-header bg-white">
                                    <h3>Errors</h3>
                                </div>
                                <div class="card-body">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            </div><br>
                        @endif
                        <h2>Register</h2>
                        <form action="{{ route('customer.register') }}" method="post">
                            {{ csrf_field() }}
                            <p>
                                <label>Name <span>*</span></label>
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name"
                                       value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <p>
                                <label>Email address <span>*</span></label>
                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email"
                                       value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <p>
                                <label>Password <span>*</span></label>
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <p>
                                <label>Confirm Password <span>*</span></label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required>
                            </p>
                            <p>
                                <label>Phone <span>* no space/dash</span></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
                            </p>
                            <p>
                                <label>Address <span>*</span></label>
                                <input type="text" name="address" id="address" value="{{ old('address') }}">
                            </p>
                            <p>
                                <label>City <span>*</span></label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}">
                            </p>
                            <p>
                                <label>Country <span>*</span></label>
                                <input type="text" name="country" id="country" value="{{ old('country') }}">
                            </p>
                            <p>
                                <label>Region <span>*</span></label>
                                <input type="text" name="region" id="region" value="{{ old('region') }}">
                            </p>
                            <div class="login_submit">
                                <button type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div>

@endsection