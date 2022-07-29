<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    protected $fillable = [
    	'feature_image',
    	'name',
    	'slug',
    	'status',
    ];
}
