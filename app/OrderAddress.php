<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $fillable = [
		'user_id',
		'first_name',
		'last_name',
		'email',
		'country_code',
		'phone_no',
		'pincode',
		'Address',
		'city',
		'type',
    ];
}
