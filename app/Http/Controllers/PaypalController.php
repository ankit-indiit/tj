<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Omnipay\Omnipay;
use App\Order;
use App\OrderProduct;
use App\OrderCouponApplied;
use App\Cart;
use App\UserAddress;
use App\Coupon;
use App\Product;
use App\OrderProductStatus;
use App\Inventory;
use App\PaymentLog;
use App\OrderAddress;
use Session;
use Auth;
use DB;

class PaypalController extends Controller
{
    private $gateway;
   
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId('AUhCImnSV4HBVTNuDYyz_SXWCw_0spIKvNTUmtaTz9quMh6tu_DP0SS_fTmcCsWNnXJVZ-ZGZYueqg4d');
        $this->gateway->setSecret('EMkFfmsTebkiDdPyjJTfFrLWMVQmeejYAB3vBv2BLnQSHtBrN_axnbhyWSY2dRLs7ImCzulo-M1zDcxE');
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }
      
    public function charge(Request $request)
    {
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());   
        }
        Session::put('payment_detail', $request->all());
        $response8 = [];

        try {

            $response = $this->gateway->purchase(array(
                'amount'     => $request->total,
                'currency'   => 'USD',
                'returnUrl'  => url('success'),
                'cancelUrl'  => url('error'),
            ))->send();

            if ($response->isRedirect()) {
                return $response->redirect();
                // this will automatically forward the customer
            } else {
                return $response->getMessage();
            }
        } catch(Exception $e) {
                session::flash('error', $e->getMessage());
            return $e->getMessage();
        }
    }
      
    public function success(Request $request)
    {
        $data = Session::get('payment_detail');        
        $response8 =[];
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));

            $response = $transaction->send();
            if ($response->isSuccessful()){
                // The customer has successfully paid.
                $arr_body = $response->getData();

                if (Session::get('coupon') != NULL) {
                    $data['coupon_applied'] = 1;
                }        

                DB::beginTransaction();
                
                try {
                    
                    if (isset($data['save_billing_address']) && $data['save_billing_address'] == 'on') {
                        $billingAddress = UserAddress::create([
                            'userId' => Auth::user()->id,
                            'first_name' => $data['billing_first_name'],
                            'last_name' => $data['billing_last_name'],
                            'country_code' => strtolower($data['billing_country']),
                            'phone_no' => $data['billing_phone_no'],
                            'pincode' => $data['billing_zip_code'],
                            'Address' => $data['billing_address'],
                            'city' => strtolower($data['billing_city']),
                            'type' => 'billing',
                        ]);
                        $billingAddressType = 'saved';
                    } else {
                        OrderAddress::create([
                            'user_id' => Auth::id(),
                            'first_name' => $data['billing_first_name'],
                            'last_name' => $data['billing_last_name'],
                            'country_code' => strtolower($data['billing_country']),
                            'phone_no' => $data['billing_phone_no'],
                            'pincode' => $data['billing_zip_code'],
                            'Address' => $data['billing_address'],
                            'city' => strtolower($data['billing_city']),
                            'type' => 'billing',
                        ]);
                        $billingAddressType = 'un_saved';
                    }

                    if (isset($data['save_shipping_address']) && $data['save_shipping_address'] == 'on') {
                        $shippingAddress =UserAddress::create([
                            'userId' => Auth::user()->id,
                            'first_name' => $data['shipping_first_name'],
                            'last_name' => $data['shipping_last_name'],
                            'country_code' => strtolower($data['shipping_country']),
                            'phone_no' => $data['shipping_phone_no'],
                            'pincode' => $data['shipping_zip_code'],
                            'Address' => $data['shipping_address'],
                            'city' => strtolower($data['shipping_city']),
                            'type' => 'shipping',
                        ]);
                        $shippingAddressType = 'saved';
                    } else {
                        OrderAddress::create([
                            'user_id' => Auth::id(),
                            'first_name' => $data['billing_first_name'],
                            'last_name' => $data['billing_last_name'],
                            'country_code' => strtolower($data['billing_country']),
                            'phone_no' => $data['billing_phone_no'],
                            'pincode' => $data['billing_zip_code'],
                            'Address' => $data['billing_address'],
                            'city' => strtolower($data['billing_city']),
                            'type' => 'billing',
                        ]);
                        $shippingAddressType = 'un_saved';
                    }
                  
                    $order = Order::create([
                        'payment_type' => $data['payment_type'],
                        'sub_total' => $data['sub_total'],
                        'shipping' => $data['shipping'],
                        'total' => $data['total'],
                        'coupon' => $data['coupon'],
                        'shipping_address_id' => isset($shippingAddress) ? $shippingAddress->id : $data['shipping_section'],
                        'billing_address_id' => isset($billingAddress) ? $billingAddress->id : $data['billing_section'],
                        'billing_address_type' => $billingAddressType,
                        'shipping_address_type' => $shippingAddressType,
                    ]);
                    foreach ($data['product'] as $key => $product) {
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

                    PaymentLog::create([
                        'order_id' => $order->id,
                        'status' => 'completed',
                        'data' => serialize($arr_body),
                    ]);

                    Session::forget('payment_detail');  

                    DB::commit();

                } catch (\Exception $e) {
                    $message['message'] = $e->getMessage();
                    DB::rollback();
                    $message['erro'] = 101;
                    return response()->json($message, 200);
                }                    
                
                return redirect()->route('buyer.order')->with('success','Order has been placed!');
            } else {
                return $response->getMessage();
            }
        } else {
            PaymentLog::create([
                'order_id' => $order->id,
                'status' => 'failed',
                'data' => serialize($arr_body),
            ]);
            return 'Transaction is declined';       
        }
    }
   
    /**
     * Error Handling.
     */
    public function error()
    {
        return 'User has cancelled the payment.';       
    }
}
