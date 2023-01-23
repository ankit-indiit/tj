<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\ModelFilters\OrderFilter;
use Illuminate\Support\Facades\Validator;
use App\Order;
use App\OrderProduct;
use App\OrderCouponApplied;
use App\Cart;
use App\UserAddress;
use App\Coupon;
use App\Product;
use App\OrderProductStatus;
use App\Inventory;
use App\OrderAddress;
use Session;
use Auth;
use DB;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $customMessages = [
            'required_if' => 'The :attribute field is required!'
        ];
        $validator = Validator::make($request->all(), [
            'billing_section' => 'required',
            'shipping_section' => 'required',
            'billing_first_name' => 'required',
            'shipping_first_name' => 'required',
            'billing_last_name' => 'required',
            'shipping_last_name' => 'required',
            'billing_phone_no' => 'required',
            'shipping_phone_no' => 'required',
            'billing_zip_code' => 'required',
            'shipping_zip_code' => 'required',
            'billing_country' => 'required',
            'shipping_country' => 'required',
            'billing_city' => 'required',
            'shipping_city' => 'required',
            'billing_address' => 'required',
            'shipping_address' => 'required',
            // 'save_billing_address' => 'required_if:billing_section,0',
            // 'save_shipping_address' => 'required_if:shipping_section,0',
            'payment_type' => 'required',
        ], $customMessages);    
        
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        
        $request['user_id'] = Auth::user()->id;
        $request['order_status'] = '0';        
        if (Session::get('coupon') != NULL) {
            $request['coupon_applied'] = 1;
        }        

        DB::beginTransaction();
        
        try {
            
            if ($request->save_billing_address == 'on') {
                $billingAddress = UserAddress::create([
                    'userId' => Auth::user()->id,
                    'first_name' => $request->billing_first_name,
                    'last_name' => $request->billing_last_name,
                    'country_code' => strtolower($request->billing_country),
                    'phone_no' => $request->billing_phone_no,
                    'pincode' => $request->billing_zip_code,
                    'Address' => $request->billing_address,
                    'city' => strtolower($request->billing_city),
                    'type' => 'billing',
                ]);
                $billingAddressType = 'saved';
            } else {
                OrderAddress::create([
                    'user_id' => Auth::id(),
                    'first_name' => $request->billing_first_name,
                    'last_name' => $request->billing_last_name,
                    'country_code' => strtolower($request->billing_country),
                    'phone_no' => $request->billing_phone_no,
                    'pincode' => $request->billing_zip_code,
                    'Address' => $request->billing_address,
                    'city' => strtolower($request->billing_city),
                    'type' => 'billing',
                ]);
                $billingAddressType = 'un_saved';
            }

            if ($request->save_shipping_address == 'on') {
                $shippingAddress = UserAddress::create([
                    'userId' => Auth::user()->id,
                    'first_name' => $request->shipping_first_name,
                    'last_name' => $request->shipping_last_name,
                    'country_code' => strtolower($request->shipping_country),
                    'phone_no' => $request->shipping_phone_no,
                    'pincode' => $request->shipping_zip_code,
                    'Address' => $request->shipping_address,
                    'city' => strtolower($request->shipping_city),
                    'type' => 'shipping',
                ]);
                $shippingAddressType = 'saved';
            } else {
                OrderAddress::create([
                    'user_id' => Auth::id(),
                    'first_name' => $request->shipping_first_name,
                    'last_name' => $request->shipping_last_name,
                    'country_code' => strtolower($request->shipping_country),
                    'phone_no' => $request->shipping_phone_no,
                    'pincode' => $request->shipping_zip_code,
                    'Address' => $request->shipping_address,
                    'city' => strtolower($request->shipping_city),
                    'type' => 'shipping',
                ]);
                $shippingAddressType = 'un_saved';
            }

            // $request['billing_address_id'] = isset($billingAddress) ? $billingAddress->id : $request['billing_section'];
            // $request['shipping_address_id'] = isset($shippingAddress) ? $shippingAddress->id : $request['shipping_section'];
            // $request['billing_address_type'] = $billingAddressType;
            // $request['shipping_address_type'] = $shippingAddressType;

            $order = Order::create([
                'payment_type' => $request->payment_type,
                'sub_total' => $request->sub_total,
                'shipping' => $request->shipping,
                'total' => $request->total,
                'coupon' => $request->coupon,
                'shipping_address_id' => isset($shippingAddress) ? $shippingAddress->id : $request->shipping_section,
                'billing_address_id' => isset($billingAddress) ? $billingAddress->id : $request->billing_section,
                'billing_address_type' => $billingAddressType,
                'shipping_address_type' => $shippingAddressType,
            ]);
            foreach ($request->product as $key => $product) {
                /*----Save order----*/
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'product_qty' => $product['qty'],
                    'product_price' => $product['price'],
                    'seller_id' => $product['seller_id'],
                    'user_id' => Auth::id(),
                    'status' => 'request',
                ]);

                /*----Save Seller Inventory----*/
                Inventory::create([
                    'seller_id' => $product['seller_id'],
                    'product_id' => $product['id'],
                    'product_qty' => $product['qty'],
                ]);

                /*----Empty User Cart After Placed Order----*/
                Cart::where('product_id', $product['id'])
                    ->where('user_id', Auth::user()->id)
                    ->delete();                
            }

            /*----Save Coupon Detail if User Applies Coupon---*/
            if (Session::get('coupon') != NULL) {
                $couponId = Coupon::where('coupon_name', Session::get('coupon')['coupon_name'])
                    ->pluck('id')
                    ->first();
                OrderCouponApplied::create([
                    'order_id' => $order->id,
                    'coupon_id' => @$couponId,
                    'user_id' => Auth::user()->id,
                ]);
                Session::forget('coupon');
            }                      

            DB::commit();

        } catch (\Exception $e) {
            $message['message'] = $e->getMessage();
            DB::rollback();
            $message['erro'] = 101;
            return response()->json($message, 200);
        }
        return redirect()->route('buyer.order')->with('success', 'Your order has been successfully placed!');
    }

    public function sellerOrder(Request $request)
    {
        // $orderProducts = Order::whereHas('OrderProduct', function (Builder $query) 
        //     {
        //         $query->where('seller_id', '=', Auth::user()->id); 
        //     }
        // )->get();
        $orderProducts = OrderProduct::filter($request->all())
            ->where('seller_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->get();
        $data = ['page_title' => 'Seller Order | TJ', 'orderProducts' => $orderProducts];        
        return view('order.seller-order', $data);
    }

    public function updateSellerOrderStatus(Request $request)
    {
        $orderProducts = OrderProduct::where('order_id', $request->order_id)
            ->where('product_id', $request->product_id)
            ->update([
                'status' => $request->productStatus,
        ]);      

        $messags['message'] = 'Order status has been updated!';
        $messags['erro'] = 101;
        echo json_encode($messags);              
    }

    public function buyerOrder(Request $request)
    {        
        $orders = OrderProduct::filter($request->all())
            ->where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->get();        
        $data = ['page_title' => 'Order History | TJ', 'orders' => $orders];        
        return view('order.buyer-order', $data);
    }

    public function buyerOrderDetail(Request $request, $id)
    {
        $product = OrderProduct::where('id', $id)->first();
        if ($product->shipping_address_id == 0) {
            $userAddress = OrderAddress::where('user_id', Auth::id())->first();           
        } else {
            $userAddress = UserAddress::where('id', $product->shipping_address_id)->first();
        }
        
        $data = ['page_title' => 'Order History | TJ', 'product' => $product, 'userAddress' => $userAddress];
        return view('order.buyer-order-detail', $data);
    }

    public function sellerOrderDetail(Request $request, $id)
    {
        $product = OrderProduct::where('id', $id)->first();
        $order = Order::where('id', $product->order_id)->first();
        $userAddress = UserAddress::where('id', $order->shipping_address_id)->first();                    
        $data = ['page_title' => 'Order History | TJ', 'order' => $order, 'userAddress' => $userAddress, 'product' => $product];
        return view('order.seller-order-detail', $data);
    }
}
