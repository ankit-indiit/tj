<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
    	'order_id',
    	'product_id',
    	'product_qty',
    	'product_price',
    	'seller_id',
    	'created_at',
    ];

    protected $appends = ['estimate_delevery', 'product_name', 'product_price', 'product_image', 'product_slug', 'product_quentity'];

    public function getProductNameAttribute()
    {
        return Product::where('id', $this->attributes['product_id'])->pluck('name')->first();
    }

    public function getProductPriceAttribute()
    {
        return Product::where('id', $this->attributes['product_id'])->pluck('discounted_price')->first();
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
        $productImage = reset($unSerlizeProImage);
        return url("public/images/product/$productImage");
    }

    public function getCreatedAtAttribute()
    {
        return date('D, jS F', strtotime($this->attributes['created_at']));
    }

    public function getEstimateDeleveryAttribute()
    {
    	$sellerEstimateDate = BecomeSeller::where('user_id', $this->attributes['seller_id'])
    		->pluck('estimated_delivery')
    		->first();
    	$orderdDate = date('Y-m-d', strtotime($this->attributes['created_at']));
    	$estimateDays = explode('-', $sellerEstimateDate)[1];
    	return date('D, jS F', strtotime($orderdDate. " + $estimateDays days"));
    }
}
