@extends('layouts.branch-layout')
@section('title','Gross Profit Loss')
@section('body_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Gross Profit Loss
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="from-group">
                                <label for="">Select Product</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <option value="">Select Product</option>
                                    <option value="All Product">All Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="from-group">
                                <label for="">From Date</label>
                                <input type="date" name="from_date" id="from_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="from-group">
                                <label for="">To Date</label>
                                <input type="date" name="to_date" id="to_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="from-group">
                                <button style="margin-top: 30px;" type="button" id="search_btn" class="btn btn-default"
                                        onclick="grossProfitLoss()">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row" style="visibility: hidden;" id="result_div">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div id="search_result"></div>
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

        function grossProfitLoss() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var product_id = $('#product_id').val();
            if (from_date == '' || to_date == '' || product_id == '') {
                document.getElementById('from_date').style.border = "1px solid #d71313";
                document.getElementById('to_date').style.border = "1px solid #d71313";
                document.getElementById('product_id').style.border = "1px solid #d71313";
            } else {
                document.getElementById('result_div').style.visibility = 'visible';
                document.getElementById('search_result').innerHTML = '<p class="text-center">Generating Report</p><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
                document.getElementById('from_date').style.border = "1px solid #cad1d7";
                document.getElementById('to_date').style.border = "1px solid #cad1d7";
                document.getElementById('product_id').style.border = "1px solid #cad1d7";
                var data = "product_id=" + product_id + "&from_date=" + from_date + "&to_date=" + to_date;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/grossprofitloss') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_result').innerHTML = data;
                    }
                });
            }
        }

    </script>

@endsection