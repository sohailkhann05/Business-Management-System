<?php $claims = $customer->sellClaims()->where('status', 0)->get(); ?>
@if($claims->count() > 0)
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Invoice</th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Detail</th>
                <th scope="col">Mark</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($claims as $claim)
                @foreach($claim->sellClaimDetails->where('claim_status',1) as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $claim->sellOrder->invoice_no }}</td>
                        <td>{{ $item->product->product_name }}</td>
                        <td>{{ $item->total_quantity }}</td>
                        <td>
                            <a href="{{ route('br-customerclaim.edit',$claim->id) }}"
                               class="btn btn-sm btn-white" target="_blank">
                                View
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-default"
                                    data-toggle="modal" data-target="#confirm_receipt"
                                    onclick="confirmReceipt('{{ $item->id }}','{{ $item->total_quantity }}')"
                                    title="Confirm Receipt">
                                Add Receipt
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No record found.</p>
@endif