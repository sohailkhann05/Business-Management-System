<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashAccount extends Model
{
    protected $fillable = [
        'branch_id',
        'total_amount'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function cashAccountDetails()
    {
        return $this->hasMany(CashAccountDetail::class);
    }
}
