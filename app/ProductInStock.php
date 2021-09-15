<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInStock extends Model
{
    protected $fillable = [
        'branch_id',
        'product_id',
        'total_stock'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
