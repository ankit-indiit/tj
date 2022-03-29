<div class="row mt-4">
   <div class="col-12">
      <h4 class="text-xl mb-3 font-semibold">  Social Links </h4>
      <div class="name-info">
        <div class="row">
            <div class="col-sm-9">
                @foreach ($links as $link)                    
                    <div class="row my-2">
                        <div class="col-sm-9">
                               <i class="fa fa-{{$link->social_icon}}" aria-hidden="true"></i>
                               <a href="{{$link->social_link}}" target="_blank" class="name-fld">{{$link->social_link}}</a>
                        </div>
                        <div class="col-sm-3">
                           <a href="javascript:void(0);" class="editSocialLink" data-id="{{$link->id}}" title="Edit Social Link">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a> 
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-3">
                <a href="javascript:void(0);" uk-toggle="target: #add-social-link-modal" title="Add Social Link">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>  
            </div>
        </div>
      </div>
   </div>
</div>
<div class="row mt-4">
   <div class="col-12">
        <h4 class="text-xl mb-3 font-semibold">  Working Hours </h4>
        <div class="name-info">
            <div class="row">
                <div class="col-sm-9">
                    @foreach($workingHours as $workingHour)
                        <div class="row">
                            <div class="col-sm-9">                                
                                <i class="fa fa-clock-o" aria-hidden="true"></i> {{ ucfirst($workingHour->day) }} : {{$workingHour->open_time}} to {{$workingHour->close_time}}
                            </div>
                            <div class="col-sm-3">
                                <a href="javascript:void(0);" class="editWorkingHour" data-id="{{ $workingHour->id }}" title="Edit Working Hour">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>  
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-3">
                    <a href="javascript:void(0);" uk-toggle="target: #add-working-hour-modal" title="Add Social Link">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a> 
                </div>
            </div>
        </div>
   </div>
