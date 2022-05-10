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
		'image',        
    ];

    protected $appends = ['store_category', 'followers_count'];

    public function getImageAttribute()
    {
    	return $this->attributes['image'] == '' ? 'https://ui-avatars.com/api/?name=&length=1' : url('public/assets/images') . '/' . $this->attributes['image'];    	
    }

    public function getStoreCategoryAttribute()
    {
    	return ShopCategory::where('store_id', $this->attributes['id'])->select('id', 'name')->get();    	
    }

    public function getFollowersCountAttribute()
    {
        return ShopFollower::where('store_id', $this->attributes['id'])->count();       
    }
}
