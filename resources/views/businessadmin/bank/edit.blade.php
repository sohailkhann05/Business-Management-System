@extends('layouts.business-layout')
@section('title','Bank Account History')
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

    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <h3>
                Bank Account History
                <a style="float: right;" href="{{ route('business-bank.show',$bank->id) }}"
                   class="btn btn-sm btn-white">
                    Back To Account
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
                                @foreach($bank->bankAccountDetails()->orderBy('created_at','desc')->get() as $history)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $history->transfer_amount }}</td>
                                        <td>{{ $history->transfer_type }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-neutral"
                                                    data-toggle="modal"
                                                    data-target="#cash_details"
                                                    onclick="">
                                                View
                                            </button>
                                        </td>
                                        <td>{{ $history->created_at->toFormattedDateString() }}</td>
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
    </div><br>
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
            var datas = JSON.parse(data);
            alert(datas);
            document.getElementById('amount-description').innerHTML = text;
        }

    </script>

@endsection