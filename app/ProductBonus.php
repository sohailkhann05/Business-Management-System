<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBonus extends Model
{
    protected $fillable = [
        'branch_id',
        'user_id',
        'start_date',
        'end_date',
        'percentage',
        'total',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productBonusDetails()
    {
        return $this->hasMany(ProductBonusDetail::class);
    }
}
