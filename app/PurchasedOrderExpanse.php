<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedOrderExpanse extends Model
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
