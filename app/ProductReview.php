<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = [
    	'product_id',
    	'user_id',
    	'title',
    	'rating',
    	'comment',
    ];

    public function getCreatedAtAttribute()
    {
    	return date('d F Y', strtotime($this->attributes['created_at']));
    }
}
