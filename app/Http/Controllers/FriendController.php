<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FriendController extends Controller
{
    public function friendFollower()
    {
        $data = ['page_title' => 'Home | TJ'];        
        return view('friend-follower.friend-follower',$data);
    }    
}
