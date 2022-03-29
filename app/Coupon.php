<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
    	'user_id', 
    	'title', 
    	'description', 
    	'type', 
    	'expired_on', 
    	'discounted_value',
    	'coupon_name'
    ];
}
