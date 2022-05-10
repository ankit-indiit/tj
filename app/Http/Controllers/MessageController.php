<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Notifications\MessageNotification;
use App\Message;
use App\User;
use App\DeleteConversation;
use Auth;

class MessageController extends Controller
{
    public function userThread(Request $request)
    {
        $user = User::where('id', $request->userId)          
          ->first();       
        $threadMessages = Message::where(function($q) use ($request) {
            $q->where('from', Auth::user()->id);
            $q->where('to', $request->userId);
            $q->orWhere('from', $request->userId);
            $q->orWhere('to', Auth::user()->id);
        })->get();
        return view('chat.component.single-thread', compact('user', 'threadMessages'));
    }



    // public function __construct()
    // {
    //     if (!Auth::check()) 
    //         return Redirect::to('/');                           
    // }

    public function index(Request $request)
    {
        $pageTitle = "Chat";

        $listUsers = Message::chatlistUsers();

        $allUsers = User::all()->except($listUsers);

        if (isset($request->user_id)) {
            $receiverId = \Crypt::decrypt($request->user_id);            
            $userchat = Message::convertation(Auth::user()->id, $receiverId);
        } else {
            $userchat = [];
            $receiverId = '';
        }

        if (($key = array_search(\Auth::id(), $listUsers)) !== false) {
            unset($listUsers[$key]);
        }
        $user = User::findOrFail(Auth::user()->id);
        $user->unreadNotifications()->where('notifiable_id', Auth::user()->id)->update(['read_at' => now()]);
        return view('chat.chat', compact('pageTitle','allUsers','listUsers', 'userchat', 'receiverId'));
    }

    public function getUserChat(Request $request)
    {
        $senderId = Auth::user()->id;

        $receiverId  = $request->userId;

        $userchat = Message::convertation($senderId,$receiverId);

        return view('chat.component.single-thread',compact('userchat','receiverId'));
    }

    public function searchUserForChat(Request $request)
    {
    	$listUsers = Message::chatlistUsers();

        $allUsers = User::where('name', 'like', '%' . $request->name . '%')->where('id', '!=', $listUsers)->get();
        $users = '';
        foreach ($allUsers as $user) {
        	$users .= '<a href="javascript:void(0);" onclick="userThread('.$user->id.')" data-id="'.$user->id.'" class="block flex items-center py-3 px-4 space-x-3 hover:bg-gray-100 dark:hover:bg-gray-700"><div class="w-12 h-12 rounded-full relative flex-shrink-0"><img src="'.show_user_image($user->id).'" alt="" class="absolute h-full rounded-full w-full"><span class="absolute bg-green-500 border-2 border-white bottom-0 h-3 m-0.5 right-0 rounded-full shadow-md w-3"></span></div><div class="flex-1 min-w-0 relative text-gray-500"><h4 class="text-black font-semibold dark:text-white">'.show_user_name($user->id).'</h4><span class="absolute right-0 top-1 text-xs">Sun</span><p class="truncate">Esmod tincidunt ut laoreet</p></div></a>';
        }
        if (isset($request->name)) {
        	$data['data'] = $users;
        	$data['success'] = '101';
        } else {
        	$data['success'] = '102';
        }
        return $data;  
    }

    public function getUserChatMessage(Request $request)
    {
        $senderId = $request->senderId;

        $receiverId  = $request->receiverId;

        $userchat = Message::convertation($senderId,$receiverId);

        return view('innerpages/ajax-chatcontentmessage',compact('userchat','receiverId'));

    }

    public function sendMessage(Request $request)
    {
    	$userId= \Crypt::encrypt($request->from);
    	$user = User::findOrFail($request->to);
       	if ($request->file('file')) {
            $image = $request->file('file');
            $imagename = time() . '_' . Auth::user()->id . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/chat');
            $image->move($destinationPath, $imagename);
            $chat = $imagename;
            $type = 2;
        } else {
        	$chat = $request->message;
            $type = 1;
        }

        $inserted = Message::create([
            'to_id' => $request->to,
            'from_id' => $request->from,
            'chat' => $chat,
            'type' => $type,
        ]);

        if($inserted)
        {
            $notification = new \stdClass();
            $notification->body = show_user_name(Auth::user()->id).' has messaged you!';
            $notification->sender_id = Auth::user()->id;
            $notification->actionURL = url("/chat?user_id=$userId");
            $notification->messagsId = $inserted->id;
	    	
	        $notidicationId = Notification::send($user, new MessageNotification($notification));
        }
        $messags['message'] = $inserted->chat;
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function deleteConversation(Request $request)
    {
    	DeleteConversation::create([
    		'deleted_from' => Auth::user()->id,
    		'deleted_to' => $request->userId,
    	]);    

		$messags['message'] = 'Convertation has been deleted!';
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function postImage(Request $request)
    {
        $to_id = $request->receiverId;
        $from_id = $request->senderId;
        $type = $request->type;


        $file = $request->file('image');
        if (!empty($file)) {
            $image_name = '';
            $destinationPath =  public_path('assets/chatimages');
            
            $original_name = $file->getClientOriginalName();
            $file_name = str_replace(' ', '_', time().$original_name);
            $path = $request->file('image')->storeAs($destinationPath, $original_name);
                if ($file->move($destinationPath, $file_name)) {

                    $inserted = Message::insert([
                        'to_id'     => $to_id,
                        'from_id'   => $from_id,
                        'chat'      => $file_name,
                        'type'      => $type,
                    ]);

                    if($inserted)
                    {
                        echo 'sent successfully';
                        exit();
                    }
                    else
                    {
                        echo 'error in send message';
                        exit();
                    }
                }
                else
                {
                    echo 'error in send message';
                    exit();
                }
        }
    }
}
