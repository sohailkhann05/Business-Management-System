<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellOrderPayment extends Model
{
    protected $fillable = [
        'sell_order_id',
        'amount',
        'description'
    ];

    public function sellOrder()
    {
        return $this->belongsTo(SellOrder::class);
    }

}
