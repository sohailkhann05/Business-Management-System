@extends('layouts.business-layout')
@section('title',$bank->bank_branch)
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
    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <h3>
                Bank details
                <a style="float: right;" href="{{ route('business-bank.index') }}"
                   class="btn btn-sm btn-white">
                    View All
                </a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <p>Branch: {{ $bank->bank_branch }}</p>
                    <p>Account name: {{ $bank->account_name }}</p>
                </div>
                <div class="col-md-5">
                    <p>Account no: {{ $bank->account_no }}</p>
                    <p>Total Amount: {{ $bank->total_amount }}</p>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal"
                            data-target="#update-amount">
                        Update Amount
                    </button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <h3>
                Bank History details
                <a style="float: right;" href="{{ route('business-bank.edit',$bank->id) }}"
                   class="btn btn-sm btn-white">
                    View All History
                </a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @if($bank->bankAccountDetails()->count() > 0)
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
                                <?php $sno = 1; ?>
                                <tbody>
                                @foreach($bank->bankAccountDetails()->orderBy('created_at','desc')->limit(5)->get() as $item)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $item->transfer_amount }}</td>
                                        <td>{{ $item->transfer_type }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-neutral"
                                                    data-toggle="modal"
                                                    data-target="#cash_details"
                                                    onclick="cashDetails('{{ $item->description }}')">
                                                View
                                            </button>
                                        </td>
                                        <td>
                                            {{ $item->created_at->toFormattedDateString() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No history record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="modal fade" id="update-amount" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Update Bank Amount</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'put','action' => ['BuBankController@update',$bank->id],'onsubmit' => 'return loadingCss(this);']) }}
                    <div class="form-group">
                        <input type="number" min="0" class="form-control" name="transfer_amount"
                               placeholder="Amount"
                               required>
                    </div>
                    <div class="form-group">
                        <select name="transfer_type" id="transfer_type" class="form-control" required>
                            <option value="">Select Transfer Type</option>
                            <option value="Deposit">Deposit</option>
                            <option value="Withdraw">Withdraw</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="description" id="description" rows="2" placeholder="Amount description"
                                  class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" id="adding-form">
                        <button type="submit" class="btn btn-sm btn-default">Update Amount</button>
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
                    <h3 class="modal-title" id="modal-title-default">Amount description</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="amount-description"></p>
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
            document.getElementById('amount-description').innerHTML = data;
        }

    </script>

@endsection