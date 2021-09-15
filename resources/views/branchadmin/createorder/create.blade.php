@extends('layouts.branch-layout')
@section('title','Create Sell Order')
@section('body_content')

    @if(session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text"><strong>Success!</strong> {{ session('info') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    @if($errors->any())
        <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-white">
                <h3>Alert</h3>
            </div>
            <div class="card-body ">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div><br>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Search Customer
                        <a style="float: right;" href="{{ route('br-customer.index') }}"
                           class="btn btn-sm btn-white">
                            All Customers
                        </a>
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Select Category') }}
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        @if($category->user_category_name == 'Supplier')
                                            @continue
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->user_category_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input class="form-control" placeholder="Customer Name" type="text" id="search_text">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="button" id="search_btn" class="btn btn-default"
                                        onclick="searchCustomer()">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div id="search_result"></div>

@endsection
@section('script_content')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function searchCustomer() {
            var category_id = $('#category_id').val();
            var search_data = $('#search_text').val();
            if (search_data == '' || search_data == null) {
                document.getElementById('search_text').style.border = "1px solid #d71313";
                document.getElementById('category_id').style.border = "1px solid #d71313";
            } else {
                document.getElementById('search_result').innerHTML = '<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
                document.getElementById('search_text').style.border = "1px solid #cad1d7";
                document.getElementById('category_id').style.border = "1px solid #cad1d7";
                var data = "category_id=" + category_id + "&name=" + search_data;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/branchsearchcustomer') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_result').innerHTML = data;
                    }
                });
            }
        }

    </script>

@endsection