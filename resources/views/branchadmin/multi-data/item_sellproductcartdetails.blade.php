<div class="table-responsive">
    <table class="table table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">Product</th>
            <th scope="col">Unit</th>
            <th scope="col">Items</th>
            <th scope="col"></th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                {{ $product->product->product_name }}
            </td>
            <td>
                {{ $product->product->product_purchased_unit }}
                <input type="hidden" value="{{ $product->product->product_purchased_unit }}" id="return_unit">
            </td>
            <td>
               <input type="number" id="return_quantity_1" class="form-control" style="width: 60px;" required min="0">
            </td>
            <td>
               <input type="number" id="return_quantity_2" class="form-control" style="width: 60px;" required min="0" value="0" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-success" title="Edit"
                        onclick="returnOrder('{{ $order_return_id }}','{{ $product->product_id }}','{{ $product->id }}')" data-toggle="modal" data-target="#confirm_return_order">
                    <i class="ni ni-check-bold"></i>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</div>