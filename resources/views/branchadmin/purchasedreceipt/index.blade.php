@extends('layouts.branch-layout')
@section('title','Supplier Receipt')
@section('body_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Supplier Receipts
                        <a style="float: right;" href="{{ route('br-supplierreceipt.create') }}"
                           class="btn btn-sm btn-default">
                            Add Supplier Receipt
                        </a>
                    </h3>
                    <hr>
                    @if($claims->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Supplier</th>
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
                                            {{ $claim->purchasedClaim->user->name }}
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
                                            <a href="{{ route('br-supplierreceipt.show',$claim->purchased_claim_id) }}"
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