<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\Wishlist;
use App\User;
use App\Coupon;
use Auth;
use Session;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();        
        $data = ['page_title' => 'Feed | TJ', 'cartItems' => $cartItems];
        return view('cart.cart', $data);
    }
    
    public function store(Request $request)
    {
    	$request['user_id'] = Auth::user()->id;
    	$request['product_id'] = $request->productId;
    	$request['quantity'] = $request->productQty;
    	if (Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->productId)->exists()) {
    		Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->productId)->delete();
    		Cart::create($request->all());
            $message = 'Product has been added to cart!';
    	} else {
	    	Cart::create($request->all());
	    	$message = 'Product has been added to cart!';
    	}
    	$messags['message'] = $message;
        $messags['erro'] = 101;
        $messags['html'] = '<a href="'.route('cart').'" class="absolute right-2 top-2 p-0.5 px-1.5 text-red-500 cart-icon-main">Go To Cart</a>';
        echo json_encode($messags);
    }
    
    public function update(Request $request)
    {
        $cartItems = array_combine($request->id, $request->quantity);
        foreach ($cartItems as $productId => $productQty) {
            Cart::where('id', $productId)->update([
                'quantity' => $productQty,
            ]);            
        }
        $messags['message'] = 'Card has been updated!';
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function delete(Request $request)
    {
        Cart::where('id', $request->id)->delete();
        $messags['message'] = 'Product has been removed to cart!';
        $messags['erro'] = 101;
        return json_encode($messags);
    }

    public function moveToWihlist(Request $request)
    {
        Cart::where('id', $request->id)->delete();
        Wishlist::create([
            'product_id' => $request->productId,
            'user_id' => Auth::user()->id,
        ]);
        $messags['message'] = 'Product has been moved to wishlist!';
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function applyCoupon(Request $request)
    {
        if (isset($request->couponName) && !empty($request->couponName)) {
            $sellerId = Coupon::where('coupon_name', $request->couponName)->pluck('user_id')->first();
            $discountedValue = Coupon::where('coupon_name', $request->couponName)->pluck('discounted_value')->first();
            $sellerProducts = Product::where('user_id', $sellerId)->pluck('id')->toArray();
            $discountOn = array_intersect(json_decode($request->productIds), $sellerProducts);
            $otherCartPro = array_diff(json_decode($request->productIds), $discountOn);
            $products = Product::whereIn('id', $discountOn)->pluck('discounted_price')->sum();
            $unDiscountedProduct = Product::whereIn('id', $otherCartPro)->pluck('discounted_price')->sum();
            $discount = $products - ($products * ($discountedValue / 100));      
            
            Session::put('coupon', [
                'discounted_price' => $discount, 
                'coupon' => $products-$discount, 
                'total_price' => $discount+$unDiscountedProduct,
            ]);
            $productName = '';
            foreach ($discountOn as $productId) {
                $productName .= Product::where('id', $productId)->pluck('name')->first();
            }

            $messags['message'] = 'You have got '.$discountedValue.'% discount on '.$productName .' !';
            $messags['erro'] = 101;
            echo json_encode($messags);
        } else {
            $messags['message'] = 'Please enter your coupon!';
            $messags['erro'] = 102;
            echo json_encode($messags);
        }
        // print_r(json_decode($request->productIds));
        // print_r($sellerProducts);
        // print_r(array_intersect(json_decode($request->productIds), $sellerProducts));
        // print_r($otherCartPro);
        // die;
    }
}
