@extends('layouts.app-without-sidebar')
@section('content')
<div class="main_contents">
   <div class="container">
      <div class="flex justify-between relative md:mb-4 mb-3 border-b pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold"> My Cart({{ count($cartItems) }})
            </h2>
         </div>
         <div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12 col-lg-8">
            <div class="full-w">
               <div class="full-w cart-n">
                  <form action="{{ route('update-cart') }}" id="updateCartForm" method="post">
                     <div class="job-list">
                        @csrf
                        @php
                           // Session::forget('coupon');
                           $subTotal = 0;
                           $productIds = [];
                        @endphp
                        @foreach ($cartItems as $cartItem)
                        @php 
                           // $subTotal = $cartItem->product_price;
                           $subTotal = $subTotal + $cartItem->product_price;
                           
                           $productIds[] .= $cartItem->product_id;
                        @endphp
                           <div class="job-details cart-product-list{{ $cartItem->id }}">
                              <div class="job-description">
                                 <div class="inner-info">
                                    <div class="row">
                                       <div class="col-sm-3 quantity">
                                          <a href="{{ route('product.detail', $cartItem->product_slug) }}" class="job-logo">
                                          <img src="{{ $cartItem->product_image }}" alt="">
                                          </a>
                                          <div class="product-quantity">
                                             <div class="input-counter">
                                                <span class="minus-btn">
                                                   <a href="javascript:void(0);" class="dicreseCartQty">
                                                      <i class="fa fa-minus"></i>                        
                                                   </a>
                                                </span>
                                                <input type="text" name="quantity[]" class="cartQty" value="{{ $cartItem->quantity }}">
                                                <input type="hidden" class="proQty" value="{{ $cartItem->product_quentity }}">
                                                <span class="plus-btn">
                                                   <a href="javascript:void(0);" class="increseCartQty">
                                                      <i class="fa fa-plus"></i>                         
                                                   </a>
                                                </span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-sm-5">
                                          <h3>{{ $cartItem->product_name }}</h3>
                                          <h4>Seller: {{ show_user_name($cartItem->seller_id) }} </h4>
                                          <b class="color-black">${{ $cartItem->product_price }}</b>
                                          <a href="javascript:void(0);" id="moveToWishlist" data-id="{{ $cartItem->id }}" data-product="{{ $cartItem->product_id }}" class="display-inline sp-m wsh">
                                             <b class="color-black">Move to wishlist</b>
                                          </a>
                                          <a href="javascript:void(0);" class="display-inline sp-m rmv" id="removeToCart" data-id="{{ $cartItem->id }}"><b class="color-black">Remove</b></a>       
                                       </div>
                                       <div class="col-sm-4">
                                          <h4 class="">
                                             <div class="green-dot"></div>
                                             {{$cartItem->estimate_delevery}}
                                          </h4>
                                          <h4> </h4>
                                          <h4>
                                          </h4>
                                       </div>                                       
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <input type="hidden" name="id[]" value="{{ $cartItem->id }}">
                        @endforeach
                     </div>
                     <button type="submit" class="display-inline sp-m rmv float-right d-none" id="updateCartBtn"><b class="color-black">Update Cart</b></button>  
                  </form>                        
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-lg-4 cart-area">
            <div class="coupon-wrap">
               <div class="shops-form">
                  <h3>Apply Coupon</h3>
                  <div class="form-group">                     
                     <input type="text" class="form-control" id="couponName" placeholder="Add Coupon Code">
                     <input type="hidden" id="product_ids" value="{{ json_encode($productIds) }}">
                  </div>
                  <a href="javascript:void(0);" id="applyCoupon" class="default-btn">Apply Coupon<i class="flaticon-right"></i></a>
               </div>
            </div>
            <div class="cart-totals">
               <h3>Cart Totals</h3>
               {{-- {{Session::forget('coupon')}} --}}
               @php
                  if (Session::get('coupon')) {
                     $shipping = 00.00;
                     $totalPrice = Session::get('coupon')['total_price'] ? Session::get('coupon')['total_price'] + $shipping : $subTotal;
                  } else {
                     $totalPrice = $subTotal;
                  }
               @endphp
               <ul>
                  <li>Subtotal <span>${{ $subTotal }}</span></li>
                  <li>Shipping <span>$00.00</span></li>
                  <li>Coupon <span>${{ @Session::get('coupon')['coupon'] }}</span></li>
                  <li>Total <span><b>${{ $totalPrice }}</b></span></li>
               </ul>
               <a href="{{ route('checkout') }}" class="default-btn">
               Proceed to Checkout
               <i class="flaticon-right"></i>
               </a>
            </div>
         </div>
         <!-- open chat box -->
      </div>
   </div>
   <div id="logout-modal" class="create-post uk-modal" uk-modal="">
      <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
         <div class="text-center py-4 border-b">
            <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2 uk-icon uk-close" type="button" uk-close="" uk-tooltip="title: Close ; pos: bottom ;offset:7" title="" aria-expanded="false">
               <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon">
                  <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                  <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
               </svg>
            </button>
         </div>
         <div class="main-txt">
            <h3 class="text-lg font-semibold"> Are you sure you want to logout? </h3>
            <div class="space-x-2 buttons-yesno">
               <a href="login.html" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium">
               Yes </a>  
               <a href="#" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
               Cancel </a>
            </div>
         </div>
      </div>
   </div>   
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
   
</script>
@endsection