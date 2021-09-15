<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'business_id',
        'branch_title',
        'branch_banner',
        'branch_address',
        'branch_phone_no',
        'branch_fax_no',
        'branch_email_address',
        'branch_secondary_address'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function branchAdmin()
    {
        return $this->hasOne(BranchAdmin::class);
    }

    public function cashAccounts()
    {
        return $this->hasMany(CashAccount::class);
    }

    public function productInStocks()
    {
        return $this->hasMany(ProductInStock::class);
    }

    public function purchasedOrders()
    {
        return $this->hasMany(PurchasedOrder::class);
    }

    public function sellOrders()
    {
        return $this->hasMany(SellOrder::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
