<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccountDetail extends Model
{
    protected $fillable = [
        'bank_account_id',
        'transfer_amount',
        'transfer_type',
        'description',
        'transfer_to'
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
}
