<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBonusDetail extends Model
{
    protected $fillable = [
        'product_bonus_id',
        'product_id',
        'total_sales',
        'total_amount'
    ];

    public function productBonus()
    {
        return $this->belongsTo(ProductBonus::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
