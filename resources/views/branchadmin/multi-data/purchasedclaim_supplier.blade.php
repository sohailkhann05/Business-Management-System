<?php
$purchased_order_id = null;
$supplier_id = null;
?>
@if($purchases->count() > 0)
    <select name="supplier_id" id="supplier" class="form-control">
        <option value="">Select Supplier (Supplier - Phone)</option>
        @foreach($purchases as $purchase)
            @if($purchased_order_id != $purchase->purchased_order_id && $supplier_id != $purchase->purchasedOrder->user_id)
                <option value="{{ $purchase->purchasedOrder->user_id }}">
                    {{ $purchase->purchasedOrder->user->name }} - {{ $purchase->purchasedOrder->user->phone }}
                </option>
                <?php $purchased_order_id = $purchase->purchased_order_id; $supplier_id = $purchase->purchasedOrder->user_id; ?>
            @endif
        @endforeach
    </select>

@endif