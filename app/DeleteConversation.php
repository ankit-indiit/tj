<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeleteConversation extends Model
{
    protected $fillable = [
    	'deleted_from',
    	'deleted_to',
    ];
}
