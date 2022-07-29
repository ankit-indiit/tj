<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerWorkingHour extends Model
{
    protected $fillable = ['seller_id', 'day', 'open_time', 'close_time'];
}
