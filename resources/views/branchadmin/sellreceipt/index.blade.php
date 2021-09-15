@extends('layouts.branch-layout')
@section('title','Customer Receipt')
@section('body_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Customer Receipts
                        <a style="float: right;" href="{{ route('br-customerreceipt.create') }}"
                           class="btn btn-sm btn-default">
                            Add Customer Receipt
                        </a>
                    </h3>
                    <hr>
                    @if($claims->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($claims as $claim)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            {{ $claim->sellClaim->user->name }}
                                        </td>
                                        <td>
                                            {{ $claim->product->product_name }}
                                        </td>
                                        <td>
                                            @if($claim->receipt_status == 1)
                                                Completed
                                            @elseif($claim->receipt_status == 0)
                                                Remaining
                                            @endif
                                        </td>
                                        <td>
                                            {{ $claim->updated_at->toFormattedDateString() }}
                                        </td>
                                        <td>
                                            <a href="{{ route('br-customerreceipt.show',$claim->sell_claim_id) }}"
                                               class="btn btn-sm btn-white">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No receipt record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>

@endsection