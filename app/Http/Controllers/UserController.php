<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Config;
use DB;
use Mail;
use Redirect;
use Hash;
use DateTime;
use App\User;
use App\Countries;
use App\UserAddress;
use App\SellerSocialLink;
use App\SellerWorkingHour;
use App\BecomeSeller;
use App\Coupon;
use App\Product;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;


class UserController extends Controller
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

    protected function deleteOldCoverImage()
    {
        if (auth()->user()->cover_image) {
            Storage::delete('/public/profile/cover/' . auth()->user()->cover_image);
        }
    }

    public function profile()
    {

        $countries = Countries::select('id', 'name')->get();
        $address = UserAddress::GetCountries()
            ->where('userId', Auth::id())
            ->select('user_address.id', 'user_address.title', 'user_address.first_name', 'user_address.last_name', 'user_address.id', 'user_address.phone_no', 'user_address.Address', 'countries.name', 'countries.nicename')
            ->get();
        $links = SellerSocialLink::where('seller_id', Auth::user()->id)->get();
        $workingHours = SellerWorkingHour::where('seller_id', Auth::user()->id)->get();
        $estimatedDelivery = BecomeSeller::where('user_id', Auth::user()->id)
                                ->select('id', 'estimated_delivery')
                                ->get();
        $coupons = Coupon::where('user_id', Auth::user()->id)->get();
        $products = Product::where('user_id', Auth::user()->id)->where('status', 1)->get();
        $data = ['page_title' => 'My Profile | TJ', 'countries' => $countries, 'address' => $address, 'links' => $links, 'workingHours' => $workingHours, 'estimatedDelivery' => $estimatedDelivery, 'coupons' => $coupons, 'products' => $products];
        
        return view('user.profile', $data);
    }

    public function changePassword()
    {
        $data = ['page_title' => 'Change Password | TJ'];
        return view('user.change-password', $data);
    }



    public function updateProfile(Request $request)
    {
        $user_id = Auth::id();

        if (User::where('id', '=', $user_id)->exists()) {

            if (User::where('id', '!=', $user_id)->where('email', '=', $request->email)->exists()) {
                $messags['message'] = "Email address already exists.";
                $messags['erro'] = 202;
                echo json_encode($messags);
                die;
            } else {
                $update_result  = User::updateOrCreate(['id' => "$user_id"], ["name" => $request->name, "email" => $request->email, "phone_no" => $request->phone, "country_code" => $request->country_code]);

                $messags['message'] = "Profile update successfully.";
                $messags['erro'] = 101;
                echo json_encode($messags);
                die;
            }
        } else {
            $messags['message'] = "Error in update profile. Please try again.";
            $messags['erro'] = 202;
            echo json_encode($messags);
            die;
        }
    }

    public function updateAddress(Request $request)
    {


        UserAddress::where('id', $request->edit_address_id)
            ->update([
                'userId'        => Auth::user()->id,
                'title'         => $request->edit_address_title,
                'first_name'    => $request->edit_address_first_name,
                'last_name'     => $request->edit_address_last_name,
                'country_code'  => $request->edit_address_country_code,
                'phone_no'      => $request->edit_address_phone,
                'countryId'     => $request->edit_address_country,
                'pincode'       => $request->edit_address_pincode,
                'locality'      => $request->edit_address_locality,
                'Address'       => $request->edit_address_address,
                'city'          => $request->edit_address_city,
                'landmark'      => $request->edit_address_landmark
            ]);

        $messags['message'] = "Address Updated successfully.";
        $messags['erro'] = 101;
        echo json_encode($messags);
        die;
    }

    public function getSingleAddress(Request $request)
    {
        $messags = array();
        if (!empty($request->id)) {
            $address =  UserAddress::where('user_address.id', $request->id)->GetCountries()->where('userId', Auth::id())->first();
            $messags['message'] = "executed successfully";
            $messags['data'] = $address;
            $messags['erro'] = 101;
        } else {
            $messags['message'] = "Error in getting Address.Contact with administrator";
            $messags['erro'] = 202;
        }

        echo json_encode($messags);
        die;
    }

    public function addAddress(Request $request)
    {


        $addressId = UserAddress::insertGetId([
            'userId' => Auth::user()->id,
            'title' => $request->address_title,
            'first_name' => $request->address_first_name,
            'last_name' => $request->address_last_name,
            'country_code' => $request->address_country_code,
            'phone_no' => $request->address_phone,
            'countryId' => $request->address_country,
            'pincode' => $request->address_pincode,
            'locality' => $request->address_locality,
            'Address' => $request->address_address,
            'city' => $request->address_city,
            'landmark' => $request->address_landmark
        ]);


        $messags['message'] = "Address added successfully.";
        $messags['erro'] = 101;
        $messags['id'] = $addressId;
        echo json_encode($messags);
        die;
    }

    public function updatePassword(Request $request)
    {
        $messags = array();
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::user()) {
                if (!empty($data['current_password'])) {

                    if (!Hash::check($data['current_password'], Auth::user()->password)) {
                        $messags['message'] = "The current password you entered does not match our records, Please try again.";
                        $messags['erro'] = 202;
                        echo json_encode($messags);
                        die;
                    }
                } else {
                    $messags['message'] = "Current password is required.";
                    $messags['erro'] = 202;
                    echo json_encode($messags);
                    die;
                }

                if (!empty($data['new_password']) && empty($data['confirm_password'])) {
                    $messags['message'] = "Confirm password is required.";
                    $messags['erro'] = 202;
                } else if (!empty($data['confirm_password']) && empty($data['new_password'])) {
                    $messags['message'] = "New password is required.";
                    $messags['erro'] = 202;
                } else if (!empty($data['confirm_password']) && !empty($data['new_password'])) {
                    if ($data['confirm_password'] == $data['new_password']) {
                        $data['password'] = Hash::make($data['new_password']);
                        unset($data['confirm_password']);
                        unset($data['_token']);
                        $data = array_filter($data);
                        $admin = Auth::user();
                        $userid = $admin->id;
                        if (User::updateOrCreate(['id' => "$userid"], ['password' => Hash::make($data['new_password'])])) {
                            $messags['message'] = "Your password has been updated sucessfully.";
                            $messags['erro'] = 101;
                        } else {
                            $messags['message'] = "Error to update your password.";
                            $messags['erro'] = 202;
                        }
                    } else {
                        $messags['message'] = "Please enter confirm password same as new password.";
                        $messags['erro'] = 202;
                    }
                } else {

                    $messags['message'] = "Error to update password.";
                    $messags['erro'] = 202;
                }
            } else {
                $messags['message'] = "Error session has been expired.";
                $messags['erro'] = 202;
            }
        } else {
            return redirect('/login');
        }
        echo json_encode($messags);
        die;
    }

    public function removeAddress(Request $request)
    {
        $messags = array();
        if (!empty($request->id)) {
            $address = UserAddress::find($request->id);
            $address->delete();

            $messags['message'] = "Deleted successfully";
            $messags['erro'] = 101;
        } else {
            $messags['message'] = "Error while deleting this address.Please contact with site administrator.";
            $messags['erro'] = 202;
        }

        echo json_encode($messags);
        die;
    }

    public function updateProfileCoverImage(Request $request)
    {
        if ($request->file('file1')) {
            $image = $request->file('file1');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/profile/cover');
            $image->move($destinationPath, $imagename);
            $path1 = $imagename;
            $this->deleteOldCoverImage();
            if (Auth()->user()->update(['cover_image' => $path1])) {
                $img_url = url('public/profile/cover/') . '/' . $path1;
                echo json_encode(array('img' => $img_url, 'response' => 'Updated successfully', 'status' => 1));
            } else {
                echo json_encode(array('img' => '', 'response' => 'Error in Updation. Please try again later.', 'status' => 2));
            }
        }
    }

    public function updateProfileImage(Request $request)
    {
        if ($request->file('file1')) {
            $image = $request->file('file1');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/profile');
            $image->move($destinationPath, $imagename);
            $path1 = $imagename;
            $this->deleteOldCoverImage();
            if (Auth()->user()->update(['profile_image' => $path1])) {
                $img_url = url('public/profile/') . '/' . $path1;
                echo json_encode(array('img' => $img_url, 'response' => 'Updated successfully', 'status' => 1));
            } else {
                echo json_encode(array('img' => '', 'response' => 'Error in Updation. Please try again later.', 'status' => 2));
            }
        }
    }

    public function updateUserBio(Request $request)
    {
        if ($request->bio_text) {
            if (Auth()->user()->update(['bio' => $request->bio_text])) {
                $messags['message'] = "Updated successfully";
                $messags['erro'] = 101;
            } else {
                $messags['message'] = "Error while updating.Please try again.";
                $messags['erro'] = 202;
            }
        } else {
            $messags['message'] = "Please enter Bio.";
            $messags['erro'] = 202;
        }
        echo json_encode($messags);
        die;
    }
}
