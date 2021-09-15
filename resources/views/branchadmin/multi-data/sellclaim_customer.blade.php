<?php
$sell_order_id = null;
$customer_id = null;
?>
@if($sells->count() > 0)
    <select name="customer_id" id="customer" class="form-control">
        <option value="">Select Customer (Customer - Phone)</option>
        @foreach($sells as $sell)
            @if($sell_order_id != $sell->sell_order_id && $customer_id != $sell->sellOrder->user_id)
                <option value="{{ $sell->sellOrder->user_id }}">
                    {{ $sell->sellOrder->user->name }} - {{ $sell->sellOrder->user->phone }}
                </option>
                <?php $sell_order_id = $sell->sell_order_id; $customer_id = $sell->sellOrder->user_id ?>
            @endif
        @endforeach
    </select>
@endif