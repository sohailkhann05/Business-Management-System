<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashAccountDetail extends Model
{
    protected $fillable = [
        'cash_account_id',
        'cash_description',
        'transfer_amount',
        'transfer_type'
    ];

    public function cashAccount()
    {
        return $this->belongsTo(CashAccount::class);
    }
}
