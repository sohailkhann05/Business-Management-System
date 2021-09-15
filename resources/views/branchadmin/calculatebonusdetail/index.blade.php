@extends('layouts.branch-layout')
@section('title','Bonus History')
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
                        Bonus History
                    </h3><hr>
                    @if($bonuses->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sno = 1; ?>
                                @foreach($bonuses as $bonus)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $bonus->user->name }}</td>
                                        <td>
                                            From <b>{{ $bonus->start_date }}</b> To <b>{{ $bonus->end_date }}</b>
                                        </td>
                                        <td>
                                            {{ $bonus->created_at->toFormattedDateString() }}
                                        </td>
                                        <td>
                                            <a href="{{ route('br-supplierbonusdetail.show',$bonus->id) }}"
                                               class="btn btn-sm btn-white">View</a>
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

@endsection