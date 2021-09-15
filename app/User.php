<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_category_id',
        'branch_id',
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'country',
        'region',
        'profile_picture',
        'hint'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function userCategory()
    {
        return $this->belongsTo(UserCategory::class);
    }

    public function purchasedOrders()
    {
        return $this->hasMany(PurchasedOrder::class);
    }

    public function purchasedClaims()
    {
        return $this->hasMany(PurchasedClaim::class);
    }

    public function sellClaims()
    {
        return $this->hasMany(SellClaim::class);
    }

    public function sellOrder()
    {
        return $this->hasMany(SellOrder::class);
    }

    public function userAccount()
    {
        return $this->hasOne(UserAccount::class);
    }

    public function wishLists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function productBonuses()
    {
        return $this->hasMany(ProductBonus::class);
    }

    public function bonuses()
    {
        return $this->hasMany(BonusCheck::class);
    }
}
