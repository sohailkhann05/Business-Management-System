<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellOrder extends Model
{
    protected $fillable = [
        'branch_id',
        'user_id',
        'customer_id',
        'invoice_no',
        'belty_no',
        'received_by',
        'discount_amount',
        'description',
        'status',
        'total_amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sellOrderPayments()
    {
        return $this->hasMany(SellOrderPayment::class);
    }

    public function sellOrderReturn()
    {
        return $this->hasOne(SellOrderReturn::class);
    }

    public function sellOrderExpanses()
    {
        return $this->hasMany(SellOrderExpanse::class);
    }

    public function sellOrderDetails()
    {
        return $this->hasMany(SellOrderDetail::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
