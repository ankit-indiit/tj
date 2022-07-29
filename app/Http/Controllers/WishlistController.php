<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Wishlist;
use App\Product;
use Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $productIds = Wishlist::where('user_id', Auth::user()->id)->pluck('product_id');
        $products = Product::whereIn('id', $productIds)
                        ->select('id', 'image', 'name', 'price', 'slug')
                        ->get();
        $data = ['page_title' => 'Wishlist | TJ', 'products' => $products];      
        return view('wishlist.wishlist',$data);
    }

    public function deleteProductFromWishlist(Request $request)
    {
        Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->productId)->delete();
        $messags['message'] = "Product has been removed from wishlist!";
        $messags['erro'] = 101;
        return response()->json($messags, 200);
    }
}
