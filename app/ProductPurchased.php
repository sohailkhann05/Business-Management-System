<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPurchased extends Model
{
    protected $fillable = [
        'purchased_order_id',
        'product_id',
        'per_product_price',
        'product_purchased_quantity',
        'product_purchased_unit',
        'description',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchasedOrder()
    {
        return $this->belongsTo(PurchasedOrder::class);
    }

    public function sellOrderDetails()
    {
        return $this->hasMany(SellOrderDetail::class);
    }
}

