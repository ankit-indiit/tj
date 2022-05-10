<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Auth;
use DB;

class User extends Authenticatable implements Searchable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','timezone','country_code','phone_no','cover_image','profile_image','bio', 'switch_as', 'last_seen'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['user_friendship_status', 'store_id'];

    public function getProfileImageAttribute($value)
    {
        return $value == '' ? "https://ui-avatars.com/api/?name=".@$this->attributes['name']."&length=1" : url('public/profile') . "/" . $value;
    }

    public function getUserFriendshipStatusAttribute()
    {
        $friendshipStatus = DB::select('SELECT DISTINCT(friendships.status) FROM
                (
                   SELECT status as status FROM friendships  where  first_user = "'.Auth::user()->id.'" AND second_user = "'.$this->attributes['id'].'"
                   
                   UNION

                   SELECT status as status FROM friendships where second_user = "'.Auth::user()->id.'" AND first_user = "'.$this->attributes['id'].'"

                )
            friendships');
        return @$friendshipStatus[0]->status;
    }

    public function getStoreIdAttribute()
    {
        return BecomeSeller::where('user_id', $this->attributes['id'])->pluck('id')->first();
    }

    public function getFriendship(User $user) {
        return Friendship::where(function($q) use ($user){
                $q->where(function($q) use($user) {
                $q->where('first_user', $user->id);
                $q->where('second_user', $this->id);
                })->orWhere(function($q) use($user) {
                $q->where('first_user', $this->id);
                $q->where('second_user', $user->id);
            });
        })->first();
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
         );
    }
}
