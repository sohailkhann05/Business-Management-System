@extends('layouts.branch-layout')
@section('title','Customer Claims')
@section('body_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3>
                        Customer Claims
                        <a href="{{ route('br-customerclaim.create') }}" style="float: right;"
                           class="btn btn-sm btn-default">Add Customer Claim</a>
                    </h3>
                    <hr>
                    <div class="table-responsive">
                        @if($claims->count() > 0)
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Invoice No</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <?php $sno = 1; ?>
                                <tbody>
                                @foreach($claims as $claim)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $claim->sellOrder->invoice_no }}</td>
                                        <td>
                                            <a href="{{ route('br-customer.show',$claim->user_id) }}"
                                               class="btn btn-sm btn-link" target="_blank">
                                                {{ $claim->sellOrder->user->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $claim->created_at->toFormattedDateString() }}
                                        </td>
                                        <td>
                                            <?php $i = $claim->sellClaimDetails->where('claim_status',0); ?>
                                            @if($i->count() > 0)
                                                <a href="{{ route('br-customerclaim.show',$claim->id) }}"
                                                   class="btn btn-sm btn-white">
                                                    View
                                                </a>
                                            @else
                                                <a href="{{ route('br-customerclaim.edit',$claim->id) }}"
                                                   class="btn btn-sm btn-white">
                                                    View
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table><br>
                            {{ $claims->links() }}
                    </div>
                    @else
                        <p>No customer claim record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>

@endsection