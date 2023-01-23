<?php

namespace App;
use Auth;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use Filterable;

    protected $fillable = [
    	'order_id',
    	'product_id',
    	'product_qty',
    	'product_price',
    	'seller_id',
        'user_id',
        'status',
    ];

    protected $appends = [
        'estimate_delevery',
        'product_name',
        'product_image',
        'product_slug',
        'product_quentity',
        'shipping_address_id'
    ];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\OrderFilter::class);
    }

    public function getProductNameAttribute()
    {
        return Product::where('id', $this->attributes['product_id'])->pluck('name')->first();
    }    
    
    public function getProductSlugAttribute()
    {
        return Product::where('id', $this->attributes['product_id'])->pluck('slug')->first();
    }

    public function getProductQuentityAttribute()
    {
        return Product::where('id', $this->attributes['product_id'])->pluck('quantity')->first();
    }

    public function getShippingAddressIdAttribute()
    {
        return Order::where('id', $this->attributes['order_id'])->pluck('shipping_address_id')->first();
    }

    public function getProductImageAttribute()
    {
        $productImage = Product::where('id', $this->attributes['product_id'])->pluck('image')->first();
        if (isset($productImage)) {
            $unSerlizeProImage = unserialize($productImage);
            $productImage = reset($unSerlizeProImage);
            return url("public/images/product/$productImage");            
        } else {
            return asset("https://ui-avatars.com/api/?name=Not");
        }
    }

    public function getCreatedAtAttribute()
    {
        return date('D, jS M', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute()
    {
        return date('D, jS M', strtotime($this->attributes['updated_at']));
    }

    public function getEstimateDeleveryAttribute()
    {
    	$sellerEstimateDate = BecomeSeller::where('user_id', $this->attributes['seller_id'])
    		->pluck('estimated_delivery')
    		->first();
    	$orderdDate = date('Y-m-d', strtotime($this->attributes['created_at']));
    	$estimateDays = explode('-', $sellerEstimateDate)[1];
    	return date('D, jS M', strtotime($orderdDate. " + $estimateDays days"));
    }
}
