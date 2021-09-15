<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedOrderPayment extends Model
{
    protected $fillable = [
        'purchased_order_id',
        'amount',
        'description'
    ];

    public function purchasedOrder()
    {
        return $this->belongsTo(PurchasedOrder::class);
    }
}
