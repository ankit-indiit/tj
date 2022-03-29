<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    protected $fillable = [
    	'user_id',
    	'name',
    	'option',
    ];
}
