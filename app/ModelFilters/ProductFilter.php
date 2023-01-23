<?php
namespace App\ModelFilters;
use EloquentFilter\ModelFilter;

class ProductFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function name($name)
    {        
        return $this->where('name', $name);
    }

    public function search($search)
    {
        echo $search;
        die;
        return $this->where('name', 'like', '%' . $search . '%');
    }

    // public function startDate($date)
    // {
    //     $startDate = \Carbon\Carbon::parse($date);
    //     return $this->whereDate('created_at', '>=', $startDate->format('Y-m-d'));
    // }

    // public function endDate($date)
    // {
    //     $endDate = \Carbon\Carbon::parse($date);
    //     return $this->whereDate('created_at', '<=', $endDate->format('Y-m-d'));
    // }
}