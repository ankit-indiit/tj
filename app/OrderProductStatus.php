<?php

namespace App;
use Auth;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class OrderProductStatus extends Model
{
    use Filterable;

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
