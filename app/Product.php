<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_category_id',
        'branch_id',
        'product_name',
        'product_initial_price',
        'product_purchased_price',
        'product_average_price',
        'product_selling_unit',
        'product_purchased_unit',
        'product_unit_quantity',
        'description',
        'product_image',
        'bonus_check'
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productPurchased()
    {
        return $this->hasMany(ProductPurchased::class);
    }

    public function productInStock()
    {
        return $this->hasOne(ProductInStock::class);
    }

    public function sellOrderDetails()
    {
        return $this->hasMany(SellOrderDetail::class);
    }

    public function sellOrderReturnDetails()
    {
        return $this->hasMany(SellOrderReturnDetail::class);
    }

    public function purchasedOrderReturnDetails()
    {
        return $this->hasMany(PurchasedOrderReturnDetail::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function wishLists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function bonuses()
    {
        return $this->hasMany(BonusCheck::class);
    }

    public function productBonusDetails()
    {
        return $this->hasMany(ProductBonusDetail::class);
    }

}
