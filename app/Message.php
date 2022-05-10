<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Message extends Model
{
    protected $fillable = [
    	'type',
    	'chat',
    	'to_id',
    	'from_id',
    	'is_read',
    ];  

    public function getCreatedAtAttribute()
    {
        return date('d M Y', strtotime($this->attributes['created_at']));
    }

    public static function convertation($toId = null, $fromId = null)
    {
        $deletedConversation = DeleteConversation::where('deleted_from', Auth::user()->id)
            ->pluck('created_at')->first();

        if ($deletedConversation) {
            $convertation = DB::select("select * from messages where to_id = $toId and from_id = $fromId or  from_id = $toId  and to_id = $fromId and created_at >= '".$deletedConversation."' order by created_at asc");
        } else {
            $convertation = DB::select("select * from messages where to_id = $toId and from_id = $fromId or  from_id = $toId  and to_id = $fromId order by created_at asc");
        }

        return $convertation;

    }

    public function scopeConveration($query,$toId = null, $fromId = null)
    {
        return $query->where('to_id', $toId)->orWhere('from_id',$fromId)->where('to_id', $fromId)->orWhere('from_id',$toId);
    }

    public function scopeUnseen($query,$toId = null )
    {
        return $query->where('to_id',$toId)->orWhere('is_read',0);
    }

    public function existingUsersIds()
    {
        $userIds = array(\Auth::id());
        $exceptUserIds =  DB::select('SELECT users.userIds
            FROM
            (
                SELECT to_id as userIds FROM messages 
                UNION
                SELECT from_id as userIds FROM messages 
            ) users
            WHERE users.userIds IS NOT NULL');

        if(count($exceptUserIds) > 0)
        {
            foreach($exceptUserIds as $userId)
            {
                array_push($userIds, $userId->userIds);
            }
        }

        return array_unique($userIds);

    }

    public static function chatlistUsers()
    {
        $userIds = array(\Auth::id());
        $exceptUserIds =  DB::select('SELECT DISTINCT(users.userIds)
            FROM
            (
                SELECT to_id as userIds, created_at FROM messages  where to_id = "'.\Auth::id().'" or  from_id = "'.\Auth::id().'"
                UNION
                SELECT from_id as userIds, created_at FROM messages where to_id = "'.\Auth::id().'" or  from_id = "'.\Auth::id().'" 
            ) users
            WHERE users.userIds IS NOT NULL order by users.created_at desc');

        if(count($exceptUserIds) > 0)
        {
            foreach($exceptUserIds as $userId)
            {
                array_push($userIds, $userId->userIds);
            }
        }

        return array_unique($userIds);
    }
}
