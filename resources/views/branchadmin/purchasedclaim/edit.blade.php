@extends('layouts.branch-layout')
@section('title','Supplier Claim')
@section('body_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        {{ $claim->user->name }} Claim
                        <a style="float: right;" href="{{ route('br-supplierclaim.index') }}"
                           class="btn btn-sm btn-default">
                            View All Claim
                        </a>
                    </h3>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Received Quantity</th>
                                <th scope="col">Remaining Quantity</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php $i = 1; ?>
                            @foreach($claim->purchasedClaimDetails()->orderBy('created_at','desc')->get() as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>{{ $item->total_quantity }}</td>
                                    <td>
                                        @if($item->receipt_status == 1)
                                            Completed
                                        @elseif($item->receipt_status == 0)
                                            Remaining
                                        @endif
                                    </td>
                                    <td>{{ $item->received_quantity }}</td>
                                    <td>
                                        @if($item->receipt_status == 1)
                                            -
                                        @else
                                            {{ $item->remaining_quantity }}
                                        @endif
                                    </td>
                                    <td>{{ $item->updated_at->toFormattedDateString() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

@endsection