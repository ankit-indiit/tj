<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
    	'user_id',
    	'product_id',
    	'quantity',
    ];

    protected $appends = ['product_name', 'product_price', 'product_image', 'product_slug', 'product_quentity', 'seller_id', 'estimate_delevery'];

    public function getProductNameAttribute()
    {
    	return Product::where('id', $this->attributes['product_id'])->pluck('name')->first();
    }

    public function getProductPriceAttribute()
    {
    	return Product::where('id', $this->attributes['product_id'])->pluck('discounted_price')->first();
    }
    
    public function getSellerIdAttribute()
    {
        return Product::where('id', $this->attributes['product_id'])->pluck('user_id')->first();
    }

    public function getProductSlugAttribute()
    {
        return Product::where('id', $this->attributes['product_id'])->pluck('slug')->first();
    }

    public function getProductQuentityAttribute()
    {
        return Product::where('id', $this->attributes['product_id'])->pluck('quantity')->first();
    }

    public function getProductImageAttribute()
    {
    	$productImage = Product::where('id', $this->attributes['product_id'])->pluck('image')->first();
    	$unSerlizeProImage = unserialize($productImage);
        @$productImage = reset($unSerlizeProImage);
    	return url("public/images/product/$productImage");
    }

    public function getEstimateDeleveryAttribute()
    {
        $sellerId = Product::where('id', $this->attributes['product_id'])->pluck('user_id')->first();
        $selerEstimate = BecomeSeller::where('user_id', $sellerId)->pluck('estimated_delivery')->first();
        $days = explode("-", $selerEstimate);
        return 'Deleverd by '.date('D',strtotime('+'.@$days[1].' day')).', '.date('d M',strtotime('+'.@$days[1].' day'));
    }
}
