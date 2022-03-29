<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'user_id',
        'name',
    	'price',    	
    	'quantity',
    	'delivery_cost',
    	'description',
    	'status',
        'image',
        'slug',
        'sku',
    ];

    public function productCategoryId()
    {
        return $this->hasMany(ProductRelatedCategory::class, 'product_id', 'id');
    }
}
