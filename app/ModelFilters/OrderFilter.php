<?php
namespace App\ModelFilters;
use EloquentFilter\ModelFilter;
use App\OrderProductStatus;

class OrderFilter extends ModelFilter
{
    public $relations = [];

    public function status($status)
    {	
        return $this->where('status', $status);
    }
}