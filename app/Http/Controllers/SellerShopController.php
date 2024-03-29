<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Notification;
use App\Notifications\MyNotification;
use App\User;
use App\BecomeSeller;
use App\ShopFollower;
use App\Posts;
use App\Product;
use Auth;
use DB;

class SellerShopController extends Controller
{
    public function followShop(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $shopOwnerId = BecomeSeller::where('id', $request->shopId)->pluck('user_id')->first();
            $shopOwner = User::findOrFail($shopOwnerId);
            $request['user_id'] = Auth::user()->id;
            $request['store_id'] = $request->shopId;
            $request['status'] = 'confirmed';

            $shopFollow = ShopFollower::create($request->all());                      
            $notification = new \stdClass();
            $notification->body = show_user_name(Auth::user()->id).' has followed your shop!';
            $notification->sender_id = Auth::user()->id;
            $notification->actionURL = url('/notification');
            $notification->storeId = $request->shopId;
            
            $notidicationId = Notification::send($shopOwner, new MyNotification($notification));

            DB::commit();

        } catch (\Exception $e) {
            $message['message'] = $e->getMessage();
            DB::rollback();
            $message['erro'] = 101;
            return response()->json($message, 200);

        }
                
        $messags['message'] = "Followed!";
        $messags['erro'] = 101;
        return response()->json($messags, 200);
    }

    public function unFollowhop(Request $request)
    {
        $unFollowShop = ShopFollower::where('user_id', Auth::user()->id)
            ->where('store_id', $request->shopId)
            ->delete();
        $messags['message'] = "Done!";
        $messags['erro'] = 101;
        return response()->json($messags, 200);      
    }

    public function sellerShop(Request $request, $type = '')
    {
        $query = BecomeSeller::query();
        if ($type == 'suggestion') {
            // $query->where('price', '>=', $min);
        }
        if ($type == 'newest') {
            $query->orderBy('id', 'DESC');
        } 
        if ($type == 'my_shop') {
            $shopIds = ShopFollower::where('user_id', Auth::id())
                ->where('status', 'confirmed')
                ->pluck('store_id');
            $query->whereIn('id', $shopIds);
        }        
        $shops = $query->get();

        $data = ['page_title' => 'Feed | TJ', 'shops' => $shops];
        return view('seller.shop.shop', $data);
    }

    public function shopDetail(Request $request, $id)
    {
        $shopDetails = BecomeSeller::where('id', $id)->first();
        $shopPhotos = Posts::select('image')->where('store_id', $shopDetails->id)->get();
        $products = Product::where('user_id', $shopDetails->user_id)->get();
        $data = ['page_title' => 'Feed | TJ', 'shopDetails' => $shopDetails, 'shopPhotos' => $shopPhotos, 'products' => $products];
        return view('seller.shop.shop-detail',$data);
    }

    public function shopFollower(Request $request, $shopId)
    {
        $shopDetails = BecomeSeller::where('id', $shopId)->first();
        $shopMembers = ShopFollower::where('store_id', $shopId)->pluck('user_id');
        $data = ['page_title' => 'Feed | TJ', 'shopMembers' => $shopMembers, 'shopDetails' => $shopDetails];
        return view('seller.shop.shop-follower',$data);
    }

    public function searchProduct(Request $request)
    {
        if ($request->name != '') {
            $searchedProducts = Product::where('user_id', $request->userId)
                ->where('name', 'like', '%' . $request->name . '%')
                ->get();
        } else {
            $searchedProducts = Product::where('user_id', $request->userId)
            ->get();
        }
        $products = [];
        foreach ($searchedProducts as $product) {            
            $products []= view('seller.shop.shop-products', [
                    'product' => $product
                ])->render();
        }
        $message['erro'] = 101;
        $message['products'] = $products;
        return response()->json($message, 200);
    }
}
