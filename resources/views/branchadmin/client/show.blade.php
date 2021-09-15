@extends('layouts.branch-layout')
@section('title',$client->name)
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
    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <h3>
                {{ $client->name }} details
                <a style="float: right;" href="{{ route('br-supplier.index') }}"
                   class="btn btn-sm btn-default">
                    View All
                </a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Category</h3>
                            <p>{{ $client->userCategory->user_category_name }}</p>
                            <h3>E-Mail</h3>
                            <p>{{ $client->email }}</p>
                            <h3>City</h3>
                            <p>{{ $client->city }}</p>
                            <h3>Country</h3>
                            <p>{{ $client->country }}</p>
                        </div>
                        <div class="col-md-6">
                            <h3>Name</h3>
                            <p>{{ $client->name }}</p>
                            <h3>Phone</h3>
                            <p>{{ $client->phone }}</p>
                            <h3>Region</h3>
                            <p>{{ $client->region }}</p>
                            <h3>Address</h3>
                            <p>{{ $client->address }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('br-supplierbonus.show',$client->id) }}" class="btn btn-block btn-default">
                        Calculate Bonus
                    </a>
                    <hr>
                    <h3>Current Balance</h3>
                    <button class="btn-icon-clipboard">
                        <div>
                            <h3>
                                {{ $client->userAccount->balance_amount }} /-
                            </h3>
                        </div>
                    </button>
                    <p class="description mt-3"></p>
                    <button type="button" class="btn btn-white text-center" data-toggle="modal"
                            data-target="#update_balance">
                        Update Amount
                    </button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card shadow">
        <div class="card-header border-0">
            <h3 class="mb-0">
                Transaction History
                <a href="{{ route('br-transactionhistory.show',$client->id) }}" style="float: right;"
                   class="btn btn-sm btn-default">View All Transaction History</a>
            </h3>
            <hr>
            <?php
            $details = $client->userAccount->userAccountDetails()->orderBy('created_at', 'desc')->limit(5)->get();
            $i = $details->count();
            ?>
            @if($i > 0)
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $detail)
                            <tr>
                                <td>{{ $i-- }}</td>
                                <td>{{ $detail->amount }}</td>
                                <td>{{ $detail->transfer_type }}</td>
                                <td>{{ $detail->transfer_date }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-white" data-toggle="modal"
                                            data-target="#transaction_details"
                                            onclick="transactionDetails('{{ $detail->description }}')">
                                        View
                                    </button>
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
    </div><br>

    <div class="modal fade" id="update_balance" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-default">Balance Update</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'put','action' => ['BrClientController@update',$client->id],'onsubmit' => 'return loadingCss(this);']) }}
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                            </div>
                            <input name="amount" class="form-control" placeholder="Amount" type="number" min="0"
                                   required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <select name="transfer_type" class="form-control" required>
                                <option value="">Select Transfer</option>
                                <option value="Deposit">Deposit</option>
                                <option value="Withdraw">Withdraw</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input type="date" name="transfer_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni ni-chat-round"></i></span>
                            </div>
                            <textarea name="description" class="form-control" placeholder="Description"
                                      required></textarea>
                        </div>
                    </div>
                    <small style="color: red;"> Note: Read again carefully!</small>
                </div>
                <div class="modal-footer">
                    <div class="form-group" id="adding-form">
                        <button type="submit" style="float:right;" class="btn btn-sm btn-success">Update Balance
                        </button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="transaction_details" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-default">Transaction Details</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="transaction_record_detail"></p>
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

        function transactionDetails(data) {
            document.getElementById('transaction_record_detail').innerHTML = data;
        }

    </script>

@endsection