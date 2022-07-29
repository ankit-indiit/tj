<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostsLike extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts_likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'post_id', 'user_id'
    ];


}
