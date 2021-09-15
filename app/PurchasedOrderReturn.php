<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedOrderReturn extends Model
{
    protected $fillable = [
        'purchased_order_id',
        'deducted_amount',
        'description'
    ];

    public function purchasedOrder()
    {
        return $this->belongsTo(PurchasedOrder::class);
    }

    public function purchasedOrderReturnDetails()
    {
        return $this->hasMany(PurchasedOrderReturnDetail::class);
    }
}