</div>
<div class="row mt-4">
   <div class="col-12">
      <h4 class="text-xl mb-3 font-semibold"> Estimated Delivery </h4>
      <div class="name-info">
        <div class="row">
            @foreach ($estimatedDelivery as $delivery)
                <div class="col-sm-9">                
                   <a href="#" class="name-fld"><i class="fa fa-truck" aria-hidden="true"></i>
                   {{$delivery->estimated_delivery}}</a>
                </div>
                @if ($delivery->estimated_delivery == NULL)
                    <div class="col-sm-3">
                        <a href="javascript:void(0);" uk-toggle="target: #add-estimated-delivery" title="Add Estimated Delivery">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </a> 
                    </div>
                @else
                    <div class="col-sm-3">
                        <a href="javascript:void(0);" class="editEstimateDelevery" data-id="{{$delivery->id}}" title="Edit Estimated Delivery">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a> 
                    </div>
                @endif
            @endforeach
        </div>
      </div>
   </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <h4 class="text-xl mb-3 font-semibold"> Discount Coupon </h4>
        <div class="name-info">
            <div class="row">
                <div class="col-sm-10">
                    @foreach ($coupons as $coupon)
                        <div class="row py-4">
                            <div class="col-sm-4">
                               <div id="carbonads"><span><span class="carbon-wrap"><a href="#" class="carbon-img" target="_blank" rel="noopener sponsored">
                                  <img src="{{ asset('images/coupan-img.jpg') }}" alt="ads via Carbon" border="0" height="100" width="130" style="max-width: 130px;"></a>
                                  <a href="#" class="carbon-text" target="_blank" rel="noopener sponsored">{{ $coupon->description }}</a></span><br>
                                  <a href="#" class="carbon-poweredby" target="_blank" rel="noopener sponsored">{{ $coupon->expired_on }}</a></span>
                               </div>
                            </div>
                            <div class="col-sm-4">
                                <a href="javascript:void(0);" class="editDiscountCoupon" id="edit-discount-coupon" data-id="{{ $coupon->id }}" title="Edit Discount Coupony">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a> 
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-2">
                    <a href="javascript:void(0);" class="addDiscountCoupon" uk-toggle="target: #add-discount-coupon" title="Add Discount Coupony">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a> 
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add-social-link-modal" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">Social Link</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="addSellerSocialLink" method="post">
            @csrf
            <div class="text-center px-4">
                <select class="form-control my-4" name="social_icon">
                    <option value="">Select Social Icon</option>
                    <option value="facebook" class="{{ checkIfSociaLinknExist(Auth::user()->id, 'Facebook') == 1 ? 'd-none' : ''}}" >Facebook</option>
                    <option value="instagram" class="{{ checkIfSociaLinknExist(Auth::user()->id, 'Instagram') == 1 ? 'd-none' : ''}}">Instagram</option>
                    <option value="twitter" class="{{ checkIfSociaLinknExist(Auth::user()->id, 'Twitter') == 1 ? 'd-none' : ''}}">Twitter</option>
                </select>
                <input type="text" class="form-control mb-4 border" placeholder="Enter Link" name="social_link">
                <button type="submit" id="addSocialLinkBtn" class="btn btn-primary btn-sm mb-4">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="edit-social-link-modal" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">Update Social Link</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="updateSellerSocialLink" method="post">
            @csrf
            <div class="text-center px-4">
                <input type="hidden" name="id" class="link-id">
                <select class="form-control my-4 social-icon" name="social_icon">
                    <option value="">Select Social Icon</option>
                    <option value="facebook">Facebook</option>
                    <option value="instagram">Instagram</option>
                    <option value="twitter">Twitter</option>
                </select>
                <input type="text" class="form-control mb-4 border social-link" placeholder="Enter Link" name="social_link">
                <button type="submit" id="updateSocialLinkBtn" class="btn btn-primary btn-sm mb-4">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="add-working-hour-modal" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">Add Working Hours</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="addSellerWorkingHours" method="post">
            @csrf
            <div class="text-center px-4">
                <input type="hidden" name="id" class="link-id">
                <select class="form-control my-4 social-icon" name="day">
                    <option value="">Select Day</option>
                    <option value="monday" class="{{ checkIfWorkingDayExist(Auth::user()->id, 'Monday') == 1 ? 'd-none' : ''}}">Monday</option>                    
                    <option value="tuesday" class="{{ checkIfWorkingDayExist(Auth::user()->id, 'Tuesday') == 1 ? 'd-none' : ''}}">Tuesday</option>                    
                    <option value="wednesday" class="{{ checkIfWorkingDayExist(Auth::user()->id, 'Wednesday') == 1 ? 'd-none' : ''}}">Wednesday</option>                    
                    <option value="thursday" class="{{ checkIfWorkingDayExist(Auth::user()->id, 'Thursday') == 1 ? 'd-none' : ''}}">Thursday</option>                    
                    <option value="friday" class="{{ checkIfWorkingDayExist(Auth::user()->id, 'Friday') == 1 ? 'd-none' : ''}}">Friday</option>                    
                    <option value="saturday" class="{{ checkIfWorkingDayExist(Auth::user()->id, 'Saturday') == 1 ? 'd-none' : ''}}">Saturday</option>                    
                    <option value="sunday" class="{{ checkIfWorkingDayExist(Auth::user()->id, 'Sunday') == 1 ? 'd-none' : ''}}">Sunday</option>                    
                </select>
                <input type="text" class="form-control border mb-4" placeholder="Enter Open Time" name="open_time">
                <input type="text" class="form-control border mb-4" placeholder="Enter Close Time" name="close_time">                
                <button type="submit" id="sellerWorkingHoursBtn" class="btn btn-primary btn-sm mb-4">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="edit-working-hour-modal" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">Update Working Hours</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="updateSellerWorkingHour" method="post">
            @csrf
            <div class="text-center px-4">
                <input type="hidden" name="id" class="working-id">
                <select class="form-control my-4 working-day" name="day">
                    <option value="">Select Day</option>
                    <option value="monday">Monday</option>                    
                    <option value="tuesday">Tuesday</option>                    
                    <option value="wednesday">Wednesday</option>                    
                    <option value="thursday">Thursday</option>                    
                    <option value="friday">Friday</option>                    
                    <option value="saturday">Saturday</option>                    
                    <option value="sunday">Sunday</option>
                </select>
                <input type="text" class="form-control mb-4 border open-time" placeholder="Enter Link" name="open_time">
                <input type="text" class="form-control mb-4 border close-time" placeholder="Enter Link" name="close_time">
                <button type="submit" id="updateWorkingHourBtn" class="btn btn-primary btn-sm mb-4">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="add-estimated-delivery" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">Add Estimated Delivery</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="addSellerEstimatedDelivery" method="post">
            @csrf
            <div class="text-center px-4">
                <input type="text" class="form-control my-4 border estimated-delivery" placeholder="Enter Estimated Delivery" name="estimated_delivery">
                <button type="submit" id="addSellerEstimatedDeliveryBtn" class="btn btn-primary btn-sm mb-4">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="edit-estimated-delivery" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">Update Estimated Delivery</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="editSellerEstimatedDelivery" method="post">
            @csrf
            <div class="text-center px-4">
                <input type="text" class="form-control my-4 border estimated-delivery" placeholder="Enter Estimated Delivery" name="estimated_delivery">
                <button type="submit" id="editSellerEstimatedDeliveryBtn" class="btn btn-primary btn-sm mb-4">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="add-discount-coupon" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">Add Coupon</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="addDiscountCoupon" method="post">
            @csrf
            <div class="text-center px-4">
                <input type="text" class="form-control my-4 border coupon-name" placeholder="Enter Coupon Name" name="coupon_name">
                <input type="text" class="form-control my-4 border coupon-title" placeholder="Enter Coupon Title" name="title">
                <input type="text" class="form-control my-4 border coupon-description" placeholder="Enter Coupon Description" name="description">
                <input type="text" class="form-control my-4 border coupon-type" placeholder="Enter Coupon Type" name="type">
                <input type="text" class="form-control my-4 border coupon-expired-on" placeholder="Enter Coupon Expiry" name="expired_on">
                <input type="text" class="form-control my-4 border coupon-discounted-value" placeholder="Enter Discounted Value" name="discounted-value">
                <button type="submit" id="addDiscountCouponBtn" class="btn btn-primary btn-sm mb-4">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="edit-discount-coupon-modal" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">Update Coupon</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="updateDiscountCoupon" method="post">
            @csrf
            <div class="text-center px-4">
                <input type="hidden" name="id" class="coupon-id">
                <input type="text" class="form-control my-4 border coupon-name" placeholder="Enter Coupon Name" name="coupon_name">
                <input type="text" class="form-control my-4 border coupon-title" placeholder="Enter Coupon Title" name="title">
                <input type="text" class="form-control my-4 border coupon-description" placeholder="Enter Coupon Description" name="description">
                <input type="text" class="form-control my-4 border coupon-type" placeholder="Enter Coupon Type" name="type">
                <input type="text" class="form-control my-4 border coupon-expired-on" placeholder="Enter Coupon Expiry" name="expired_on">
                <input type="text" class="form-control my-4 border coupon-discounted-value" placeholder="Enter Discounted Value" name="discounted_value">
                <button type="submit" id="updateDiscountCouponBtn" class="btn btn-primary btn-sm mb-4">Update</button>
            </div>
        </form>
    </div>
</div>
