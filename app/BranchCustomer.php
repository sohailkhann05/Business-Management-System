<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchCustomer extends Model
{
    protected $fillable = [
        'branch_id',
        'customer_id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
