<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRelatedCollection extends Model
{
    protected $fillable = [
    	'product_id',
    	'product_collection',
    ];
}
