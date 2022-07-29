<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerSocialLink extends Model
{
    protected $fillable = ['seller_id', 'social_icon', 'social_link'];
}
