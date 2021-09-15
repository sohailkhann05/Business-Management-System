<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedClaimDetail extends Model
{
    protected $fillable = [
        'purchased_claim_id',
        'product_id',
        'total_quantity',
        'defect_reason',
        'received_quantity',
        'remaining_quantity',
        'claim_status',
        'receipt_status'
    ];

    public function purchasedClaim()
    {
        return $this->belongsTo(PurchasedClaim::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
