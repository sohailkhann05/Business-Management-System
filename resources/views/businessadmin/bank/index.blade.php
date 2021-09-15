@extends('layouts.business-layout')
@section('title','Banks')
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
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        All Banks
                        <a style="float: right;" href="{{ route('business-bank.create') }}"
                           class="btn btn-sm btn-white">
                            Add Bank
                        </a>
                    </h3><hr>
                    <?php $i = $banks->count(); ?>
                    @if($i > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Bank Branch</th>
                                    <th scope="col">Account Name</th>
                                    <th scope="col">Account No</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sno = 1;?>
                                @foreach($banks as $bank)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $bank->bank_branch }}</td>
                                        <td>{{ $bank->account_name }}</td>
                                        <td>{{ $bank->account_no }}</td>
                                        <td>
                                            <a href="{{ route('business-bank.show',$bank->id) }}"
                                               class="btn btn-sm btn-default">View</a>
                                        </td>
                                        <td>{{ $bank->created_at->toFormattedDateString() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No record found.
                    @endif
                </div>
            </div>
        </div>
    </div><br>

@endsection