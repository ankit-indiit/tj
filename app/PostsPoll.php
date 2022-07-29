<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostsPoll extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts_poll';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'post_id', 'user_id', 'poll_reply'
    ];


}
