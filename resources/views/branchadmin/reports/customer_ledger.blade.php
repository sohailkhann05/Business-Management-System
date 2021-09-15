@extends('layouts.branch-layout')
@section('title','Customer Ledger')
@section('body_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>Customer Ledger</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Select Type</label>
                            <select name="customer_type" id="customer_type" class="form-control"
                                    onblur="getCustomerType()">
                                <option value="">Select Type</option>
                                <option value="Customer">Customer</option>
                                <option value="Marketing Manager">Marketing Manager</option>
                                <option value="Vehicle">Vehicle</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Select Customer</label>
                            <select name="customer_id" id="customer_id" class="form-control">
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">From Date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">To Date</label>
                            <input type="date" name="to_date" id="to_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <button style="margin-top: 30px;" type="button" id="search_btn" class="btn btn-default"
                                    onclick="searchLedger()">
                                Search
                            </button>
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

        function getCustomerType() {
            var type = $('#customer_type').val();
            if (type == '') {
                document.getElementById('customer_type').style.border = "1px solid #d71313";
            } else {
                document.getElementById('customer_type').style.border = "1px solid #cad1d7";
                var data = "type=" + type;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/getcustomertype') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('customer_id').innerHTML = data;
                    }
                });
            }
        }

        function searchLedger() {
            var customer_id = $('#customer_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date == '' || to_date == '' || customer_id == '') {
                document.getElementById('customer_id').style.border = "1px solid #d71313";
                document.getElementById('from_date').style.border = "1px solid #d71313";
                document.getElementById('to_date').style.border = "1px solid #d71313";
            } else {
                document.getElementById('result_div').style.visibility = 'visible';
                document.getElementById('search_result').innerHTML = '<p class="text-center">Generating Report</p><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
                document.getElementById('from_date').style.border = "1px solid #cad1d7";
                document.getElementById('to_date').style.border = "1px solid #cad1d7";
                document.getElementById('customer_id').style.border = "1px solid #cad1d7";
                var data = "customer_id=" + customer_id + "&from_date=" + from_date + "&to_date=" + to_date;
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/customerledger') }}',
                    data: data,
                    success: function (data) {
                        document.getElementById('search_result').innerHTML = data;
                    }
                });

            }
        }

    </script>

@endsection