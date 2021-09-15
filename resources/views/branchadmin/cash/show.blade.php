@extends('layouts.branch-layout')
@section('title','Cash Account')
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
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
            <span class="alert-inner--text"><strong>Warning!</strong> {{ session('warning') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div><br>
    @endif

    <div class="header-body">
        <!-- Card stats -->
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Current Cash</h5>
                                <span class="h2 font-weight-bold mb-0">
                                    {{ $cash->total_amount }}/-
                                </span>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-nowrap">Updated: {{ $cash->updated_at->toFormattedDateString() }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <button type="button" class="btn btn-block btn-default mb-3" data-toggle="modal"
                        data-target="#update_cash">
                    Update Cash
                </button>
            </div>
        </div>
    </div>
    <br>
    <div class="card shadow">
        <div class="card-header bg-transparent">
            <h3 class="mb-0">Transaction History</h3>
            <p>Order on recent activity</p>
        </div>
        <?php
        $details = $cash->cashAccountDetails()->orderBy('created_at', 'desc')->get();
        $count = $details->count();
        ?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if($count > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($details as $detail)
                                    <tr>
                                        <td>{{ $count-- }}</td>
                                        <td>{{ $detail->transfer_amount }}</td>
                                        <td>{{ $detail->transfer_type }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-default mb-3"
                                                    data-toggle="modal"
                                                    data-target="#cash_details"
                                                    onclick="cashDetails('{{ $detail->cash_description }}')">
                                                View
                                            </button>
                                        </td>
                                        <td>
                                            {{ $detail->created_at->toFormattedDateString() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No transaction record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="modal fade" id="update_cash" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-default">Update Cash</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'put','action' => ['BrCashController@update',$cash->id],'onsubmit' => 'return loadingCss(this);']) }}
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                            </div>
                            <input class="form-control" name="transfer_amount" placeholder="Cash Amount" type="number"
                                   min="0" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <select name="transfer_type" id="transfer_type" class="form-control">
                                <option value="">Select Transfer Type</option>
                                <option value="Deposit">Deposit</option>
                                <option value="Withdraw">Withdraw</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-chat-round"></i></span>
                            </div>
                            <textarea name="cash_description" id="cash_description" rows="2"
                                      placeholder="Cash description" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" id="adding-form">
                        <button type="submit" class="btn btn-sm btn-success" style="float: right;">Update Cash</button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cash_details" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-default">Transaction description</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="cash_amount_description"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_content')

    <script>

        function cashDetails(data) {
            document.getElementById('cash_amount_description').innerHTML = data;
        }

    </script>

@endsection