<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedClaim extends Model
{
    protected $fillable = [
        'branch_id',
        'user_id',
        'purchased_order_id',
        'status'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchasedOrder()
    {
        return $this->belongsTo(PurchasedOrder::class);
    }

    public function purchasedClaimDetails()
    {
        return $this->hasMany(PurchasedClaimDetail::class);
    }
}
