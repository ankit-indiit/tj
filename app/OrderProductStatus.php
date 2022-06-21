<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProductStatus extends Model
{
    protected $fillable = [
    	'order_id',
    	'product_id',
    	'delivery_status',
    ];

    public function getCreatedAtAttribute()
    {
        return date('D, jS F', strtotime($this->attributes['created_at']));
    }
}
