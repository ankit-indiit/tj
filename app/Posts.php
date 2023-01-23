<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'content', 'image', 'video', 'post_type', 'product_name', 'price', 'button1', 'button2', 'hide_comment', 'store_id', 'file_type'
    ];


}
