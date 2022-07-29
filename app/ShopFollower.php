<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopFollower extends Model
{
    protected $fillable = [
    	'user_id',
    	'store_id',
    	'status',
    ];
}
