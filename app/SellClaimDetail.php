<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellClaimDetail extends Model
{
    protected $fillable = [
        'sell_claim_id',
        'product_id',
        'total_quantity',
        'defect_reason',
        'received_quantity',
        'remaining_quantity',
        'claim_status',
        'receipt_status'
    ];

    public function sellClaim()
    {
        return $this->belongsTo(SellClaim::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
