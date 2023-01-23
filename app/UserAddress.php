<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class UserAddress extends Model
{
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','userId', 'first_name', 'last_name','country_code','phone_no','countryId','pincode','locality','Address','city','landmark','type'
    ];

    public function scopeGetCountries($query)
    {
        return $query->join('countries', function($join)
            {
                return $join->on('user_address.countryId', '=', 'countries.id')->select('countries.name','countries.nicename','countries.id as countryId');
            });
    }
}
