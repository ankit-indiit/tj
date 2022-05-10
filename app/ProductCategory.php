<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class ProductCategory extends Model implements Searchable
{
    protected $fillable = [
    	'feature_image',
    	'name',
    	'slug',
    	'parent_id',
    	'status',
    ];

    public function categories()
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
