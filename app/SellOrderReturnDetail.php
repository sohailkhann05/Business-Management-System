<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellOrderReturnDetail extends Model
{
    protected $fillable = [
        'sell_order_return_id',
        'product_id',
        'return_unit',
        'return_quantity',
        'status'
    ];

    public function sellOrderReturn()
    {
        return $this->belongsTo(SellOrderReturn::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
