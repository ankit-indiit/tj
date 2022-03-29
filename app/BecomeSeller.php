<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BecomeSeller extends Model
{
    protected $fillable = [
    	'user_id',
		'shop_name',
		'store_number',
		'location',
		'country',
		'state',
		'city',
		'postal_code',
    ];
}
