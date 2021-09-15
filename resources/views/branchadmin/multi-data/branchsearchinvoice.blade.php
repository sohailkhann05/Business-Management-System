@if($order)
    <br>
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">Invoice no</th>
            <th scope="col">Supplier</th>
            <th scope="col">Belty no</th>
            <th scope="col">Receiver</th>
            <th scope="col">Date</th>
            <th scope="col">Details</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $order->invoice_no }}</td>
            <td>
                <a href="{{ route('br-supplier.show',$order->user_id) }}">{{ $order->user->name }}</a>
            </td>
            <td>{{ $order->belty_no }}</td>
            <td>{{ $order->received_by }}</td>
            <td>{{ $order->created_at->toFormattedDateString() }}</td>
            <td>
                <a href="{{ route('br-purchasedorder.show',$order->id) }}"
                   class="btn btn-sm btn-default">View</a>
            </td>
        </tr>
        </tbody>
    </table>
@else
    <br>
    <p>No result found...</p>
@endif