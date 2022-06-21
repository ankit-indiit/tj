<?php
#https://dev.indiit.solutions/tj/dev/handle-payment
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;


use App\Order;
use App\OrderProduct;
use App\OrderCouponApplied;
use App\Cart;
use App\UserAddress;
use App\Coupon;
use App\Product;
use App\OrderProductStatus;
use App\Inventory;
use Session;
use Auth;
use DB;

class PaymentController extends Controller
{
    public $items = [];
    // public function __construct()
    // {
    //     $this->items = $items;
    // }

    public function paymentDetail(Request $request)
    {
        $data = [];
        foreach ($request->product as $key => $product) {
            $data[] = [
                'name' => getProductNameById($product['id']),
                'qty' => $product['qty'],
                'price' => $product['price'],
            ];   

            array_push($this->items, [
                'name' => getProductNameById($product['id']),
                'price' => $product['price'],
                'desc'  => '',
                'qty' => $product['qty']
            ]);
        }

        Session::put('payment_detail', $data);  

        // dd($this->items);

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
            }

            if ($request->save_shipping_address == 'on') {
                $shippingAddress =UserAddress::create([
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
            }

            $request['billing_address_id'] = $request->billing_section != 0 ? $request->billing_section : $billingAddress->id;
            $request['shipping_address_id'] = $request->shipping_section != 0 ? $request->shipping_section : $shippingAddress->id;

            $order = Order::create($request->all());
            foreach ($request->product as $key => $product) {
                /*----Save order----*/
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'product_qty' => $product['qty'],
                    'product_price' => $product['price'],
                    'seller_id' => $product['seller_id'],
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
                /*----Save Product Delevery Status----*/
                OrderProductStatus::create([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'delivery_status' => 0,
                ]);
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

        $messags['message'] = 'Order detail stored in session!';
        $messags['erro'] = 201;
        echo json_encode($messags);
    }

    public function handlePayment()
    {
        $product = [];

        // $product['items'] = [
        //     [
        //         'name' => 'Nike Joyride 2',
        //         'price' => 112,
        //         'desc'  => 'Running shoes for Men',
        //         'qty' => 2
        //     ]
        // ];

        foreach (Session::get('payment_detail') as $data) {
            $product['items'] = $data;            
            
        }
        // die;
        // dd(Session::get('payment_detail'));
  
        $product['invoice_id'] = 1;
        $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = 224;
        $paypalModule = new ExpressCheckout;
  
        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);
  
        return redirect($res['paypal_link']);
    }
   
    public function paymentCancel()
    {
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }
  
    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {            
            return redirect()->route('buyer.order');
            dd('Payment was successfull. The payment success page goes here!');
        }
  
        dd('Error occured!');
    }
}