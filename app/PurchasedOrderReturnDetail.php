<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedOrderReturnDetail extends Model
{
    protected $fillable = [
        'purchased_order_return_id',
        'product_id',
        'return_unit',
        'return_quantity',
        'status'
    ];

    public function purchasedOrderReturn()
    {
        return $this->belongsTo(PurchasedOrderReturn::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
