@extends('layouts.branch-layout')
@section('title','Sell Order Return')
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
            <div class="card-header bg-default">
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
                        Sell Order Return
                        <a style="float: right;" href="{{ route('br-sellorderreturn.index') }}"
                           class="btn btn-sm btn-white">
                            View All
                        </a>
                    </h3><hr>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Enter Invoice No" type="text"
                                           id="search_text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="search_btn" class="btn btn-default" onclick="searchInvoice()">Search</button>
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

        function searchInvoice() {
            var search_data = $('#search_text').val();
            if (search_data == '' || search_data == null) {
                document.getElementById('search_text').style.border = "1px solid #d71313";
            } else {
                document.getElementById('search_result').innerHTML = '<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
                document.getElementById('search_text').style.border = "1px solid #fff";
                // document.getElementById('search_btn').setAttribute('disabled', true);
                var data = "invoice_no=" + search_data;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/branchadmin/branch-search-sell-invoice') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_result').innerHTML = data;
                    }
                });
            }
        }

    </script>

@endsection