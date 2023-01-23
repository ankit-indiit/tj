@extends('layouts.app')
@section('content')
<div class="main_content timeline-page">
   <div class="mcontainer">
      <div class="profile user-profile bg-white rounded-2xl -mt-4">
         <div class="profiles_banner">
            <img id="coverImageUpdate" src="{{ url('public/profile/cover/') }}/{{ Auth::user()->cover_image ? Auth::user()->cover_image : 'download.png' }}" alt="" />
            <div class="profile_action absolute bottom-0 right-0 space-x-1.5 p-3 text-sm z-50 hidden lg:flex">
               <a href="javascript:void(0);" onclick="coverImageForm();" class="flex items-center justify-center h-8 px-3 rounded-md bg-gray-700 bg-opacity-70 text-white space-x-1.5">
                  <ion-icon name="create-outline" class="text-xl md hydrated" role="img" aria-label="create outline"></ion-icon>
                  <span> Edit </span>
               </a>
            </div>
         </div>
         <div class="profiles_content">
            <div class="profile_avatar">
               <div class="profile_avatar_holder">
                  <img class="user_profile_image" src="{{ show_user_image() }}" alt="" />
               </div>
               <!--div class="user_status status_online"></div-->
               <div class="icon_change_photo" onclick="profileImageForm();">
                  <ion-icon name="create-outline" class="text-xl md hydrated" role="img" aria-label="camera"></ion-icon>
               </div>
            </div>
            <div class="profile_info">
               <h1>{{ Auth::user()->name }}</h1>
            </div>
         </div>
         <div class="flex justify-between lg:border-t flex-col-reverse lg:flex-row">
            <nav class="cd-secondary-nav pl-2 is_ligh -mb-0.5 border-transparent">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Feed</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="user-pics-tab" data-toggle="tab" href="#user-photos" role="tab" aria-controls="user-photos" aria-selected="true">Photos</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="profile" aria-selected="false">Product</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active" id="collection-product-tab" data-toggle="tab" href="#collection-product" role="tab" aria-controls="collection-product" aria-selected="true">Collections</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="shopInfoTab" data-toggle="tab" href="#shopInfo" role="tab" aria-controls="shopInfo" aria-selected="false">Shop Info</a>
                  </li>
               </ul>
            </nav>
         </div>
      </div>
      <div class="tab-content">
         <div class="lg:flex lg:mt-8 mt-4 lg:space-x-8 tab-pane" id="home" role="tabpanel" aria-labelledby="home-tab">
            @include('user.feed-tab')
         </div>
         <div class="tab-pane" id="product" role="tabpanel" aria-labelledby="product-tab">
            @include('seller.product-tab')
         </div>
         <div class="tab-pane wishlist-page active" id="collection-product" role="tabpanel" aria-labelledby="collection-product-tab">
            <div class="row mt-4"> 
            <div class="col-sm-6"> 
              <h4 class="text-2xl mb-3 font-semibold ">
               <a href="{{ route('my-profile') }}#collection">Collection</a> / {{ str_replace('-', ' ', ucfirst(Request::segment(2))) }} 
              </h4>
           </div>
            </div>
            <div class="row first-page">
               @foreach ($collectionProducts as $collectionProduct)
               @php
                  $unSerlizeProImage = unserialize($collectionProduct->image);
                  $productImage = reset($unSerlizeProImage);
               @endphp
               <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                  <div class="card">
                     <div class="card-media h-44">
                        <div class="card-media-overly"></div>
                        <img src="{{ url("public/images/product/$productImage") }}" alt="">
                        <a href="#" class="bg-red-100 absolute right-2 top-2 p-0.5 px-1.5 rounded-full text-red-500">
                        <i class="icon-feather-heart"> </i>
                        </a>                                                          
                        <a href="javascript:void(0);" class="ad_to_colletion_btn" aria-expanded="false">
                           <i class="icon-feather-layers" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ count($collectionProduct->collections) > 0 ? 'Add to Collection' : 'No More Collection to add' }}"> </i>
                        </a>
                        @if (count($collectionProduct->collections) > 0)
                           <div class="bg-white w-56 main-df shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small main-ss" style="left: 0px! !important; top: 68px; width: 100%;">
                              <div class="sidebar_innersss" data-simplebar="init">
                                 <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                       <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                       <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                          <div class="simplebar-content" style="padding: 0px; height: auto; overflow: hidden;">
                                             <ul class="space-y-1 ">
                                                @foreach ($collectionProduct->collections as $collection)
                                                   <li>
                                                      <a href="javascript:void(0);" id="assignCollection" data-id="{{ $collection->id}}" data-product="{{$collectionProduct->id}}">
                                                         {{ $collection->name }}
                                                      </a>
                                                   </li>
                                                @endforeach
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                 </div>
                                 <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
                                 </div>
                                 <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
                                 </div>
                              </div>
                           </div>
                        @endif                                
                     </div>
                     <div class="card-body">
                        <a href="{{ route('product.detail', $collectionProduct->slug) }}" class="ext-lg font-medium mt-1 t truncate">{{ $collectionProduct->name }}</a>
                        <a href="cart.html" class="absolute right-2 top-2 p-0.5 px-1.5 text-red-500 cart-icon-main">
                        Add to Cart
                        </a>
                        <div class="text-xs font-semibold uppercase text-yellow-500">${{ $collectionProduct->price }}</div>
                        <div class="text-xs font-semibold ven-nam text-yellow-500">
                           @foreach ($collectionProduct->productCategoryId as $proCatId)
                              <a href="{{ route('category.show', str_replace(' ', '-', strtolower(getProductCategoryNameById($proCatId->cat_id)))) }}">
                                 {{ getProductCategoryNameById($proCatId->cat_id) }}
                              </a>
                           @endforeach
                        </div>
                        <div class="ratings">
                           {!! @showProductRating($collectionProduct->id) !!}
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
         <div class="tab-pane photos-page" id="user-photos" role="tabpanel" aria-labelledby="user-photos-tab">
            <div class="" style="margin-top: 42px;">
               <div class="row mt-4">
                  <div class="col-sm-3">
                     <h4 class="text-2xl mb-3 font-semibold">Photos</h4>
                  </div>
               </div>
               <div class="">
                  <div class="tab-pane active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                     <div class="row">
                        @foreach ($userPhotos as $userPhoto)
                        @if ($userPhoto != NULL)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                           <div class="overly">
                              <a href="http://localhost/dev/category/t-shirt">
                                 <img src="{{ url("public/posts/images/$userPhoto") }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                 </div>
                              </a>
                           </div>
                        </div>
                        @endif
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="shopInfo" role="tabpanel" aria-labelledby="shopInfoTab">
            @include('user.shop-info-tab')
         </div>
      </div>
   </div>
