@extends('layouts.app')
@section('content')
<div class="main_content timeline-page">
   <div class="mcontainer">
      <div class="profile user-profile bg-white rounded-2xl -mt-4">
         <div class="profiles_banner">
            <img src="{{ $shopDetails->image }}" alt="">
            <div class="profile_action absolute bottom-0 right-0 space-x-1.5 p-3 text-sm z-50 hidden lg:flex">               
            </div>
         </div>
         <div class="profiles_content">
            <div class="profile_avatar">
            </div>
            <div class="profile_info">
               <h1>{{ $shopDetails->shop_name }}</h1>
               Public group · {{$shopDetails->followers_count}} members
            </div>
         </div>
         <div class="flex justify-between lg:border-t flex-col-reverse lg:flex-row">
            <nav class="cd-secondary-nav pl-2 is_ligh -mb-0.5 border-transparent">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link " id="pics-tab" data-toggle="tab" href="#pics" role="tab" aria-controls="pics" aria-selected="true">Photos</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true">Products</a>
                  </li>                  
               </ul>
            </nav>
         </div>
      </div>
      <div class="tab-content">
         <div class="lg:flex lg:mt-8 mt-4 lg:space-x-8 tab-pane show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="space-y-5 flex-shrink-0 lg:w-7/12">
               @php $user_posts = user_posts($shopDetails->user_id); @endphp
                @if(count($user_posts) > 0)                  
                 @foreach($user_posts as $posts)
                      @if($posts->post_type == 1)
                          @include('layouts.templates.simplepost' , array('post'=>$posts))
                      @elseif(($posts->post_type == 2))
                          @include('layouts.templates.pollpost', array('post'=>$posts))
                      @endif
                  @endforeach
                  <div class="flex justify-center mt-6">
                     <a href="#" class="bg-white dark:bg-gray-900 font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                     Load more ..</a>
                  </div>
               @else
                  <div class="flex justify-center mt-6">
                     No post found
                  </div>
               @endif 
            </div>
            <div class="lg:w-4/12 space-y-6">
               <div class="widget mb-4 main-w">
                  <h4 class="text-2xl mb-2 font-semibold">Shop Information</h4>
                  <ul class="text-gray-600 space-y-4">
                     <li class="flex items-center space-x-2"> 
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                           {{ $shopDetails->location }} 
                     </li>
                     <li><i class="fa fa-map-o" aria-hidden="true"></i>
                        <a href="https://www.google.com/maps">
                           {{ $shopDetails->postal_code }}
                        </a> 
                     </li>
                  </ul>
               </div>
               <div class="widget border-t pt-4">
                  <div class="flex items-center justify-between mb-4">
                     <div>
                        <h4 class="text-2xl -mb-0.5 font-semibold"> Followers </h4>
                        <p> 3,4510 Friends</p>
                     </div>
                     <a href="{{ route('shop.follower', $shopDetails->id) }}" class="text-blue-600 ">See all</a>
                  </div>
                  <div class="grid grid-cols-3 gap-3 text-gray-600 font-semibold">
                     @foreach (getAllShopFollowers($shopDetails->id) as $member)
                        @php $userId= Crypt::encrypt($member->user_id); @endphp
                        <a href="{{ $member->user_id == Auth::user()->id ? route('my-profile') : route('time.line', $userId) }}">
                           <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                              <img src="{{ @show_user_image($member->user_id) }}" alt="" class="w-full h-full object-cover absolute">
                           </div>
                           <div>{{ show_user_name($member->user_id) }}</div>
                        </a>
                     @endforeach
                  </div>
                  <a href="{{ route('shop.follower', $shopDetails->id) }}" class="bg-gray-100 py-2.5 text-center font-semibold w-full mt-4 block rounded"> See all </a>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="pics" role="tabpanel" aria-labelledby="pics-tab">
            <div class="flex justify-between relative md:mb-4 mb-3">
               <div class="flex-1">
                  <h2 class="text-xl font-semibold mt-4"> Photos </h2>
                  <nav class="cd-secondary-nav border-b md:m-0 -mx-4">
                     <ul>
                        <li class="active"><a href="#" class="lg:px-2">  Photos of you  <span> 230</span> </a></li>
                     </ul>
                  </nav>
               </div>
            </div>
            <div class="grid md:grid-cols-4 grid-cols-2 gap-3 mt-5">
               @foreach ($shopPhotos as $shopPhoto)
                  <div>
                     <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                        <img src="{{ url("public/posts/images/$shopPhoto->image") }}" class="w-full h-full absolute object-cover inset-0">
                        <!-- overly-->
                        <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                     </div>
                  </div>
               @endforeach
                @foreach ($products as $product)
                  @php
                     $unSerlizeProImage = unserialize($product->image);
                     $productImage = reset($unSerlizeProImage);
                  @endphp
                  <div>
                     <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                        <img src="{{ url("public/images/product/$productImage") }}" class="w-full h-full absolute object-cover inset-0">
                        <!-- overly-->
                        <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>         
         <div class="tab-pane mt-5" id="list" role="tabpanel" aria-labelledby="list-tab">
            <div class="flex justify-between relative md:mb-4 mb-3 mt-5 border-b pb-3">
               <div class="flex-1">
                  <h2 class="text-xl font-semibold"> Products
                  </h2>
               </div>
               <div id="divcheck" style="display:none;">
                  <a href="#" class="is_link featured-btn pull-right"> Add to featured products </a>
               </div>
               <div class="wishlist-search">
                  <div class="header_search" aria-expanded="false">
                     <input value="" type="text" class="form-control" placeholder="Search " autocomplete="off">
                     <i class="uil-search-alt"></i>
                  </div>
               </div>
               @if ($shopDetails->user_id == Auth::user()->id)
                  <a href="{{ route('product.create') }}" class="is_link featured-btn pull-right"> Add product </a>
               @endif
               <div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="relative">
                     <div class="uk-slider-container px-1 py-3">
                        <div class="row">
                           @foreach ($products as $product)
                              @php
                                 $unSerlizeProImage = unserialize($product->image);
                                 $productImage = reset($unSerlizeProImage);
                              @endphp
                              <div class="col-sm-3">
                                 <div class="card">
                                    <div class="card-media h-44">
                                       <div class="card-media-overly"></div>
                                       <img src="{{ url("public/images/product/$productImage") }}" alt="">                                       
                                    </div>
                                    <div class="card-body">
                                       <a href="{{ route('product.detail', $product->slug) }}" class="ext-lg font-medium mt-1 t truncate">{{ $product->name }}</a>
                                       <div class="text-xs font-semibold uppercase text-yellow-500">${{$product->discounted_price}}</div>
                                       <div class="text-xs font-semibold ven-nam text-yellow-500">
                                          @foreach ($product->productCategoryId as $proCatId)
                                          <a href="{{ route('category.show', str_replace(' ', '-', strtolower(getProductCategoryNameById($proCatId->cat_id)))) }}">{{ getProductCategoryNameById($proCatId->cat_id) }}</a>
                                          @endforeach
                                       </div>
                                       <div class="ratings">
                                          <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane mt-5" id="featp" role="tabpanel" aria-labelledby="featp-tab">
            <div class="flex justify-between relative md:mb-4 mb-3 mt-5 border-b pb-3">
               <div class="flex-1">
                  <h2 class="text-xl font-semibold"> Featured Products
                  </h2>
               </div>
               <div id="divchecks" style="display:none;">
                  <a href="#" class="is_link featured-btn pull-right"> Remove featured products </a>
               </div>
               <div class="wishlist-search">
                  <div class="header_search" aria-expanded="false">
                     <input value="" type="text" class="form-control" placeholder="Search " autocomplete="off">
                     <i class="uil-search-alt"></i>
                  </div>
               </div>
               <div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="relative">
                     <div class="uk-slider-container px-1 py-3">
                        <div class="row">
                           <div class="col-sm-3">
                              <div class="card">
                                 <div class="card-media h-44">
                                    <div class="card-media-overly"></div>
                                    <img src="assets/images/tshert.png" alt="">
                                    <div class="product-list"> 
                                       <label class="cont">
                                       <input type="checkbox" class="checkmes">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                                    <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                                    <div class="text-xs font-semibold ven-nam text-yellow-500">
                                       <a href="shop-timeline.html">Forever 21</a>
                                    </div>
                                    <div class="ratings">
                                       <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="card">
                                 <div class="card-media h-44">
                                    <div class="card-media-overly"></div>
                                    <img src="assets/images/tshert.png" alt="">
                                    <div class="product-list"> 
                                       <label class="cont">
                                       <input type="checkbox" class="checkmes">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                                    <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                                    <div class="text-xs font-semibold ven-nam text-yellow-500">
                                       <a href="shop-timeline.html">Forever 21</a>
                                    </div>
                                    <div class="ratings">
                                       <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="card">
                                 <div class="card-media h-44">
                                    <div class="card-media-overly"></div>
                                    <img src="assets/images/tshert.png" alt="">
                                    <div class="product-list"> 
                                       <label class="cont">
                                       <input type="checkbox" class="checkmes">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <!--div class="-top-3 absolute bg-blue-100 font-medium px-2 py-1 right-2 rounded-full text text-blue-500 text-sm">
                                       $19.99
                                       </div-->
                                    <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                                    <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                                    <div class="text-xs font-semibold ven-nam text-yellow-500">
                                       <a href="shop-timeline.html">Forever 21</a>
                                    </div>
                                    <div class="ratings">
                                       <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="card">
                                 <div class="card-media h-44">
                                    <div class="card-media-overly"></div>
                                    <img src="assets/images/tshert.png" alt="">
                                    <div class="product-list"> 
                                       <label class="cont">
                                       <input type="checkbox" class="checkmes">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <!--div class="-top-3 absolute bg-blue-100 font-medium px-2 py-1 right-2 rounded-full text text-blue-500 text-sm">
                                       $19.99
                                       </div-->
                                    <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                                    <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                                    <div class="text-xs font-semibold ven-nam text-yellow-500">
                                       <a href="shop-timeline.html">Forever 21</a>
                                    </div>
                                    <div class="ratings">
                                       <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="card">
                                 <div class="card-media h-44">
                                    <div class="card-media-overly"></div>
                                    <img src="assets/images/tshert.png" alt="">
                                    <div class="product-list"> 
                                       <label class="cont">
                                       <input type="checkbox" class="checkmes">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <!--div class="-top-3 absolute bg-blue-100 font-medium px-2 py-1 right-2 rounded-full text text-blue-500 text-sm">
                                       $19.99
                                       </div-->
                                    <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                                    <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                                    <div class="text-xs font-semibold ven-nam text-yellow-500">
                                       <a href="shop-timeline.html">Forever 21</a>
                                    </div>
                                    <div class="ratings">
                                       <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="card">
                                 <div class="card-media h-44">
                                    <div class="card-media-overly"></div>
                                    <img src="assets/images/tshert.png" alt="">
                                    <div class="product-list"> 
                                       <label class="cont">
                                       <input type="checkbox" class="checkmes">
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <!--div class="-top-3 absolute bg-blue-100 font-medium px-2 py-1 right-2 rounded-full text text-blue-500 text-sm">
                                       $19.99
                                       </div-->
                                    <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                                    <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                                    <div class="text-xs font-semibold ven-nam text-yellow-500">
                                       <a href="shop-timeline.html">Forever 21</a>
                                    </div>
                                    <div class="ratings">
                                       <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="bio" role="tabpanel" aria-labelledby="bio-tab">
            <div class="flex justify-between relative md:mb-4 mb-3 mt-5 border-b pb-3">
               <div class="flex-1">
                  <h2 class="text-xl font-semibold"> Bio
                  </h2>
               </div>
               <div>
               </div>
            </div>
            <div class="row mt-4">
               <div class="col-8">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="profile-inp">
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Bio"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12"><a href="timeline-page.html" class=" flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                        Save Changes
                        </a><a href="timeline-page.html" class=" flex text-center items-center justify-center  gray-bg w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                        Cancel
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="update-post-modal" class="create-post" uk-modal>
      <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
         <div class="text-center py-4 border-b">
            <h3 class="text-lg font-semibold" id="postTitle">Simple Post</h3>
            <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
         </div>
         <form id="simplePostUpdateForm" enctype="multipart/form-data" method="post">
            @csrf
            <input type="hidden" value="1" name="postType">
            <input type="hidden" name="postId" id="editedPostId">
            <div class="flex flex-1 items-start space-x-4 p-5">
               <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-11 h-11">
               <div class="flex-1 pt-2">
                  <textarea name="post_content" id="edited_post_content" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="5" placeholder="What's Your Mind ?"></textarea>
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
                  <button type="submit" id="update_simple_post_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                     Post
                  </button>
                  <a href="javascript:void(0);" onclick="hideCurrentOpenModal('update-post-modal');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
                     Cancel </a>
               </div>
            </div>
         </form>
      </div>
   </div>
   <div id="disable-comment-confirm-box" class="create-post" uk-modal>
      <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
            <div class="text-center py-4 border-b">
                <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
            </div>
            <div class="main-txt">
                <h3 class="text-lg font-semibold">Are you sure you want to disable?</h3>
                <div class="space-x-2 buttons-yesno">
                    <a href="#" id="disablePostComment" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium"> Yes </a>
                    <a href="javascript:void(0);" onclick="$('#disable-comment-confirm-box').removeClass('uk-open').hide();" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm"> Cancel </a>
                </div>                   
            </div>
        </div>
   </div>
   <div id="enable-comment-confirm-box" class="create-post" uk-modal>
      <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
          <div class="text-center py-4 border-b">
              <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
          </div>
          <div class="main-txt">
              <h3 class="text-lg font-semibold">Are you sure you want to enable?</h3>
              <div class="space-x-2 buttons-yesno">
                  <a href="#" id="enablePostComment" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium"> Yes </a>
                  <a href="javascript:void(0);" onclick="$('#enable-comment-confirm-box').removeClass('uk-open').hide();" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm"> Cancel </a>
              </div>                   
          </div>
      </div>
   </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
$("#simplePostUpdateForm").validate({
   rules: {
      post_content: {
         required: true,
         minlength: 2
      }
   },
   messages: {
      post_content: "Please enter your Bio.",
   },
   submitHandler: function(forms, e) {
      e.preventDefault();
      var form = $('#simplePostUpdateForm')[0];
      var serializedData = new FormData(form);

      $("#update_simple_post_btn").attr("disabled", true);
      $('#update_simple_post_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         enctype: 'multipart/form-data',
         url: "{{ url('update-simple-post') }}",
         data: serializedData,
         dataType: 'json',
         processData: false,
         contentType: false,
         cache: false,
         success: function(data) {
            $("#update_simple_post_btn").attr("disabled", false);

            $('#update_simple_post_btn').html('Post');

            if (data.erro == '101') {
               clearImage('output_simple_post_image');
              
               UIkit.modal('#update-post-modal').hide();

               swal("", data.message, "success", {
                  button: "close",
               });

               $("#simplePostUpdateForm").trigger('reset');
               $('.swal-button--confirm').on('click', function(){
                  window.location.reload();
               });
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });                  
            }
         }
      });
      return false;
   }
});
</script>
@endsection