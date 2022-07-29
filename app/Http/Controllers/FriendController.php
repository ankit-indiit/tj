<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Notification;
use App\Notifications\MyNotification;
use App\User;
use App\Posts;
use App\Countries;
use App\UserAddress;
use App\Friendship;
use Auth;
use DB;

class FriendController extends Controller
{
    public function friendFollower()
    {
        $data = ['page_title' => 'Home | TJ'];        
        return view('friend-follower.friend-follower',$data);
    }

    public function timeLine($id)
    {
    	$userId = Crypt::decrypt($id);
    	$countries = Countries::select('id', 'name')->get();
    	$address = UserAddress::GetCountries()
            ->where('userId', $userId)
            ->select('user_address.id', 'user_address.title', 'user_address.first_name', 'user_address.last_name', 'user_address.id', 'user_address.phone_no', 'user_address.Address', 'countries.name', 'countries.nicename')
            ->get();
    	$userProfile = User::where('id', $userId)->first();
        // $userFriends = User::userFriends($userId);
    	$userPhotos = Posts::where('image', '!=', '')->where('user_id', $userId)->pluck('image');
    	$data = ['page_title' => 'TimeLine | TJ', 'userProfile' => $userProfile,'userId' => $userId, 'userPhotos' => $userPhotos, 'address' => $address, 'countries' => $countries];  
    	return view('friend-follower.timeline', $data);
    }

    public function addToFriendList(Request $request)
    {
    	$user = User::findOrFail($request->friendId);
    	$request['first_user'] = Auth::user()->id;
    	$request['second_user'] = $request->friendId;
    	$request['acted_user'] = Auth::user()->id;
    	$request['status'] = 'pending';

    	DB::beginTransaction();
        
        try {
                        
    		$friendship = Friendship::create($request->all());    			    	
            $notification = new \stdClass();
            $notification->body = show_user_name(Auth::user()->id).' has requested to follow you!';
            $notification->sender_id = Auth::user()->id;
            $notification->actionURL = url('/notification');
            $notification->friendshipId = $friendship->id;
	    	
	        $notidicationId = Notification::send($user, new MyNotification($notification));

	        DB::commit();

		} catch (\Exception $e) {
            $message['message'] = $e->getMessage();
            DB::rollback();
            $message['erro'] = 101;
            return response()->json($message, 200);

        }
    	    	
        $messags['message'] = "Request has been sent!";
        $messags['erro'] = 101;
        return response()->json($messags, 200);
    }

    public function canvelOrUnFollowFriend(Request$request)
    {
        $userfriendShipStatus = $request->friendShipStatus;        

        Friendship::where('first_user', Auth::user()->id)
            ->where('second_user', $request->friendId)
            ->orWhere('first_user', $request->friendId)
            ->orWhere('second_user', Auth::user()->id)
            ->delete();        
        if ($userfriendShipStatus) {
            DB::table('notifications')->where('id', $userfriendShipStatus)->delete();
        }
        $messags['message'] = $userfriendShipStatus == 'pending' ? 'Canceled!' : 'Unfriend!';
        $messags['erro'] = 101;
        return response()->json($messags, 200);
    }

    public function blockFriend(Request$request)
    {
        Friendship::where('first_user', Auth::user()->id)
            ->where('second_user', $request->friendId)
            ->orWhere('first_user', $request->friendId)
            ->orWhere('second_user', Auth::user()->id)
            ->update([
                'status' => 'blocked',
                'block_by' => Auth::user()->id
            ]);
                
        $messags['message'] = 'You have blocked to '.show_user_name($request->friendId).'!';
        $messags['erro'] = 101;
        return response()->json($messags, 200);
    }

    public function unBlockFriend(Request$request)
    {
        Friendship::where('first_user', Auth::user()->id)
            ->where('second_user', $request->friendId)
            ->orWhere('first_user', $request->friendId)
            ->orWhere('second_user', Auth::user()->id)
            ->update([
                'status' => 'confirmed',
                'block_by' => NULL
            ]);
                
        $messags['message'] = 'You have un blocked to '.show_user_name($request->friendId).'!';
        $messags['erro'] = 101;
        return response()->json($messags, 200);
    }

