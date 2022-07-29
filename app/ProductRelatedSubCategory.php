<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRelatedSubCategory extends Model
{
    protected $fillable = [
    	'product_id',
    	'sub_cat_id',
    ];
}
