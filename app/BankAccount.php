<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'business_id',
        'bank_branch',
        'account_name',
        'account_no',
        'total_amount'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function bankAccountDetails()
    {
        return $this->hasMany(BankAccountDetail::class);
    }
}
