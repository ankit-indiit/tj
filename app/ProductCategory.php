<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
    	'feature_image',
    	'name',
    	'slug',
    	'parent_id',
    	'status',
    ];

    public function categories()
    {
        return $this->hasMany(ProductRelatedCategory::class, 'product_id', 'id');
    }
}
