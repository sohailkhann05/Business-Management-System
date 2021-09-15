<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellOrderExpanse extends Model
{
    protected $fillable = [
        'sell_order_id',
        'sell_order_expanses',
        'description'
    ];

    public function sellOrder()
    {
        return $this->belongsTo(SellOrder::class);
    }
}
