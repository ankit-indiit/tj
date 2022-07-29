<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'id',
    	'user_id',
        'seller_id',
    	'payment_type',
    	'sub_total',
    	'shipping',
    	'total',
    	'coupon',
    	'coupon_applied',
    	'shipping_address_id',
        'billing_address_id',
        'billing_address_type',
        'shipping_address_type',
    	'order_status',
    ];

    // protected $appends = ['order_products'];

    public function getCreatedAtAttribute()
    {
        return date('d F Y', strtotime($this->attributes['created_at']));
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
