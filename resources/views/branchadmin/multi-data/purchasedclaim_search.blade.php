@if($orders->count() > 0)
    <h3>Supplier: {{ $user->name }}</h3>
    <p>Product: {{ $product->product_name }}</p><br>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Invoice</th>
                <th scope="col">Quantity</th>
                <th scope="col">Date</th>
                <th scope="col">Detail</th>
                <th scope="col">Mark</th>
            </tr>
            </thead>
            <tbody>
            <?php $sno = 1; ?>
            @foreach($orders as $order)
                @foreach($order->productPurchased as $item)
                    @if($item->product_id == $product->id)
                        <tr>
                            <td>{{ $sno++ }}</td>
                            <td>{{ $order->invoice_no }}</td>
                            <td>{{ $item->product_purchased_quantity }}</td>
                            <td>
                                {{ $order->created_at->toFormattedDateString() }}
                            </td>
                            <td>
                                <a href="{{ route('br-purchasedorder.edit',$order->id) }}"
                                   class="btn btn-sm btn-link" target="_blank">
                                    View
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-default"
                                        data-toggle="modal" data-target="#add_to_claim"
                                        onclick="addToClaim('{{ $order->user_id }}','{{ $order->id }}','{{ $item->product_id }}')"
                                        title="Add to Claim">
                                    Add to Claim
                                </button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No product record found...</p>
@endif