<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccountDetail extends Model
{
    protected $fillable = [
        'user_account_id',
        'amount',
        'transfer_type',
        'description',
        'transfer_date'
    ];

    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class);
    }

}
