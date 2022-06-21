<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCouponApplied extends Model
{
    protected $fillable = [
    	'order_id',
    	'coupon_id',
    	'user_id',
    ];
}
