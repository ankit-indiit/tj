<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->unreadNotifications()->where('notifiable_id', Auth::user()->id)->update(['read_at' => now()]);
        $notifications = $user->notifications;
        $data = ['page_title' => 'Notification | TJ', 'notifications' => $notifications];        
        return view('notification.notification', $data);
    }    
}
