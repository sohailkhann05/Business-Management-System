<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellOrderDetail extends Model
{
    protected $fillable = [
        'product_id',
        'sell_order_id',
        'user_id',
        'per_product_price',
        'sell_unit',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sellOrder()
    {
        return $this->belongsTo(SellOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