</div>
@endsection
@section('customModals')
<!-- Edit Address Modal -->
<div id="EditAddress-modal" class="create-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold">Edit Address</h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <div class="main-txt">
         <div class="card-body">
            <form method="POST" action="{{ url('update-address') }}" id="editAddressForm">
               @csrf
               <input type="hidden" name="edit_address_id" id="edit_address_id">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="profile-inp">
                        <input type="text" name="edit_address_title" class="form-control" id="edit_address_title" placeholder="Enter Address Title here" />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <input type="text" name="edit_address_first_name" class="form-control" id="edit_address_first_name" placeholder="Enter Your First Name" />
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <input type="text" name="edit_address_last_name" class="form-control" id="edit_address_last_name" placeholder="Enter Your Last Name" />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <input type="text" class="form-control" id="edit_address_pincode" name="edit_address_pincode" placeholder="Pincode" />
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <input type="text" class="form-control" name="edit_address_locality" id="edit_address_locality" placeholder="Locality" />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="profile-inp">
                        <textarea class="form-control" id="edit_address_address" name="edit_address_address" rows="2" placeholder="Address"></textarea>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <input type="text" class="form-control" id="edit_address_city" name="edit_address_city" placeholder="City" />
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <select name="edit_address_country" class="form-control" id="edit_address_country" placeholder="Country">
                           <option value="">-Country-</option>
                           @foreach($countries as $country)
                           <option value="{{ $country->id }}">{{ $country->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <input type="text" name="edit_address_landmark" class="form-control" id="edit_address_landmark" placeholder="Landmark(optional)" />
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <input id="edit_address_phone" type="tel" name="edit_address_phone" style="padding-left: 52px  !important;">
                        <input type="hidden" id="edit_address_country_code" name="edit_address_country_code" />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <button type="submit" id="update_address_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                     {{ __('Save Changes') }}
                     </button>
                     <a href="javascript:void(0);" onclick="hideCurrentOpenModal('EditAddress-modal');" class="flex text-center items-center justify-center gray-bg w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                     Cancel
                     </a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Edit Address Modal -->
<!-- upload cover Image Modal -->
<div id="editCoverImage" class="create-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <div class="main-txt">
         <div class="card-body">
            <div class="col-lg-12">
               <div class="form-group">
                  <label for="profilepicture" class="">Cover Image</label>
                  <form class="dropzone" id="editCoverImageForm" enctype="multipart/form-data" method="post">
                     @csrf
                     <div class="fallback">
                        <input name="cover_image" type="file" onChange="uploadFile()" id="cover_image" />
                     </div>
                     <progress style="display:none;" id="progressBar" value="0" max="100" style="width:300px;"></progress>
                     <h5 id="status" style="color: #25777c;font-weight: 600;"></h5>
                     <p id="loaded_n_total"></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--- upload cover Image Modal -->
<!-- upload cover Image Modal -->
<div id="editProfileImage" class="create-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <div class="main-txt">
         <div class="card-body">
            <div class="col-lg-12">
               <div class="form-group">
                  <label for="profilepicture" class="">Profile Image</label>
                  <form class="dropzone" id="editprofileImageForm" enctype="multipart/form-data" method="post">
                     @csrf
                     <div class="fallback">
                        <input name="profile_image" type="file" onChange="uploadProfileFile()" id="profile_image" />
                     </div>
                     <progress style="display:none;" id="progressBar1" value="0" max="100" style="width:300px;"></progress>
                     <h5 id="status1" style="color: #25777c;font-weight: 600;"></h5>
                     <p id="loaded_n_total1"></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--- upload cover Image Modal -->
<!-- Create post modal -->
<div id="create-post-modal" class="create-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold"> Simple Post </h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <form id="simplePostForm" enctype="multipart/form-data" method="post">
         @csrf
         <input type="hidden" value="1" name="postType">
         <div class="flex flex-1 items-start space-x-4 p-5">
            <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-11 h-11">
            <div class="flex-1 pt-2">
               <textarea name="post_content" id="post_content" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="5" placeholder="What's Your Mind ?"></textarea>
            </div>
         </div>
         <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add to your post </div>
               <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                  <input type="file" id="post_image_upload" name="post_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('post_image_upload','output_simple_post_image')">
                  <a href="#" onclick="$('#post_image_upload').trigger('click'); return false;">
                     <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                     </svg>
                  </a>
                  <svg class="text-red-600 h-9 p-1.5 rounded-full bg-red-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"> </path>
                  </svg>
                  <svg class="text-green-600 h-9 p-1.5 rounded-full bg-green-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                  </svg>
               </div>
            </div>
            <img id="output_simple_post_image" />
         </div>
         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">
               <button type="submit" id="add_simple_post_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
               Post
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('create-post-modal');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
               Cancel </a>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- Create post modal -->
<!-- create poll post modal -->
<div id="poll-post-modal" class="create-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold"> Poll Post </h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <form id="pollPostForm" enctype="multipart/form-data" method="post">
         @csrf
         <input type="hidden" value="2" name="postType">
         <div class="flex flex-1 items-start space-x-4 p-5">
            <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-11 h-11">
            <div class="flex-1 pt-2 small-textarea">
               <textarea name="poll_post_content" id="poll_post_content" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="5" placeholder="Enter Your Question?"></textarea>
            </div>
         </div>
         <div class="radio-bt">
            <ul>
               <li>
                  <input type="radio" id="f-option" name="selector">
                  <label for="f-option"><input type="text" name="pollButton1" id="pollButton1" class=" my-clas uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="1" placeholder="Option 1"></label>
                  <div class="check"></div>
               </li>
               <li>
                  <input type="radio" id="s-option" name="selector">
                  <label for="s-option"><input type="text" name="pollButton2" id="pollButton2" class=" my-clas uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="1" placeholder="Option 2"></label>
                  <div class="check">
                     <div class="inside"></div>
                  </div>
               </li>
            </ul>
         </div>
         <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add to your post </div>
               <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                  <input type="file" id="poll_image_upload" name="poll_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('poll_image_upload','output_poll_post_image')">
                  <a href="#" onclick="$('#poll_image_upload').trigger('click'); return false;">
                     <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                     </svg>
                  </a>
               </div>
            </div>
            <img id="output_poll_post_image" />
         </div>
         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">
               <button type="submit" id="add_poll_post_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
               Post
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('poll-post-modal');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
               Cancel </a>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- create poll post modal -->
<!-- create product-post-modal -->
<div id="product-post-modal" class="create-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold"> Post Listing </h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <form id="productPostForm" enctype="multipart/form-data" method="post">
         @csrf
         <input type="hidden" value="3" name="postType">
         <div class="flex flex-1 items-start space-x-4 p-5">
            <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-11 h-11">
            <div class="flex-1 pt-2">
               <textarea name="product_post_content" id="product_post_content" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="2" placeholder="Add Product Details"></textarea>
            </div>
         </div>
         <div class="bsolute bottom-0 p-4 pb-0 space-x-4 w-full flex flex-1 items-start">
            <div class="form-group">
               <label class="sr-only" for="exampleInputAmount">Amount (in Swiss Francs)</label>
               <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i>
                  </div>
                  <input type="number" min="0.00" step="0.05" id="product_price" name="product_price" class="form-control" placeholder="Price">
               </div>
            </div>
         </div>
         <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add to your post </div>
               <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                  <input type="file" id="product_image_upload" name="product_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('product_image_upload','output_product_post_image')">
                  <a href="#" onclick="$('#product_image_upload').trigger('click'); return false;">
                     <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                     </svg>
                  </a>
                  <svg class="text-red-600 h-9 p-1.5 rounded-full bg-red-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"> </path>
                  </svg>
               </div>
            </div>
            <img id="output_product_post_image" />
         </div>
         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">
               <button type="submit" id="add_product_post_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
               Add Listing
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('product-post-modal');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
               Cancel </a>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- create product-post-modal -->
<div id="add-product-category-modal" class="create-post main-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold">Add Category</h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <form id="addProductCategoryForm" enctype="multipart/form-data" method="post">
         @csrf
         <div class="flex flex-1 items-start space-x-4 p-5">
            <div class="flex-1 pt-2 small-textarea">
               <textarea name="name" id="name" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="5" placeholder="Enter Category Name"></textarea>
            </div>
         </div>
         <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add Category Image </div>
               <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                  <input type="file" id="feature_image" name="feature_image" style="visibility:hidden;" onchange="ValidateFileUpload('feature_image','product_category_image');">
                  <a href="#" onclick="$('#feature_image').trigger('click'); return false;">
                     <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                     </svg>
                  </a>
               </div>
            </div>
            <img id="product_category_image" />
         </div>
         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">
               <button type="submit" id="addProductCategoryBtn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
               Add
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('add-product-category-modal');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
               Cancel </a>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/custom-shop-info.js') }}"></script>
@endsection