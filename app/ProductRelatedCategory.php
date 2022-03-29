<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRelatedCategory extends Model
{
    protected $fillable = [
    	'product_id',
    	'cat_id',
    ];

    public function productCategoryId()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
