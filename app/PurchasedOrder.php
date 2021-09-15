<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedOrder extends Model
{
    protected $fillable = [
        'branch_id',
        'user_id',
        'invoice_no',
        'belty_no',
        'received_by',
        'discount_amount',
        'description'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productPurchased()
    {
        return $this->hasMany(ProductPurchased::class);
    }

    public function purchasedOrderPayment()
    {
        return $this->hasMany(PurchasedOrderPayment::class);
    }

    public function purchasedOrderReturn()
    {
        return $this->hasOne(PurchasedOrderReturn::class);
    }

    public function purchasedOrderExpanses()
    {
        return $this->hasMany(PurchasedOrderExpanse::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

}