    public function followBack(Request $request)
    {
        $user = User::findOrFail($request->userId);
        $friendship = Friendship::where('second_user', Auth::user()->id)
            ->where('first_user', $request->userId)
            ->where('status', 'pending')
            ->update([
                'status' => 'confirmed'
            ]);
        $notification = new \stdClass();
        $notification->body = show_user_name(Auth::user()->id).' has accepted your request!';
        $notification->sender_id = Auth::user()->id;
        $notification->actionURL = url('/notification');
        $notification->friendshipId = $request->friendshipId;
        
        Notification::send($user, new MyNotification($notification));        
        $messags['message'] = "Done!";
        $messags['erro'] = 101;
        return response()->json($messags, 200);
    }

    public function deleteFollowRequest(Request $request)
    {
        Friendship::where('id', $request->friendshipId)->delete();
        DB::table('notifications')->where('id', $request->notoficationId)->delete();
        $messags['message'] = "Done!";
        $messags['erro'] = 101;
        return response()->json($messags, 200);
    }

    public function seeAllFriendFollower(Request $request, $status)
    {
        if ($status == 'following') {            
            $users = userFriends();
        } elseif ($status == 'followers') {            
            $users = userFollowers();
        } elseif ($status == 'suggestion') {            
            $users = getAllUserIds();
        }

        $data = ['page_title' => 'Home | TJ', 'users' => $users, 'userStatus' => $status];        
        return view('friend-follower.single',$data);
    }

    public function searchUser(Request $request)
    {
        if ($request->searchFor == 'suggestion') {            
            $users = User::whereIn('id', getAllUserIds())->where('name', 'like', '%' . $request->user . '%')->get();            
        } elseif ($request->searchFor == 'following') {
            $users = User::whereIn('id', userFriends())->where('name', 'like', '%' . $request->user . '%')->get();
        } elseif ($request->searchFor == 'followers') {
            $users = User::whereIn('id', userFollowers())->where('name', 'like', '%' . $request->user . '%')->get();
        }

        $filteredUsers = [];
        foreach ($users as $user) {
            $userId= Crypt::encrypt($user->id);
            if ($request->searchFor == 'suggestion' && getUserById($user->id)->user_friendship_status == 'pending') {

                $filteredUsers[] .= '<div class="col-sm-6 followingUser"><div class="flex justify-between items-center lg:p-4 p-2.5"><div class="flex flex-1 items-center space-x-4"> <a href="'.route('time.line', $userId).'"> <img src="'.$user->profile_image.'" class="bg-gray-200 border border-white rounded-full w-10 h-10"> </a> <div class="flex-1 font-semibold capitalize"> <a href="'.route('time.line', $userId).'" class="text-black">'.$user->name.'</a> </div><div class="userFriendshipBtnSection'.$user->id.'"><a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="'.$user->id.'" data-status="pending" class="btn btn-primary btn-sm">Requested</a></div></div></div></div></div>';
            
            } elseif ($request->searchFor == 'following') {
            
                $filteredUsers[] .= '<div class="col-sm-6 followingUser"><div class="flex justify-between items-center lg:p-4 p-2.5"><div class="flex flex-1 items-center space-x-4"> <a href="'.route('time.line', $userId).'"> <img src="'.$user->profile_image.'" class="bg-gray-200 border border-white rounded-full w-10 h-10"> </a> <div class="flex-1 font-semibold capitalize"> <a href="'.route('time.line', $userId).'" class="text-black">'.$user->name.'</a> </div><div class="userFriendshipBtnSection'.$user->id.'"><div><a href="#" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a><div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small"><ul class="space-y-1"><li></li><li><a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="'.$user->id.'" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600"><i class="uil-trash-alt mr-1"></i> Unfriend </a></li></ul></div></div></div></div></div></div></div>';
            
            } else {
            
                $filteredUsers[] .= '<div class="col-sm-6 followingUser"><div class="flex justify-between items-center lg:p-4 p-2.5"><div class="flex flex-1 items-center space-x-4"> <a href="'.route('time.line', $userId).'"> <img src="'.$user->profile_image.'" class="bg-gray-200 border border-white rounded-full w-10 h-10"> </a> <div class="flex-1 font-semibold capitalize"> <a href="'.route('time.line', $userId).'" class="text-black">'.$user->name.'</a> </div><div class="userFriendshipBtnSection'.$user->id.'"><a href="javascript:void(0);" id="followForFriendship" data-id="'.$user->id.'" class="btn btn-primary btn-sm">Follow</a></div></div></div></div></div>';
            
            }            
        }
        return $filteredUsers;
    }

    public function chat()
    {
        $data = ['page_title' => 'Chat | TJ'];        
        return view('chat.chat');
    }
}
