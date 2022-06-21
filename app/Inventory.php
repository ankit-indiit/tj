<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
    	'seller_id',
    	'product_id',
    	'product_qty',
    ];

    protected $appends = ['product_name', 'product_price', 'product_image', 'product_slug', 'product_quentity', 'sku'];

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

    public function getSkuAttribute()
    {
    	return Product::where('id', $this->attributes['product_id'])->pluck('sku')->first();
    }
}
