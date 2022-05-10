<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\BecomeSeller;
use App\User;
use App\SellerSocialLink;
use App\SellerWorkingHour;
use App\Coupon;
use App\ShopCategory;
use Auth;

class BecomeSellerController extends Controller
{
    public function index()
    {
        $data = ['page_title' => 'Feed | TJ'];
        return view('become-seller.seller-signup',$data);
    }

    public function sellerSignup(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $user = User::find(Auth::user()->id);        
        $becomeSeller = BecomeSeller::create($request->all());
        User::where('id', Auth::user()->id)->update(['switch_as' => 'seller']);
        $user->assignRole('seller');
        if ($becomeSeller) {
            return redirect('feed');
        }
    }

    public function switchAs(Request $request)
    {
        $switchStatus = User::where('id', Auth::user()->id)->pluck('switch_as')->first();
        if ($switchStatus == 'buyer') {
            $switchAs = 'seller';
        } else {
            $switchAs = 'buyer';
        }
        User::where('id', Auth::user()->id)->update([
            'switch_as' => $switchAs,
        ]);
        return redirect('feed');
    }


    public function addShopImage(Request $request)
    {
        if ($request->file('shopImageUpload')) {
            $image = $request->file('shopImageUpload');
            $imagename = time() . '_' . Auth::user()->id . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images');
            $image->move($destinationPath, $imagename);
            $image = $imagename;
        }
        BecomeSeller::where('user_id', Auth::user()->id)->update([
            'image' => $image,
        ]);

        $messags['message'] = "Shop image has been added!";
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function addShopCategory(Request $request)
    {
        $request['store_id'] = BecomeSeller::where('user_id', Auth::user()->id)->pluck('id')->first();
        ShopCategory::create($request->all());
        $messags['message'] = "Shop category has been added!";
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function editShopCategory(Request $request)
    {
        return ShopCategory::where('id', $request->shopCatId)->first();
    }

    public function updateShopCategory(Request $request)
    {
        ShopCategory::where('id', $request->id)->update([
            'name' => $request->name,
        ]);
        $messags['message'] = "Shop category has been updated!";
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function addSellerSocialLink(Request $request)
    {
        $request['seller_id'] = Auth::user()->id;
        SellerSocialLink::create($request->all());
        $messags['message'] = "Social link has been added!";
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function editSellerSocialLink(Request $request)
    {
        $link = SellerSocialLink::where('id', $request->linkId)->first();        
        return $link;
    }

    public function updateSellerSocialLink(Request $request)
    {
        $updateLink = SellerSocialLink::where('id', $request->id)->update([
            'social_icon' => $request->social_icon,
            'social_link' => $request->social_link,
        ]);        
        if ($updateLink) {
            $messags['message'] = "Social link has been updated!";
            $messags['erro'] = 101;
            echo json_encode($messags);
        }
    }

    public function addSellerWorkingHour(Request $request)
    {        
        $request['seller_id'] = Auth::user()->id;
        $sellerWorkingHour = SellerWorkingHour::create($request->all());
        $messags['message'] = "Working time has been added!";
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function editWorkingHour(Request $request)
    {
        $link = SellerWorkingHour::where('id', $request->workingHourId)->first();        
        return $link;
    }

    public function updateSellerWorkingHour(Request $request)
    {
        $updateLink = SellerWorkingHour::where('id', $request->id)->update([
            'day' => $request->day,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
        ]);        
        if ($updateLink) {
            $messags['message'] = "Working time has been updated!";
            $messags['erro'] = 101;
            echo json_encode($messags);
        }
    }

    public function addSellerEstimatedDelivery(Request $request)
    {
        BecomeSeller::where('user_id', Auth::user()->id)->update([
            'estimated_delivery' => $request->estimate_day_to.'-'.$request->estimated_day,
        ]);
        $messags['message'] = "Estimated Delivery has been added!";
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function editEstimateDelevery(Request $request)
    {
        $estimatedDelivery = BecomeSeller::where('id', $request->estimateDeleveryId)->pluck('estimated_delivery')->first();
        $estimateDay = explode("-", $estimatedDelivery);
        $day['from'] = $estimateDay[0];
        $day['till'] = $estimateDay[1];
        return $day;
    }

    public function updateEstimateDelevery(request $request)
    {
        BecomeSeller::where('user_id', Auth::user()->id)->update([
            'estimated_delivery' => $request->estimate_day_to.'-'.$request->estimated_day,
        ]);
        $messags['message'] = "Estimated Delivery has been Updated!";
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function addDiscountCoupon(request $request)
    {
        $request['user_id'] = Auth::user()->id;
        Coupon::create($request->all());
        $messags['message'] = "Coupon has been added!";
        $messags['erro'] = 101;
        echo json_encode($messags);
    }

    public function editDiscountCoupon(request $request)
    {
        $editedCoupon = Coupon::where('id', $request->editedCouponId)->first();
        return $editedCoupon;
    }

    public function updateDiscountCoupon(request $request)
    {
        Coupon::where('id', $request->id)->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'expired_on' => $request->expired_on,
            'discounted_value' => $request->discounted_value,
            'coupon_name' => $request->coupon_name,
        ]);
        $messags['message'] = "Coupon has been updated!";
        $messags['erro'] = 101;
        echo json_encode($messags);
    }
}
