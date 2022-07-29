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
         @if (Auth::user()->switch_as == 'seller')
         <div class="flex justify-between lg:border-t flex-col-reverse lg:flex-row">
            <nav class="cd-secondary-nav pl-2 is_ligh -mb-0.5 border-transparent">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link {{ request()->tab == 'feed' ? 'active' : '' }}" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Feed</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="user-pics-tab" data-toggle="tab" href="#user-photos" role="tab" aria-controls="user-photos" aria-selected="true">Photos</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link {{ request()->tab == 'product' ? 'active' : '' }}" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="profile" aria-selected="false">Product</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="collection-tab" data-toggle="tab" href="#collectionTab" role="tab" aria-controls="collectionTab" aria-selected="true">Collections</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="shopInfoTab" data-toggle="tab" href="#shopInfo" role="tab" aria-controls="shopInfo" aria-selected="false">Shop Info</a>
                  </li>
               </ul>
            </nav>
         </div>
         @else
         <div class="flex justify-between lg:border-t flex-col-reverse lg:flex-row">
            <nav class="cd-secondary-nav pl-2 is_ligh -mb-0.5 border-transparent">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Feed</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="user-pics-tab" data-toggle="tab" href="#user-photos" role="tab" aria-controls="user-photos" aria-selected="true">Photos</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="messages-tab" data-toggle="tab" href="#userFriends" role="tab" aria-controls="userFriends" aria-selected="false">Friends</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="wish-tab" data-toggle="tab" href="#wish" role="tab" aria-controls="wish" aria-selected="false">Wishlist </a>
                  </li>                  
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Info</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="user-bio-tab" data-toggle="tab" href="#userBio" role="tab" aria-controls="userBio" aria-selected="false">My Bio</a>
                  </li>
               </ul>
            </nav>
         </div>
         @endif   
      </div>
      <div class="tab-content">
         <div class="lg:flex lg:mt-8 mt-4 lg:space-x-8 tab-pane {{ request()->tab == 'feed' ? 'active' : '' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
            @include('user.feed-tab')
         </div>
         <div class="tab-pane {{ request()->tab == 'profile' ? 'active' : '' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @include('user.my-info-tab')
         </div>
         <div class="tab-pane {{ request()->tab == 'product' ? 'active' : '' }}" id="product" role="tabpanel" aria-labelledby="product-tab">
            @include('seller.product-tab')
         </div>
         <div class="tab-pane {{ request()->tab == 'user-friends' ? 'active' : '' }}" id="userFriends" role="tabpanel" aria-labelledby="messages-tab">
            <!-- post header-->
            <div class="row mt-4">
               <div class="col-sm-3">
                  <h4 class="text-2xl mb-3 font-semibold">Friends</h4>
               </div>
               <div class="col-sm-9 pull-right">
                  <a href="#" class="text-black">
                     <div class="header_search" aria-expanded="false">
                        <input value="" type="text" class="form-control" placeholder="Search for Friends.." autocomplete="off" />
                        <i class="uil-search-alt"></i>
                     </div>
                  </a>
                  <div class="flex pull-right">
                     <a href="#" aria-expanded="false"> <i class="diff-icon icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
                     <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">
                        <a href="#" class="flex items-center px-3 py-2 text-black-500 hover:bg-gray-100 hover:text-gray-500 rounded-md dark:hover:bg-red-600 p-4">
                        <b>Select Audience</b>
                       {{--  @php
                           echo '<pre>';
                           print_r(userFriends(Auth::id()));
                        @endphp --}}
                        </a>
                        <ul class="space-y-1">
                           <li class="{{ Auth::user()->privacy == 'friends' ? 'privacy' : '' }}">
                              <a href="{{ route('privacy', 'friends') }}" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                              <i class="fa fa-users" aria-hidden="true"></i>
                              Friends
                              </a>
                           </li>
                           <li class="{{ Auth::user()->privacy == 'public'  ? 'privacy': '' }}">
                              <a href="{{ route('privacy', 'public') }}" class="flex items-center py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                              <i class="fa fa-globe" aria-hidden="true"></i>
                              Public
                              </a>
                           </li>
                           <li class="{{ Auth::user()->privacy == 'only_me' ? 'privacy' : '' }}">
                              <a href="{{ route('privacy', 'only_me') }}" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600"> <i class="fa fa-lock" aria-hidden="true"></i> Only Me </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               @foreach (userFriends() as $friend)
                  @php $userId= Crypt::encrypt($friend); @endphp
                  <div class="col-sm-6">
                     <div class="flex justify-between items-center lg:p-4 p-2.5">
                        <div class="flex flex-1 items-center space-x-4">
                           <a href="{{ $friend == Auth::user()->id ? route('my-profile') : route('time.line', $userId) }}">
                           <img src="{{ show_user_image($friend) }}" class="bg-gray-200 border border-white rounded-full w-10 h-10" />
                           </a>
                           <div class="flex-1 font-semibold capitalize">
                              <a href="{{ $friend == Auth::user()->id ? route('my-profile') : route('time.line', $userId) }}" class="text-black">{{ show_user_name($friend) }}</a>
                           </div>
                        </div>
                        <div>
                           <a href="#" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
                           <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">
                              <ul class="space-y-1">
                                 <li></li>
                                 <li>
                                    <a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="{{ $friend }}" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600"> <i class="uil-trash-alt mr-1"></i> Unfriend </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
         <div class="tab-pane" role="tabpanel" aria-labelledby="pics-tab">
            <div class="flex justify-between relative md:mb-4 mb-3">
               <div class="flex-1">
                  <h2 class="text-xl font-semibold mt-4">Photos</h2>
                  <nav class="cd-secondary-nav border-b md:m-0 -mx-4">
                     <ul>
                        <li class="active">
                           <a href="#" class="lg:px-2"> Photos of you <span> 230</span> </a>
                        </li>
                        <li><a href="#" class="lg:px-2"> Recently added </a></li>
                     </ul>
                  </nav>
               </div>
            </div>
            <div class="grid md:grid-cols-4 grid-cols-2 gap-3 mt-5">
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-1.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-2.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-3.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-4.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-4.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-4.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-1.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-2.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="a{{ asset('images/post/img-3.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-2.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-3.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
               <div>
                  <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                     <img src="{{ asset('images/post/img-2.jpg') }}" class="w-full h-full absolute object-cover inset-0" />
                     <!-- overly-->
                     <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane {{ request()->tab == 'wish' ? 'active' : '' }} wishlist-page" id="wish" role="tabpanel" aria-labelledby="wish-tab">
            <div class="" style="margin-top: 42px;">
               <div class="row mt-4">
                  <div class="col-sm-3">
                     <h4 class="text-2xl mb-3 font-semibold">Wishlist</h4>
                  </div>
               </div>
               <div class="">
                  <div class="tab-pane active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                     <div class="row">
                        @foreach ($wishlistedProducts as $wishlistedProduct)
                        @php
                        $unSerlizeProImage = unserialize($wishlistedProduct->image);
                        $productImage = reset($unSerlizeProImage);
                        @endphp
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                           <div class="card">
                              <div class="card-media h-44">
                                 <div class="card-media-overly"></div>
                                 <img src="{{ url("public/images/product/$productImage") }}" alt="" />
                                 <div class="main-tools" style="display: inline-block;" data-toggle="tooltip" data-placement="top" title="Add to Collection">
                                    <a class="remove" href="#" aria-expanded="false"><i class="icon-feather-more-horizontal"></i> </a>
                                    <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop main-ss uk-drop-bottom-right" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small main-ss" style="left: -182px; top: -5.99998px;">
                                       <div class="sidebar_innersss" data-simplebar="init">
                                          <div class="simplebar-wrapper" style="margin: 0px;">
                                             <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer"></div>
                                             </div>
                                             <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                   <div class="simplebar-content" style="padding: 0px; height: auto; overflow: hidden;">
                                                      <ul class="space-y-1">
                                                         <li>
                                                            Add to Collection
                                                         </li>
                                                         <li>Remove From Wishlist</li>
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
                                             <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: hidden; height: 42px;"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <a href="{{ route('product.detail', $wishlistedProduct->slug) }}" class="ext-lg font-medium mt-1 t truncate">{{ $wishlistedProduct->name }}</a>
                                    {!! productCartButton($wishlistedProduct->id) !!}
                                 <div class="text-xs font-semibold uppercase text-yellow-500">${{ $wishlistedProduct->price }}</div>
                                 <div class="text-xs font-semibold ven-nam text-yellow-500">
                                    @foreach ($wishlistedProduct->productCategoryId as $proCatId)
                                    <a href="{{ route('category.show', str_replace(' ', '-', strtolower(getProductCategoryNameById($proCatId->cat_id)))) }}">
                                    {{ getProductCategoryNameById($proCatId->cat_id) }}
                                    </a>
                                    @endforeach 
                                 </div>
                                 <div class="ratings">
                                    {!! @showProductRating($wishlistedProduct->id) !!}
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
                  <div class="tab-pane" id="profile-1" role="tabpanel" aria-labelledby="profile-tabz">
                     <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3">
                           <div class="card">
                              <div class="card-media h-44">
                                 <div class="card-media-overly"></div>
                                 <img src="{{ asset('images/tshert.png') }}" alt="" />
                              </div>
                              <div class="card-body">
                                 <!--div class="-top-3 absolute bg-blue-100 font-medium px-2 py-1 right-2 rounded-full text text-blue-500 text-sm">
                                    $19.99
                                    </div-->
                                 <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                                 <a href="cart.html" class="absolute right-2 top-2 p-0.5 px-1.5 text-red-500 cart-icon-main">
                                 Add to Cart
                                 </a>
                                 <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                                 <div class="text-xs font-semibold ven-nam text-yellow-500">
                                    <a href="shop-timeline.html">Forever 21</a>
                                 </div>
                                 <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                           <div class="card">
                              <div class="card-media h-44">
                                 <div class="card-media-overly"></div>
                                 <img src="{{ asset('images/tshert.png') }}" alt="" />
                              </div>
                              <div class="card-body">
                                 <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                                 <a href="cart.html" class="absolute right-2 top-2 p-0.5 px-1.5 text-red-500 cart-icon-main">
                                 Add to Cart
                                 </a>
                                 <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                                 <div class="text-xs font-semibold ven-nam text-yellow-500">
                                    <a href="shop-timeline.html">Forever 21</a>
                                 </div>
                                 <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                           <div class="card">
                              <div class="card-media h-44">
                                 <div class="card-media-overly"></div>
                                 <img src="{{ asset('images/tshert.png') }}" alt="" />
                              </div>
                              <div class="card-body">
                                 <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                                 <a href="cart.html" class="absolute right-2 top-2 p-0.5 px-1.5 text-red-500 cart-icon-main">
                                 Add to Cart
                                 </a>
                                 <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                                 <div class="text-xs font-semibold ven-nam text-yellow-500">
                                    <a href="shop-timeline.html">Forever 21</a>
                                 </div>
                                 <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane {{ request()->tab == 'user-photos' ? 'active' : '' }} photos-page" id="user-photos" role="tabpanel" aria-labelledby="user-photos-tab">
            <div class="tab-pane active" id="pics" role="tabpanel" aria-labelledby="pics-tab">
               <div class="flex justify-between relative md:mb-4 mb-3">
                  <div class="flex-1">
                     <h2 class="text-xl font-semibold mt-4"> Photos </h2>
                     <nav class="cd-secondary-nav border-b md:m-0 -mx-4">
                        <ul>
                           <li class="active"><a href="#" class="lg:px-2">  Photos of you  <span> {{ count($userPhotos) }}</span> </a></li>
                        </ul>
                     </nav>
                  </div>
               </div>
               <div class="grid md:grid-cols-4 grid-cols-2 gap-3 mt-5">
                  @foreach ($userPhotos as $userPhoto)
                     @if ($userPhoto != NULL)
                        <div>
                           <div id="photosOfYou" class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                              <img src="{{ url("public/posts/images/$userPhoto") }}" class="w-full h-full absolute object-cover inset-0">
                              <!-- overly-->
                              <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                           </div>
                        </div>
                     @endif
                  @endforeach
               </div>
            </div>            
         </div>
         <div class="tab-pane {{ request()->tab == 'collection-tab' ? 'active' : '' }} wishlist-page" id="collectionTab" role="tabpanel" aria-labelledby="collection-tab">
            <div class="" style="margin-top: 42px;">
               <div class="row mt-4">
                  <div class="col-sm-12">
                     <div class="flex justify-between relative md:mb-4 mb-3 pb-3">
                        <div class="flex-1">
                           <h2 class="text-xl font-semibold">Collections</h2>
                        </div>
                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('seller'))
                        <a href="#" class="is_link featured-btn pull-right" data-toggle="modal" data-target="#exampleModal"> Add Collection </a>
                        @endif
                     </div>
                     <!-- Modal -->
                     <div class="modal main-prod fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Add Collection</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">×</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="">Collection Name</label>
                                       <input type="text" class="form-control" placeholder="Enter Collection Name" />
                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="profilepicture" class="">Cover Image</label>
                                       <form action="#" method="post" class="dropzone" id="myDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                          <div class="fallback">
                                             <input name="file" type="file" />
                                          </div>
                                          <div class="dz-message needsclick">
                                             <i class="fa fa-upload" aria-hidden="true"></i>
                                             <h4>Drop files here or click to upload.</h4>
                                          </div>
                                       </form>
                                       <!-- Preview -->
                                       <div class="dropzone-previews mt-3" id="file-previews"></div>
                                       <div class="d-none" id="uploadPreviewTemplate">
                                          <div class="card mt-1 mb-0 shadow-none border">
                                             <div class="p-2">
                                                <div class="row align-items-center">
                                                   <div class="col-auto">
                                                      <img data-dz-thumbnail="" src="#" class="avatar-sm rounded bg-light" alt="" />
                                                   </div>
                                                   <div class="col pl-0">
                                                      <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name=""></a>
                                                      <p class="mb-0" data-dz-size=""></p>
                                                   </div>
                                                   <div class="col-auto">
                                                      <!-- Button -->
                                                      <a href="#" class="btn btn-link btn-lg text-muted" data-dz-remove="">
                                                      <i class="mdi mdi-close"></i>
                                                      </a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="button" class="btn btn-primary">Add</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div></div>
                  </div>
               </div>
               <div class="row first-page">
                  @foreach ($collections as $collection)
                  <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
                     <a href="{{ route('my-profile', $collection->slug) }}">
                        <div class="overly">
                           <img src="{{ url("public/collection/$collection->feature_image") }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                           <div class="pt-2">
                              <h4 class="text-lg font-semibold">{{ $collection->name }}</h4>
                           </div>
                        </div>
                     </a>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>        
         <div class="tab-pane {{ request()->tab == 'user-bio' ? 'active' : '' }}" id="userBio" role="tabpanel" aria-labelledby="user-bio-tab">
            @include('user.bio-tab')
         </div>
         <div class="tab-pane {{ request()->tab == 'shop-info' ? 'active' : '' }}" id="shopInfo" role="tabpanel" aria-labelledby="shopInfoTab">
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
         <h3 class="text-lg font-semibold">Simple Post</h3>
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
                  <a href="#" onclick="$('#post_image_upload').trigger('click'); return false;">
                     <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                     </svg>
                  </a>     
                  <a href="#" onclick="$('#post_video_upload').trigger('click'); return false;">
                    <svg class="text-red-600 h-9 p-1.5 rounded-full bg-red-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"> </path>
                    </svg>
                  </a>

                  {{-- <svg class="text-green-600 h-9 p-1.5 rounded-full bg-green-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                  </svg> --}}
               </div>
            </div>
            <input type="file" id="post_image_upload" name="post_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('post_image_upload','output_simple_post_image')">
            <input type="file" id="post_video_upload" name="post_video_upload" style="visibility:hidden;" onchange="ValidateFileUpload('post_video_upload','output_simple_post_video')" accept="video/mp4,video/x-m4v,video/*">
            <img id="output_simple_post_image" />
            <video id="output_simple_post_video"></video>
         </div>
         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">
               <button type="submit" id="add_simple_post_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                  Post
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('create-post-modal', 'output_simple_post_image');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
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
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('poll-post-modal', 'output_poll_post_image');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
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
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('product-post-modal', 'output_product_post_image');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
               Cancel </a>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- create product-post-modal -->
<!--- create suggestion-post-modal--->
<div id="suggestions-post-modal" class="create-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold"> Suggestions </h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <form id="suggestionPostForm" enctype="multipart/form-data" method="post">
         @csrf
         <input type="hidden" value="4" name="postType">
         <div class="flex flex-1 items-start space-x-4 p-5">
            <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-11 h-11">
            <div class="flex-1 pt-2">
               <textarea name="suggestion_post_content" id="suggestion_post_content" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="4" placeholder="Ask for any Question"></textarea>
            </div>
         </div>
         <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add to your post </div>
               <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                  <input type="file" id="suggestion_image_upload" name="suggestion_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('suggestion_image_upload','output_suggestion_post_image')">
                  <a href="#" onclick="$('#suggestion_image_upload').trigger('click'); return false;">
                     <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                     </svg>
                  </a>
               </div>
            </div>
            <img id="output_suggestion_post_image" />
         </div>
         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">
               <button type="submit" id="add_suggestion_post_btn" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium">
               Ask for suggestions
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('suggestions-post-modal', 'output_suggestion_post_image');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
               Cancel </a>
            </div>
         </div>
      </form>
   </div>
</div>
<!--- create suggestion-post-modal--->
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
<script>
   $(document).ready(function() {
      const phoneInputField = document.querySelector("#phone");
      const phoneInput = window.intlTelInput(phoneInputField, {
         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
      });
   
      var country = $('#country_code');
      var input = $('#phone');
      var iti = intlTelInput(input.get(0))
   
      // listen to the telephone input for changes
      input.on('countrychange', function(e) {
         // change the hidden input value to the selected country code
         country.val(iti.getSelectedCountryData().iso2);
      });
   
   
      const phoneInputField1 = document.querySelector("#address_phone");
      const phoneInput1 = window.intlTelInput(phoneInputField1, {
         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
      });
   
      var country1 = $('#address_country_code');
      var input1 = $('#address_phone');
      var iti1 = intlTelInput(input1.get(0))
   
      // listen to the telephone input for changes
      input1.on('countrychange', function(e) {
         // change the hidden input value to the selected country code
         country1.val(iti1.getSelectedCountryData().iso2);
      });
   
   
      const phoneInputField2 = document.querySelector("#edit_address_phone");
      const phoneInput2 = window.intlTelInput(phoneInputField2, {
         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
      });
   
      var country2 = $('#edit_address_country_code');
      var input2 = $('#edit_address_phone');
      var iti1 = intlTelInput(input2.get(0))
   
      // listen to the telephone input for changes
      input2.on('countrychange', function(e) {
         // change the hidden input value to the selected country code
         country2.val(iti1.getSelectedCountryData().iso2);
      }); 
   
      $("#updateProfileForm").validate({
         rules: {
            name: {
               required: true,
               minlength: 2
            },
            phone: {
               required: "true",
               number: true
            },
            email: {
               required: true,
               email: true
            }
         },
         messages: {
            name: "Please enter your name",
            phone: {
               required: "Please provide your phone number",
               number: "only numeric values are allowed"
            },
            email: "Please enter a valid email address"
         },
         submitHandler: function(form) {
            var serializedData = $(form).serialize();
            $("#err_mess").html('');
            $('#upd_profile_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
               headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
               },
               type: 'post',
               url: "{{ url('update-profile') }}",
               data: serializedData,
               dataType: 'json',
               success: function(data) {
                  $('#upd_profile_btn').html('Save Changes');
   
                  if (data.erro == '101') {
                     swal("", data.message, "success", {
                        button: "close",
                     });
                     $("#updateProfileForm").trigger('reset');
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
   
      $("#addAddressForm").validate({
         rules: {
            address_first_name: {
               required: true,
               minlength: 2
            },
            address_pincode: {
               required: true
            },
            address_title: {
               required: true
            },
            address_locality: {
               required: true
            },
            address_country: {
               required: true
            },
            address_address: {
               required: true
            },
            address_phone: {
               required: true,
               number: true
            },
         },
         messages: {
            address_first_name: "Please enter first name",
            address_phone: {
               required: "Please provide your phone number",
               number: "only numeric values are allowed"
            },
            address_pincode: "Please enter a valid pincode",
            address_title: "Please enter address title",
            address_locality: "Please enter locality",
            address_address: "Please enter Address",
            address_country: "Please select atleast one country"
   
         },
         submitHandler: function(form) {
            var serializedData = $(form).serialize();
            $("#err_mess").html('');
            $("#add_address_btn").attr("disabled", true);
            $('#add_address_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
               headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
               },
               type: 'post',
               url: "{{ url('add-address') }}",
               data: serializedData,
               dataType: 'json',
               success: function(data) {
                  $("#add_address_btn").attr("disabled", false);
   
                  $('#add_address_btn').html('Save Changes');
   
                  if (data.erro == '101') {
                     var Title = $('#address_title').val();
                     var FirstName = $('#address_first_name').val();
                     var LastName = $('#address_last_name').val();
                     var Pincode = $('#address_pincode').val();
                     var Locality = $('#address_locality').val();
                     var Address = $('#address_address').val();
                     var City = $('#address_city').val();
                     var Country = $('#address_country').find('option:selected').text();
                     var Phone = $('#address_phone').val();
                     var CountryCode = $('#address_country_code').val();
                     var Landmark = $('#address_landmark').val();
   
   
                     swal("", data.message, "success", {
                        button: "close",
                     });
                     $("#addAddressForm").trigger('reset');
   
                     let addedData = '<div id="editAddress_' + data.id + '"><div class="row" style="margin-top: 14px;"> <div class="col-sm-12"><span class="badge badge-secondary">' + Title + '</span></div> </div> <div class="row"> <div class="col-sm-4"> <a href="#" class="name-fld"><b>' + FirstName + ' ' + LastName + '</b></a> </div> <div class="col-sm-8 pull-right"> <a href="#" class="pull-right" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a> <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop"uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small"> <ul class="space-y-1"> <li></li> <li> <a href="#"  onclick="openEditAddressModal(' + data.id + ')" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800"> <i class="uil-edit-alt mr-1"></i> Edit Address </a> </li> <li> <hr class="-mx-2 my-2 dark:border-gray-800" /> </li> <li> <a href="javascript:void(0);" onclick="deleteAddress(' + data.id + ')"  class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600"> <i class="uil-trash-alt mr-1"></i> Delete </a> </li> </ul> </div> </div> </div> <div class="row"> <div class="col-sm-4"> <a href="javascript:void(0);" class="name-fld">' + Phone + '</a> </div> </div> <div class="row"> <div class="col-sm-4"> <a href="javascript:void(0);" class="name-fld">' + Address + ', ' + Country + '</a> </div> </div><hr /></div>';
   
                     $('#addressList').append(addedData);
   
                     $('#addAddressButton').trigger('click');
   
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
   
      $("#editAddressForm").validate({
         rules: {
            edit_address_first_name: {
               required: true,
               minlength: 2
            },
            edit_address_pincode: {
               required: true
            },
            edit_address_title: {
               required: true
            },
            edit_address_locality: {
               required: true
            },
            edit_address_country: {
               required: true
            },
            edit_address_address: {
               required: true
            },
            edit_address_phone: {
               required: true,
               number: true
            },
         },
         messages: {
            edit_address_first_name: "Please enter first name",
            edit_address_phone: {
               required: "Please provide your phone number",
               number: "only numeric values are allowed"
            },
            edit_address_pincode: "Please enter a valid pincode",
            edit_address_title: "Please enter address title",
            edit_address_locality: "Please enter locality",
            edit_address_address: "Please enter Address",
            edit_address_country: "Please select atleast one country"
   
         },
         submitHandler: function(form) {
            var serializedData = $(form).serialize();
            $("#err_mess").html('');
            $("#update_address_btn").attr("disabled", true);
            $('#update_address_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
               headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
               },
               type: 'post',
               url: "{{ url('update-address') }}",
               data: serializedData,
               dataType: 'json',
               success: function(data) {
                  $("#update_address_btn").attr("disabled", false);
   
                  $('#update_address_btn').html('Save Changes');
   
                  if (data.erro == '101') {
   
                     var editTitle = $('#edit_address_title').val();
                     var editFirstName = $('#edit_address_first_name').val();
                     var editLastName = $('#edit_address_last_name').val();
                     var editPincode = $('#edit_address_pincode').val();
                     var editLocality = $('#edit_address_locality').val();
                     var editAddress = $('#edit_address_address').val();
                     var editCity = $('#edit_address_city').val();
                     var editCountry = $('#edit_address_country').find('option:selected').text();
                     var editPhone = $('#edit_address_phone').val();
                     var editCountryCode = $('#edit_address_country_code').val();
                     var editLandmark = $('#edit_address_landmark').val();
                     var editAddressId = $('#edit_address_id').val();
   
   
                     UIkit.modal('#EditAddress-modal').hide();
                     swal("", data.message, "success", {
                        button: "close",
                     });
                     $("#editAddressForm").trigger('reset');
   
   
   
   
                     let updatedData = '<div class="row" style="margin-top: 14px;"> <div class="col-sm-12"><span class="badge badge-secondary">' + editTitle + '</span></div> </div> <div class="row"> <div class="col-sm-4"> <a href="#" class="name-fld"><b>' + editFirstName + ' ' + editLastName + '</b></a> </div> <div class="col-sm-8 pull-right"> <a href="#" class="pull-right" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a> <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop"uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small"> <ul class="space-y-1"> <li></li> <li> <a href="#"  onclick="openEditAddressModal(' + editAddressId + ')" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800"> <i class="uil-edit-alt mr-1"></i> Edit Address </a> </li> <li> <hr class="-mx-2 my-2 dark:border-gray-800" /> </li> <li> <a href="javascript:void(0);" onclick="deleteAddress(' + editAddressId + ')"  class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600"> <i class="uil-trash-alt mr-1"></i> Delete </a> </li> </ul> </div> </div> </div> <div class="row"> <div class="col-sm-4"> <a href="javascript:void(0);" class="name-fld">' + editPhone + '</a> </div> </div> <div class="row"> <div class="col-sm-4"> <a href="javascript:void(0);" class="name-fld">' + editAddress + ', ' + editCountry + '</a> </div> <hr /></div>';
   
                     $('#editAddress_' + editAddressId).html(updatedData);
   
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
   
      $("#updateBioForm").validate({
         rules: {
            bio_text: {
               required: true,
               minlength: 2
            }
         },
         messages: {
            bio_text: "Please enter your Bio.",
         },
         submitHandler: function(form) {
            var serializedData = $(form).serialize();
            $("#upd_bio_btn").attr("disabled", true);
            $('#upd_bio_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
               headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
               },
               type: 'post',
               url: "{{ url('update-user-bio') }}",
               data: serializedData,
               dataType: 'json',
               success: function(data) {
                  $("#upd_bio_btn").attr("disabled", false);
   
                  $('#upd_bio_btn').html('Save Changes');
   
                  if (data.erro == '101') {
                     swal("", data.message, "success", {
                        button: "close",
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
   
      $("#simplePostForm").validate({
         rules: {
            post_content: {
               required: true,
               minlength: 2
            }
         },
         messages: {
            post_content: "Please enter post description!",
         },
         submitHandler: function(forms, e) {
            e.preventDefault();
            var form = $('#simplePostForm')[0];
            var serializedData = new FormData(form);
   
            $("#add_simple_post_btn").attr("disabled", true);
            $('#add_simple_post_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
               headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
               },
               type: 'post',
               enctype: 'multipart/form-data',
               url: "{{ url('add-simple-post') }}",
               data: serializedData,
               dataType: 'json',
               processData: false,
               contentType: false,
               cache: false,
               success: function(data) {
                  $("#add_simple_post_btn").attr("disabled", false);
   
                  $('#add_simple_post_btn').html('Post');
   
                  if (data.erro == '101') {
                     clearImage('output_simple_post_image');
                    
                     UIkit.modal('#create-post-modal').hide();
   
                     swal("", data.message, "success", {
                        button: "close",
                     });
   
                     $("#simplePostForm").trigger('reset');
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
   
      $("#simplePostUpdateForm").validate({
         rules: {
            post_content: {
               required: true,
               minlength: 2
            }
         },
         messages: {
            post_content: "Please enter post description!",
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
                    
                     UIkit.modal('#create-post-modal').hide();
   
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
   
   
      $("#pollPostForm").validate({
         rules: {
            poll_post_content: {
               required: true,
               minlength: 2
            },
            pollButton1: {
               required: true,
            },
            pollButton2: {
               required: true,
            }
         },
         messages: {
            poll_post_content: "Please enter your question.",
            pollButton1: "Please enter button name.",
            pollButton2: "Please enter button name.",
         },
         submitHandler: function(forms,e) {
            e.preventDefault();
            var form = $('#pollPostForm')[0];
            var serializedData = new FormData(form);
            //var serializedData = $(form).serialize();
            $("#add_poll_post_btn").attr("disabled", true);
            $('#add_poll_post_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
               headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
               },
               enctype: 'multipart/form-data',
               type: 'post',
               url: "{{ url('add-poll-post') }}",
               data: serializedData,
               dataType: 'json',
               processData: false,
               contentType: false,
               cache: false,
               success: function(data) {
                  $("#add_poll_post_btn").attr("disabled", false);
   
                  $('#add_poll_post_btn').html('Post');
   
                  if (data.erro == '101') {
                     UIkit.modal('#poll-post-modal').hide();
                      clearImage('output_poll_post_image');
                     swal("", data.message, "success", {
                        button: "close",
                     });
   
                     $("#pollPostForm").trigger('reset');
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
   
   
   
      $("#productPostForm").validate({
         rules: {
            product_post_content: {
               required: true,
               minlength: 2
            },
            product_price: {
               required: true,
            }
         },
         messages: {
            product_post_content: "Please enter product name.",
            product_price: "Please enter product price."
         },
         submitHandler: function(form,e) {
            e.preventDefault();
            var form = $('#productPostForm')[0];
            var serializedData = new FormData(form);
            //var serializedData = $(form).serialize();
            $("#add_product_post_btn").attr("disabled", true);
            $('#add_product_post_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
               headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
               },
               type: 'post',
               url: "{{ url('add-product-post') }}",
               data: serializedData,
               dataType: 'json',
               processData: false,
               contentType: false,
               cache: false,
               success: function(data) {
                  $("#add_product_post_btn").attr("disabled", false);
   
                  $('#add_product_post_btn').html('Post');
   
                  if (data.erro == '101') {
                     clearImage('output_product_post_image');
                     UIkit.modal('#product-post-modal').hide();
                     swal("", data.message, "success", {
                        button: "close",
                     });
   
                     $("#productPostForm").trigger('reset');
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
   
      $("#suggestionPostForm").validate({
         rules: {
            suggestion_post_content: {
               required: true,
               minlength: 2
            }
         },
         messages: {
            suggestion_post_content: "Please enter your question.",
         },
         submitHandler: function(form,e) {
             e.preventDefault();
            var form = $('#suggestionPostForm')[0];
            var serializedData = new FormData(form);
           // var serializedData = $(form).serialize();
            $("#add_suggestion_post_btn").attr("disabled", true);
            $('#add_suggestion_post_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
               headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
               },
               type: 'post',
               url: "{{ url('add-suggestion-post') }}",
               data: serializedData,
               dataType: 'json',
               processData: false,
               contentType: false,
               cache: false,
               success: function(data) {
                  $("#add_suggestion_post_btn").attr("disabled", false);
   
                  $('#add_suggestion_post_btn').html('Post');
   
                  if (data.erro == '101') {
                     UIkit.modal('#suggestions-post-modal').hide();
                     clearImage('output_suggestion_post_image');
                     swal("", data.message, "success", {
                        button: "close",
                     });
   
                     $("#suggestionPostForm").trigger('reset');
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
   });
   
   var _validFileExtensions = ['.jpg', 'png', 'jpeg', 'gif'];
   var validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg'];
   
   function openEditAddressModal(addressId) {
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: "{{ url('get-single-address') }}",
         data: {
            id: addressId
         },
         dataType: 'json',
         success: function(data) {
            if (data.erro == '101') {
               let addressData = data.data;
   
               $('#edit_address_title').val(addressData.title);
               $('#edit_address_first_name').val(addressData.first_name);
               $('#edit_address_last_name').val(addressData.last_name);
               $('#edit_address_pincode').val(addressData.pincode);
               $('#edit_address_locality').val(addressData.locality);
               $('#edit_address_address').val(addressData.Address);
               $('#edit_address_city').val(addressData.city);
               $('#edit_address_country').val(addressData.countryId);
               $('#edit_address_phone').val(addressData.phone_no);
               $('#edit_address_country_code').val(addressData.country_code);
               $('#edit_address_landmark').val(addressData.landmark);
               $('#edit_address_id').val(addressId);
   
               UIkit.modal('#EditAddress-modal').show();
            }
         }
      });
   }
   
   function deleteAddress(addressId) {
      UIkit.modal.confirm('Are you sure you want to delete this Address?').then(function() {
         $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: "{{ url('remove-address') }}",
            data: {
               id: addressId
            },
            dataType: 'json',
            success: function(data) {
               if (data.erro == '101') {
                  swal("", data.message, "success", {
                     button: "close",
                  });
                  $('#editAddress_' + addressId).remove();
   
               } else {
                  swal("", data.message, "error", {
                     button: "close",
                  });
               }
            }
         });
         console.log('Confirmed.')
      }, function() {
         console.log('Rejected.')
      });
   }
   
   function profileImageForm() {
      UIkit.modal('#editProfileImage').show();
   }
   
   function uploadProfileFile() {
      var file = _("profile_image").files[0];
   
      if (!validImageTypes.includes(file.type)) {
         $('#erre_mess').html("Sorry, Uploaded file is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
         return false;
      }
   
      var formdata = new FormData();
      formdata.append("file1", file);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler1, false);
      ajax.addEventListener("load", completeHandler1, false);
      ajax.addEventListener("error", errorHandler, false);
      ajax.addEventListener("abort", abortHandler, false);
      ajax.open("POST", "{{ url('updateProfileImage') }}");
      ajax.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
      ajax.responseType = 'json';
      ajax.send(formdata);
   }
   
   function progressHandler1(event) {
      $('#progressBar1').show();
      _("loaded_n_total1").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
      var percent = (event.loaded / event.total) * 100;
      _("progressBar1").value = Math.round(percent);
   
      if (Math.round(percent) == '100' || Math.round(percent) == 100) {
         _("status1").innerHTML = "File uploaded. We are generating report now...";
      } else {
         _("status1").innerHTML = Math.round(percent) + "% uploaded... please wait";
      }
   
   }
   
   function completeHandler1(event) {
      $('#progressBar1').hide();
      $('#loaded_n_total1').hide();
      if (event.target.response.img == '') {
         swal("", event.target.response.response, "error", {
            button: "close",
         });
      } else {
         $(".user_profile_image").attr("src", event.target.response.img);
         UIkit.modal('#editProfileImage').hide();
         swal("", event.target.response.response, "success", {
            button: "close",
         });
      }
   
      setTimeout(function() {
         $('#status1').html("");
      }, 5000);
   
      _("progressBar1").value = 0; //wil clear progress bar after successful upload
   }
   
   function coverImageForm() {
      UIkit.modal('#editCoverImage').show();
   }
   
   function uploadFile() {
      var file = _("cover_image").files[0];
   
      if (!validImageTypes.includes(file.type)) {
         $('#erre_mess').html("Sorry, Uploaded file is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
         return false;
      }
   
      var formdata = new FormData();
      formdata.append("file1", file);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler, false);
      ajax.addEventListener("load", completeHandler, false);
      ajax.addEventListener("error", errorHandler, false);
      ajax.addEventListener("abort", abortHandler, false);
      ajax.open("POST", "{{ url('updateProfileCoverImage') }}");
      ajax.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
      ajax.responseType = 'json';
      ajax.send(formdata);
   
   
   }
   
   function progressHandler(event) {
      $('#progressBar').show();
      _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
      var percent = (event.loaded / event.total) * 100;
      _("progressBar").value = Math.round(percent);
   
      if (Math.round(percent) == '100' || Math.round(percent) == 100) {
         _("status").innerHTML = "File uploaded. We are generating report now...";
      } else {
         _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
      }
   
   }
   
   function completeHandler(event) {
      $('#progressBar').hide();
      $('#loaded_n_total').hide();
      if (event.target.response.img == '') {
         swal("", event.target.response.response, "error", {
            button: "close",
         });
      } else {
         $("#coverImageUpdate").attr("src", event.target.response.img);
         UIkit.modal('#editCoverImage').hide();
         swal("", event.target.response.response, "success", {
            button: "close",
         });
      }
   
      setTimeout(function() {
         $('#status').html("");
      }, 5000);
   
      _("progressBar").value = 0; //wil clear progress bar after successful upload
   }
   
   function errorHandler(event) {
      swal("", 'Upload Failed', "error", {
         button: "close",
      });
   }
   
   function abortHandler(event) {
      swal("", 'Upload Aborted', "error", {
         button: "close",
      });
   }
   
   function _(el) {
      return document.getElementById(el);
   }
   
   
   function ValidateFileUpload(fileId, previewId) {
     
      var fuData = document.getElementById(fileId);
      var FileUploadPath = fuData.value;
      //To check if user upload any file
      if (FileUploadPath == '') {
         // swal("", 'Please upload an image', "error", {
         //    button: "close",
         // });
      } else {
         var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
         //The file uploaded is an image

         if (Extension == "gif" || Extension == "png" || Extension == "bmp" ||
            Extension == "jpeg" || Extension == "jpg"|| Extension == "mp4"|| Extension == "x-mp4") {

            // To Display
            if (fuData.files && fuData.files[0]) {
               var reader = new FileReader();

               reader.onload = function(e) {
                  var output = document.getElementById(previewId);
                  output.style.height = '150px';
                  output.style.width = '150px';
                  output.style.padding = '10px';
                  output.src = e.target.result;
               }

               reader.readAsDataURL(fuData.files[0]);
            }

         }
         //The file upload is NOT an image
         else {
            swal("", 'Photo only allows file types of GIF, PNG, JPG, JPEG and BMP.', "error", {
               button: "close",
            });
         }
      }
   }     
   
   $("#addProductCategoryForm").validate({
   rules: {
     name: {
        required: true
     },
     feature_image: {
        required: true
     }
   },
   messages: {
     name: "Please enter category name",
     feature_image: "Please choose category image"
   },
   submitHandler: function(forms, e) {
     e.preventDefault();
     var form = $('#addProductCategoryForm')[0];
     var serializedData = new FormData(form);
    
     $("#addProductCategoryBtn").attr("disabled", true);
     $('#addProductCategoryBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
     $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        enctype: 'multipart/form-data',
        url: "{{ url('add-product-category') }}",
        data: serializedData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
           $("#addProductCategoryBtn").attr("disabled", false);
   
           $('#addProductCategoryBtn').html('Post');
   
           if (data.erro == '101') {
              clearImage('product_category_image');
             
              UIkit.modal('#add-product-category-modal').hide();
   
              swal("", data.message, "success", {
                 button: "close",
              });
   
              $("#addProductCategoryForm").trigger('reset');
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