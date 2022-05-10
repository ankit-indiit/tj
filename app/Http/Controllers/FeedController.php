<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Wishlist;
use App\Cart;
use App\User;
use Auth;

class FeedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $unReadNotifications = $user->unReadNotifications;
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        $wishlistedProductId = Wishlist::where('user_id', Auth::user()->id)->pluck('product_id');
        $wishlistedProducts = Product::whereIn('id', $wishlistedProductId)->select('id', 'name', 'image', 'price', 'slug')->get();
        $data = ['page_title' => 'Feed | TJ', 'wishlistedProducts' => $wishlistedProducts, 'unReadNotifications' => $unReadNotifications, 'cartItems' => $cartItems];
        return view('feed',$data);
    }
    
    
}
