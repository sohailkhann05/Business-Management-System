<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'business_title',
        'business_address',
        'business_contact',
        'business_banner',
        'business_logo',
        'business_secondary_address',
        'business_website',
        'business_fax_no',
        'business_email_address',
        'business_phone_no',
        'business_details'
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function userCategories()
    {
        return $this->hasMany(UserCategory::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function businessAdmin()
    {
        return $this->hasOne(BusinessAdmin::class);
    }
}
