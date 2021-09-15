<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellClaim extends Model
{
    protected $fillable = [
        'branch_id',
        'user_id',
        'customer_id',
        'sell_order_id',
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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sellOrder()
    {
        return $this->belongsTo(SellOrder::class);
    }

    public function sellClaimDetails()
    {
        return $this->hasMany(SellClaimDetail::class);
    }
}
