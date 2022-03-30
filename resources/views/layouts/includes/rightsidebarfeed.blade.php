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
                                    <li>
                                       <div class="cart_avatar">
                                          <img src="{{ asset('images/avatars/avatar-2.jpg') }}" alt="" />
                                       </div>
                                       <div class="cart_text">
                                          <div class="font-semibold leading-4 mb-1.5 text-base line-clamp-1">Wireless headphones</div>
                                          <p class="text-sm">Type Accessories</p>
                                       </div>
                                       <div class="cart_price">
                                          <span> $14.99 </span>
                                          <button class="type">Remove</button>
                                       </div>
                                    </li>
                                    <li>
                                       <div class="cart_avatar">
                                          <img src="{{ asset('images/product/13.jpg') }}" alt="" />
                                       </div>
                                       <div class="cart_text">
                                          <div class="font-semibold leading-4 mb-1.5 text-base line-clamp-1">Parfum Spray</div>
                                          <p class="text-sm">Type Parfums</p>
                                       </div>
                                       <div class="cart_price">
                                          <span> $16.99 </span>
                                          <button class="type">Remove</button>
                                       </div>
                                    </li>
                                    <li>
                                       <div class="cart_avatar">
                                          <img src="{{ asset('images/product/15.jpg') }}" alt="" />
                                       </div>
                                       <div class="cart_text">
                                          <div class="font-semibold leading-4 mb-1.5 text-base line-clamp-1">Herbal Shampoo</div>
                                          <p class="text-sm">Type Herbel</p>
                                       </div>
                                       <div class="cart_price">
                                          <span> $12.99 </span>
                                          <button class="type">Remove</button>
                                       </div>
                                    </li>
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
                        <a href="cart.html" class="is_link become-sel"> Go to Cart </a>
                        <h1>Total : <strong> $ 44.99</strong></h1>
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

      <div class="widget pt-0" id="Follow-suggestions">
         <div class="flex items-center justify-between mb-2">
            <div>
               <h4 class="text-2xl -mb-0.5 font-semibold">Featured Shops</h4>
            </div>
            <a href="shop-1.html" class="text-blue-600">See all</a>
         </div>
         <div class="sidebar_inner x-hidden" data-simplebar="init" style="height: 230px;">
            <div class="flex items-center space-x-4 hover:bg-gray-100 rounded-md -mx-2 p-2">
               <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                  <img src="{{ asset('images/group/group-3.jpg') }}" class="absolute w-full h-full inset-0 rounded-md" alt="" />
               </div>
               <div class="flex-1">
                  <h3 class="text-lg font-semibold capitalize">The Corner Store</h3>
                  <div class="text-sm text-gray-500 -mt-0.5">Grocery</div>
               </div>
               <a href="#" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold"> Follow </a>
            </div>
            <div class="flex items-center space-x-4 hover:bg-gray-100 rounded-md -mx-2 p-2">
               <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                  <img src="{{ asset('images/group/group-3.jpg') }}" class="absolute w-full h-full inset-0 rounded-md" alt="" />
               </div>
               <div class="flex-1">
                  <h3 class="text-lg font-semibold capitalize">Sweet Spot</h3>
                  <div class="text-sm text-gray-500 -mt-0.5">Fruits</div>
               </div>
               <a href="#" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold"> Follow </a>
            </div>
            <div class="flex items-center space-x-4 hover:bg-gray-100 rounded-md -mx-2 p-2">
               <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                  <img src="{{ asset('images/group/group-2.jpg') }}" class="absolute w-full h-full inset-0 rounded-md" alt="" />
               </div>
               <div class="flex-1">
                  <h3 class="text-lg font-semibold capitalize">The Mega Store</h3>
                  <div class="text-sm text-gray-500 -mt-0.5">Clothing</div>
               </div>
               <a href="#" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold"> Follow </a>
            </div>
            <div class="flex items-center space-x-4 hover:bg-gray-100 rounded-md -mx-2 p-2">
               <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                  <img src="{{ asset('images/group/group-1.jpg') }}" class="absolute w-full h-full inset-0 rounded-md" alt="" />
               </div>
               <div class="flex-1">
                  <h3 class="text-lg font-semibold capitalize">The Ladies Space</h3>
                  <div class="text-sm text-gray-500 -mt-0.5">Cosmetics</div>
               </div>
               <a href="#" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold"> Follow </a>
            </div>
         </div>
      </div>
   </div>
</div>
