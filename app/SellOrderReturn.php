<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellOrderReturn extends Model
{
    protected $fillable = [
        'sell_order_id',
        'deducted_amount',
        'description'
    ];

    public function sellOrder()
    {
        return $this->belongsTo(SellOrder::class);
    }

    public function sellOrderReturnDetails()
    {
        return $this->hasMany(SellOrderReturnDetail::class);
    }
}
