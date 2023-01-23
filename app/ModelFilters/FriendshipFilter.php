<?php
namespace App\ModelFilters;
use EloquentFilter\ModelFilter;
use App\OrderProductStatus;

class FriendshipFilter extends ModelFilter
{
    public $relations = [];

    public function name($name)
    {
        $userIds = User::where('name', 'like', '%' . $name . '%')
            ->pluck('id');
        return $this->whereIn('first_user', $userIds)->orWhere('second_user', $userIds);
    }
}