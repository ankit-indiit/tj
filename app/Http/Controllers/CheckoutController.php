<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\BecomeSeller;
use App\User;
use App\Setting;
use App\Cart;
use App\Coupon;
use App\Countries;
use App\UserAddress;
use Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $shippingCharge = Setting::where('meta_key', 'shipping')->pluck('meta_value')->first();
        $countries = Countries::select('id', 'iso', 'name')->get();
        $cartItems = Cart::where('user_id', Auth::user()->id)->get(); 
        $billings = UserAddress::select('id', 'Address')
            ->where('userId', Auth::user()->id)
            ->where('type', 'billing')
            ->get(); 
        $shippings = UserAddress::select('id', 'Address')
            ->where('userId', Auth::user()->id)
            ->where('type', 'shipping')
            ->get(); 
        $data = ['page_title' => 'Checkout | TJ', 'countries' => $countries, 'cartItems' => $cartItems, 'billings' => $billings, 'shippings' => $shippings, 'shippingCharge' => $shippingCharge];
        return view('checkout.checkout',$data);
    }

    public function userAddressForm(Request $request)
    {
        if ($request->id == 0) {
            $address = '';
            $disabled = '';
            $checkbox = '<div class="clearfix">
                <input id="formcheckoutCheckbox1" name="save_'.$request->type.'_address" type="checkbox">
                <label class="t-labl" for="formcheckoutCheckbox1">Save address to my account</label>
            </div>';
        } else {
            $address = UserAddress::where('id', $request->id)->first();
            $disabled = 'readonly';
            $checkbox = '';
        }
        $countries = Countries::select('id', 'iso', 'name')->get();
        $allCountry = '';
        foreach ($countries as $country) {
          $userCountry = @$address->country_code == strtolower($country->iso) ? 'selected' : '';
          $allCountry .= '<option value="'.$country->iso.'" '.$userCountry.'>'.$country->name.'</option>';
        }
        // echo '<pre>';
        // print_r($allCountry);
        // die;

        $form = '<div class="user'.$request->type.'AddressForm">
            <div class="row mt-2">
              <div class="col-sm-6">
                 <label>First Name:</label>
                 <div class="form-group">
                    <input type="text" name="'.$request->type.'_first_name" value="'.@$address->first_name.'" class="form-control form-control--sm" '.$disabled.'>
                 </div>
              </div>
              <div class="col-sm-6">
                 <label>Last Name:</label>
                 <div class="form-group">
                    <input type="text" name="'.$request->type.'_last_name" value="'.@$address->last_name.'" class="form-control form-control--sm" '.$disabled.'>
                 </div>
              </div>
            </div>
            <div class="row">     
              <div class="col-sm-6">
                 <label>Phone no:</label>
                 <div class="form-group">
                    <input type="text" class="form-control form-control--sm" name="'.$request->type.'_phone_no" value="'.@$address->phone_no.'" '.$disabled.'>
                 </div>
              </div>
              <div class="col-sm-6">
                 <label>zip/postal code:</label>
                 <div class="form-group">
                    <input type="text" class="form-control form-control--sm" name="'.$request->type.'_zip_code" value="'.@$address->pincode.'" '.$disabled.'>
                 </div>
              </div>
           </div>   
            <div class="row mt-2">
                <div class="col-sm-6">
                    <label>Country:</label>
                    <div class="form-group select-wrapper" value="">
                        <select class="form-control form-control--sm" name="'.$request->type.'_country" '.$disabled.'>
                            <option value="">Select Country</option>
                            '.$allCountry.'
                        </select>
                    </div>            
                </div>
                <div class="col-sm-6">
                <label>City:</label>
                   <div class="form-group">
                      <input type="text" class="form-control form-control--sm" name="'.$request->type.'_city" value="'.@$address->city.'" '.$disabled.'>
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label>Address 1:</label>
                    <div class="form-group">
                      <input type="text" class="form-control form-control--sm" name="'.$request->type.'_address" value="'.@$address->Address.'" '.$disabled.'>
                    </div>
                </div>        
            </div>             
        </div>'.$checkbox.'';

        $messags['type'] = $request->type;
        $messags['erro'] = 101;
        $messags['data'] = $form;
        echo json_encode($messags);
    }
}
