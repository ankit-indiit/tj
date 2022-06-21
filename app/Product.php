<?php

namespace App;
use Auth;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use EloquentFilter\Filterable;

use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Searchable
{
    protected $fillable = [
    	'user_id',
        'name',
    	'price',    	
        'discounted_price',        
    	'quantity',
    	'delivery_cost',
    	'description',
    	'status',
        'image',
        'slug',
        'sku',
    ];

    protected $appends = ['check_cart_status'];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\ProductFilter::class);
    }

    public function getCreatedAtAttribute()
    {
        return date('d F Y', strtotime($this->attributes['created_at']));
    }

    public function getCheckCartStatusAttribute()
    {
        return Cart::where('product_id', $this->attributes['id'])->where('user_id', Auth::user()->id)->exists();
    }

    public function productCategoryId()
    {
        return $this->hasMany(ProductRelatedCategory::class, 'product_id', 'id');
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
         );
    }
}
