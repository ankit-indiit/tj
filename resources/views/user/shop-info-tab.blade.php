<div class="row mt-4">
   <div class="col-12">
      <h4 class="text-xl mb-3 font-semibold">  Shop Image </h4>
      <div class="name-info">
        <div class="row">
            <div class="col-sm-9">
               @php $shopImage = ''; @endphp
               @foreach ($shopInfo as $shop)
                    @php $shopImage = $shop->image; @endphp
                    <div class="w-25">
                        <img src="{{$shop->image}}" >
                    </div>
               @endforeach
            </div>
            <div class="col-sm-3">
                <a href="javascript:void(0);" uk-toggle="target: #add-shop-image-modal" title="Add Shop Image">
                    <i class="fa fa-{{$shopImage == '' ? 'plus' : 'edit'}}" aria-hidden="true"></i>
                </a>  
            </div>
        </div>
      </div>
   </div>
</div>
<div class="row mt-4">
   <div class="col-12">
      <h4 class="text-xl mb-3 font-semibold">  Shop Category </h4>
      <div class="name-info">
        <div class="row">
            <div class="col-sm-9">
                @foreach ($shopCategories as $shopCategory)
                    <div class="row">
                        <div class="col-sm-9">               
                            <a href="#" class="name-fld">
                                <i class="fa fa-list-alt" aria-hidden="true"></i> 
                                {{$shopCategory->name}}
                            </a>
                        </div>                
                        <div class="col-sm-3">
                            <a href="javascript:void(0);" id="editShopCategory" data-id="{{$shopCategory->id}}" title="Edit Shop Image">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>  
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-3">
                <a href="javascript:void(0);" uk-toggle="target: #add-shop-category-modal" title="Add Shop Image">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>  
            </div>
        </div>
      </div>
   </div>
</div>
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
            @foreach ($shopInfo as $shop)
                <div class="col-sm-9">                
                   <a href="#" class="name-fld"><i class="fa fa-truck" aria-hidden="true"></i>
                   {{$shop->estimated_delivery}}</a>
                </div>
                @if ($shop->estimated_delivery == NULL)
                    <div class="col-sm-3">
                        <a href="javascript:void(0);" uk-toggle="target: #add-estimated-delivery" title="Add Estimated Delivery">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </a> 
                    </div>
                @else
                    <div class="col-sm-3">
                        <a href="javascript:void(0);" class="editEstimateDelevery" data-id="{{$shop->id}}" title="Edit Estimated Delivery">
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

<div id="add-shop-image-modal" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">{{$shopImage == '' ? 'Add' : 'Change'}} Shop Image</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="addShopImageForm" enctype="multipart/form-data" method="post">
            @csrf
            <div class="text-center px-4">                
                <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add to your shop </div>
                   <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                      <input type="file" id="shopImageUpload" name="shopImageUpload" style="visibility:hidden;" onchange="ValidateFileUpload('shopImageUpload','outputShopImage')">
                      <a href="#" onclick="$('#shopImageUpload').trigger('click'); return false;">
                         <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                         </svg>
                      </a>                      
                   </div>
                </div>
                <img id="outputShopImage">
             </div>
                <button type="submit" id="addShopImageBtn" class="btn btn-primary btn-sm mb-4">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="add-shop-category-modal" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">Shop Category</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="addShopCategoryForm" enctype="multipart/form-data" method="post">
            @csrf
            <div class="text-center px-4">                
                <div class="mx-4 my-4">
                    <input type="text" name="name" class="form-control border" placeholder="Enter Category Name">
                </div>
                <button type="submit" id="addShopCategoryBtn" class="btn btn-primary btn-sm mb-4">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="edit-shop-category-modal" class="create-post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
        <div class="text-center py-4 border-b">
           <h3 class="text-lg font-semibold" id="postTitle">Shop Category</h3>
           <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
           <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
        </div>
        <form id="updateShopCategoryForm" enctype="multipart/form-data" method="post">
            @csrf
            <div class="text-center px-4">                
                <div class="mx-4 my-4">
                    <input type="hidden" name="id" class="form-control border shop-category-id" placeholder="Enter Category Name">
                    <input type="text" name="name" class="form-control border shop-category" placeholder="Enter Category Name">
                </div>
                <button type="submit" id="updateShopCategoryBtn" class="btn btn-primary btn-sm mb-4">Add</button>
            </div>
        </form>
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
                <div class="row">
                  <div class="col-md-4">
                    <input type="number" class="form-control my-4 border estimate-day-to" placeholder="Estimate Day To" name="estimate_day_to">
                  </div>
                  <div class="col-md-1 pt-2">
                    <h5 class="pt-4">To</h5>
                  </div>
                  <div class="col-md-4">
                    <input type="number" class="form-control my-4 border estimated-day" placeholder="Estimated Day" name="estimated_day">
                  </div>
                  <div class="col-md-2 pt-2">
                    <h5 class="pt-4">Days</h5>
                  </div>
                </div>      
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
              <div class="row">
                <div class="col-md-4">
                  <input type="number" class="form-control my-4 border estimate-day-to" placeholder="Estimate Day To" name="estimate_day_to">
                </div>
                <div class="col-md-1 pt-2">
                  <h5 class="pt-4">To</h5>
                </div>
                <div class="col-md-4">
                  <input type="number" class="form-control my-4 border estimated-day" placeholder="Estimated Day" name="estimated_day">
                </div>
                <div class="col-md-2 pt-2">
                  <h5 class="pt-4">Days</h5>
                </div>
              </div>                
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
                <input type="text" class="form-control my-4 border" placeholder="Enter Coupon Title" name="title">
                <input type="text" class="form-control my-4 border" placeholder="Enter Coupon Description" name="description">
                <input type="text" class="form-control my-4 border" placeholder="Enter Coupon Type" name="type">
                <input type="text" class="form-control my-4 border" placeholder="Enter Coupon Expiry" name="expired_on">
                <input type="text" class="form-control my-4 border" placeholder="Enter Discounted Value" name="discounted-value">
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
