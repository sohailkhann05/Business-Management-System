@extends('layouts.branch-layout')
@section('title','All Suppliers')
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
    <div class="row">
        <div class="col-md-12">
            <?php $i = $clients->count(); ?>
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Search Supplier
                        <a href="{{ route('br-supplier.create') }}" style="float: right;"
                           class="btn btn-sm btn-default">
                            Add Supplier
                        </a>
                    </h3>
                    <hr>
                    @if($i > 0)
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <select id="search_type" class="form-control" onblur="getSearchType()">
                                    <option value="">Select Type</option>
                                    <option value="Name">Supplier Name</option>
                                    <option value="Phone">Phone Number</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-9" id="search_type_result">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="search_result"></div>
                        </div>
                    @else
                        No supplier record found.
                    @endif
                </div>
            </div>
            <br>
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>Supplier List</h3>
                    <hr>
                    @if($i > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $z = 1; ?>
                                @foreach($clients as $client)
                                    @if($client->userCategory->user_category_name == 'Supplier')
                                        <tr>
                                            <td>{{ $z++ }}</td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->phone }}</td>
                                            <td>{{ $client->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                <a href="{{ route('br-supplier.show',$client->id) }}"
                                                   class="btn btn-sm btn-white">View</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <br>
                            {{ $clients->links() }}
                        </div>
                    @else
                        No supplier record found.
                    @endif
                </div>
            </div>
        </div>
    </div><br>

@endsection
@section('script_content')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getSearchType() {
            var search_type = $("#search_type").val();
            if (search_type == '' || search_type == null) {
                document.getElementById('search_type').style.border = "1px solid #d71313";
            } else {
                document.getElementById('search_type').style.border = "1px solid #cad1d7";
                var data = "search_type=" + search_type;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/searchtype') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_type_result').innerHTML = data;
                    }
                });
            }
        }

        function searchSupplierByName() {
            var search_field = $("#search_field").val();
            if (search_field == '' || search_field == null) {
                document.getElementById('search_field').style.border = "1px solid #d71313";
            } else {
                document.getElementById('search_result').innerHTML = '<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
                document.getElementById('search_field').style.border = "1px solid #cad1d7";
                var data = "supplier_name=" + search_field;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/searchsupplierbyname') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_result').innerHTML = data;
                    }
                });
            }
        }

        function searchSupplierByPhone() {
            var search_field = $("#search_field").val();
            if (search_field == '' || search_field == null) {
                document.getElementById('search_field').style.border = "1px solid #d71313";
            } else {
                document.getElementById('search_field').style.border = "1px solid #cad1d7";
                var data = "supplier_phone=" + search_field;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/searchsupplierbyphone') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_result').innerHTML = data;
                    }
                });
            }
        }

    </script>

@endsection