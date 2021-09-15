@extends('layouts.branch-layout')
@section('title','Cash Accounts')
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
    <?php $i = $cashes->count(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Cash Account
                        @if($i == 0)
                            <a style="float: right;" href="{{ route('br-cash.create') }}"
                               class="btn btn-sm btn-default">
                                Create Account
                            </a>
                        @endif
                    </h3><hr>
                    @if($i > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sno = 1;?>
                                @foreach($cashes as $cash)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $cash->total_amount }}</td>
                                        <td>{{ $cash->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            <a href="{{ route('br-cash.show',$cash->id) }}" class="btn btn-sm btn-default">
                                                View
                                            </a>
                                        </td>
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