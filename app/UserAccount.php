<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $fillable = [
        'user_id',
        'balance_amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userAccountDetails()
    {
        return $this->hasMany(UserAccountDetail::class);
    }

}
