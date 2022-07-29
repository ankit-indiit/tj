<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRelatedAttr extends Model
{
    protected $fillable = [
    	'product_id',
    	'product_attr',
    ];
}
