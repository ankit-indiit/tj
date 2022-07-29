<div
   class="lg:w-72 w-full"
   style="
      -webkit-transition: all 300ms 0s ease-in-out;
      transition: all 300ms 0s ease-in-out;
      position: fixed;
      background-color: white;
      height: 100%;
      width: 300px;
      z-index: 11;
      padding-bottom: 30px;
      overflow: hidden;
      top: 62px;
      right: 10px;
   "
>
   <div class="">
      <div class="tab-cart">
         <div class="contact-list header_dropdown">
            <nav class="cd-secondary-nav border-b extanded mb-2">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Cart</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Wishlist</a>
                  </li>
               </ul>
            </nav>
            <div class="tab-content">
               <div class="lg:flex lg:mt-8 mt-4 lg:space-x-8 tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div uk-drop="mode: click" class="header_dropdown dropdown_cart uk-drop uk-open uk-drop-bottom-right" style="left: -168.262px; top: 40px;">
                     <ul class="dropdown_cart_scrollbar" data-simplebar="init">
                        <div class="simplebar-wrapper" style="margin: 0px -10px 0px 0px;">
                           <div class="simplebar-height-auto-observer-wrapper">
                              <div class="simplebar-height-auto-observer"></div>
                           </div>
                           <div class="simplebar-mask">
                              <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
                                 <div class="simplebar-content" style="padding: 0px 10px 0px 0px; height: auto; overflow: hidden scroll;">
                                    @php $cartTotalPrice = 0; @endphp
                                    @foreach ($cartItems as $cartItem)
                                    @php
                                       @$cartTotalPrice = $cartTotalPrice + $cartItem->product_price;
                                    @endphp   
                                       <li class="cart-product-list{{$cartItem->id}}">
                                          <div class="cart_avatar">
                                             <img src="{{ $cartItem->product_image }}" alt="" />
                                          </div>
                                          <div class="cart_text">
                                             <div class="font-semibold leading-4 mb-1.5 text-base line-clamp-1">{{ $cartItem->product_name }}</div>
                                             <p class="text-sm">Type Accessories</p>
                                          </div>
                                          <div class="cart_price">
                                             <span>${{ $cartItem->product_price }}</span>
                                             <button href="javascript:void(0);" id="removeToCart" data-id="{{ $cartItem->id }}" class="type">Remove</button>
                                          </div>
                                       </li>
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                           <div class="simplebar-placeholder" style="width: 351px; height: 497px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                           <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                           <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: visible; height: 354px;"></div>
                        </div>
                     </ul>

                     <div class="cart_footer">
                        @if (count($cartItems) > 0)
                           <a href="{{ route('cart') }}" class="is_link become-sel"> Go to Cart </a>
                           <h1>Total : <strong> $ {{ $cartTotalPrice }}</strong></h1>
                        @else
                           <p class="text-center">Missing cart items</p> 
                        @endif
                     </div>
                  </div>
               </div>

               <div class="lg:flex lg:mt-8 mt-4 lg:space-x-8 tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div uk-drop="mode: click" class="header_dropdown dropdown_cart uk-drop uk-open uk-drop-bottom-right">
                     <ul class="dropdown_cart_scrollbar" data-simplebar="init">
                        <div class="simplebar-wrapper" style="margin: 0px -10px 0px 0px;">
                           <div class="simplebar-height-auto-observer-wrapper">
                              <div class="simplebar-height-auto-observer"></div>
                           </div>
                           <div class="simplebar-mask">
                              <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
                                 <div class="simplebar-content" style="padding: 0px 10px 0px 0px; height: auto; overflow: hidden scroll;">
                                    @foreach ($wishlistedProducts as $wishlistedProduct)
                                       @php
                                          $unSerlizeProImage = unserialize($wishlistedProduct->image);
                                          $productImage = reset($unSerlizeProImage);
                                        @endphp
                                       <li>
                                          <div class="cart_avatar">
                                             <img src="{{ url("public/images/product/$productImage") }}" alt="" />
                                          </div>
                                          <div class="cart_text">
                                             <div class="font-semibold leading-4 mb-1.5 text-base line-clamp-1">{{ $wishlistedProduct->name }}</div>
                                             @foreach ($wishlistedProduct->productCategoryId as $proCatId)
                                                <p class="text-sm">{{ getProductCategoryNameById($proCatId->cat_id) }}</p>
                                            @endforeach                                             
                                          </div>
                                          <div class="cart_price">
                                             <span> ${{ $wishlistedProduct->price }} </span>
                                             <button class="type">Add to cart</button>
                                          </div>
                                       </li>
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                           <div class="simplebar-placeholder" style="width: 351px; height: 497px;"></div>
                        </div>
                        <div class="simplebar-track" style="visibility: hidden;">
                           <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                           <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: visible; height: 354px;"></div>
                        </div>
                     </ul>

                     <div class="cart_footer">
                        <a href="{{ route('wishlist') }}" class="is_link become-sel"> Go to wishlist </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @if (Auth::user()->switch_as == 'buyer')
         <div class="widget pt-0" id="Follow-suggestions">
            <div class="flex items-center justify-between mb-2">
               <div>
                  <h4 class="text-2xl -mb-0.5 font-semibold">Featured Shops</h4>
               </div>
               <a href="{{ route('seller.shop') }}" class="text-blue-600">See all</a>
            </div>
            <div class="sidebar_inner x-hidden" data-simplebar="init" style="height: 230px;">
               @foreach (showAllShop() as $shop)
                  @if (checkFollowShopStatus($shop->id) != 1)
                  <div class="flex items-center space-x-4 hover:bg-gray-100 rounded-md -mx-2 p-2 followShopList{{$shop->id}}">
                     <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                        <img src="{{ $shop->image }}" class="absolute w-full h-full inset-0 rounded-md" alt="" />
                     </div>
                     <div class="flex-1">
                        <h3 class="text-lg font-semibold capitalize">{{ $shop->shop_name }}</h3>
                        <div class="text-sm text-gray-500 -mt-0.5">
                           @foreach ($shop->store_category as $category)
                              {{$category->name}}
                           @endforeach
                        </div>
                     </div>
                     <div class="followShopBtnSection{{$shop->id}}">
                        <a href="javascript:viod(0);" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold" id="followShop" data-id="{{$shop->id}}"> Follow </a>                        
                     </div>
                  </div>
                  @endif
               @endforeach
            </div>
         </div>
      @endif
   </div>
</div>
