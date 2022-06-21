@extends('layouts.app-without-sidebar')
@section('content')
<div class="main_contents checkout-page">
   <div class="container">
      <div class="flex justify-between relative md:mb-4 mb-3 border-b pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold"> Checkout
            </h2>
         </div>
      </div>
      @if (count($cartItems) > 0)
        <form action="javascript:void(0);" id="checkoutForm" method="post">
          <div class="row">
             <div class="col-md-12 col-lg-8 ">
                <div id="accordion">
                   <div class="card">
                      <div class="card-header" id="headingOne">
                        {{-- @php
                          echo '<pre>';
                          print_r(Session::get('coupon'));
                        @endphp --}}
                         <h5 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#billingAddress" aria-expanded="false" aria-controls="billingAddress">
                              <input type="hidden" name="billing_address">
                               <h2 class="text-xl font-semibold">Billing Address</h2>
                               <span class="a-d"><i class="fa fa-angle-down" aria-hidden="true"></i>
                               </span>
                            </a>
                         </h5>
                      </div>
                      <div id="billingAddress" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
                         <div class="card-body">
                            <label>Choose Billing Address</label>
                            <select class="form-control userBilligAddress" name="billing_section" id="userCheckoutForm" data-type="billing">
                               <option value="">Choose address</option>
                               <option value="0">Add New Billing Address</option>
                               @foreach ($billings as $billing)
                                  <option value="{{ $billing->id }}">{{ $billing->Address }}</option>
                               @endforeach
                            </select>
                            <hr>
                            <div id="billingAddressForm">
                              {{-- @include('checkout.user-address', ['form' => 'billing']) --}}
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <div id="accordion">
                   <div class="card">
                      <div class="card-header" id="headingOne">
                         <h5 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#shippingAddress" aria-expanded="false" aria-controls="shippingAddress">
                               <h2 class="text-xl font-semibold">Shipping Address</h2>
                               <span class="a-d"><i class="fa fa-angle-down" aria-hidden="true"></i>
                               </span>
                            </a>
                         </h5>
                      </div>
                      <div id="shippingAddress" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
                         <div class="card-body">
                            <label>Choose Billing Address</label>
                            <select class="form-control userShippingAddress" name="shipping_section" id="userCheckoutForm" data-type="shipping">
                              <option value="">Choose address</option>
                              <option value="0">Add New Shipping Address</option>
                              @foreach ($shippings as $shipping)
                                <option value="{{ $shipping->id }}">{{ $shipping->Address }}</option>
                              @endforeach
                            </select>
                            <hr>
                            <div id="shippingAddressForm">
                               {{-- @include('checkout.user-address', ['form' => 'shipping']) --}}
                            </div>                        
                         </div>
                      </div>
                   </div>
                </div>            
                <div id="accordion">
                   <div class="card">
                      <div class="card-header" id="headingThree">
                         <h5 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsethree" aria-expanded="false" aria-controls="collapsethree">
                               <h2 class="text-xl font-semibold">Order Summary</h2>
                               <span class="a-d"><i class="fa fa-angle-down" aria-hidden="true"></i>
                               </span>
                            </a>
                         </h5>
                      </div>
                      <div id="collapsethree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion" style="">
                         <div class="card mt-4">
                            @php 
                               $cartTotal = 0;
                               $coupon = Session::get('coupon') ? Session::get('coupon')['discounted_price'] : 0;
                            @endphp
                            @foreach ($cartItems as $cartItem)
                              @php
                                $cartTotal = $cartTotal + $cartItem->product_price;
                              @endphp
                              <div class="card-body cart-product-list{{$cartItem->id}}">
                                  <input type="hidden" name="product[{{$cartItem->product_id}}][id]" value="{{$cartItem->product_id}}">
                                  <input type="hidden" name="product[{{$cartItem->product_id}}][qty]" value="{{$cartItem->quantity}}">
                                  <input type="hidden" name="product[{{$cartItem->product_id}}][price]" value="{{$cartItem->product_price}}">
                                  <input type="hidden" name="product[{{$cartItem->product_id}}][seller_id]" value="{{$cartItem->seller_id}}">
                                  <div class="full-w cart-n mt-4">
                                     <div class="job-list">
                                        <!-- job 1 -->
                                        <div class="job-details">
                                           <div class="job-description">
                                              <div class="inner-info">
                                                 <div class="row">
                                                    <div class="col-sm-3">
                                                       <a href="{{ $cartItem->product_slug }}" class="job-logo">
                                                       <img src="{{ $cartItem->product_image }}" alt="">
                                                       </a>
                                                       <div class="product-quantity">
                                                          <div class="input-counter">
                                                             <span class="minus-btn" style="cursor: not-allowed;">
                                                             <i class="fa fa-minus"></i>
                                                             </span>
                                                             <input type="text" value="{{ $cartItem->quantity }}" disabled="">
                                                             <span class="plus-btn" style="cursor: not-allowed;">
                                                             <i class="fa fa-plus"></i>
                                                             </span>
                                                          </div>
                                                       </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                       <h3>{{ $cartItem->product_name }}</h3>
                                                       <h4>Seller: {{ show_user_name($cartItem->seller_id) }} </h4>
                                                       <b class="color-black">${{ $cartItem->product_price }}</b>
                                                       {{-- <a href="javascript:void(0);" id="moveToWishlist" data-id="{{ $cartItem->id }}" data-product="{{ $cartItem->product_id }}" class="display-inline sp-m wsh">
                                                          <b class="color-black">Move to wishlist</b>
                                                       </a> --}}
                                                       {{-- <a href="javascript:void(0);" class="display-inline sp-m rmv" id="removeToCart" data-id="{{ $cartItem->id }}">
                                                          <b class="color-black">Remove</b>
                                                       </a> --}}
                                                    </div>
                                                    <div class="col-sm-4">
                                                       <h4 class="">
                                                          <div class="green-dot"></div>                         
                                                          {{ $cartItem->estimate_delevery }}
                                                       </h4>
                                                       <h4> </h4>
                                                       <h4>
                                                       </h4>
                                                    </div>
                                                    <div class="job-tags">
                                                       <br><br>
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                        <!-- job 1 -->
                                     </div>
                                  </div>
                              </div>
                            @endforeach
                            @php
                            $subTotal = $cartTotal - Session::get('coupon')['coupon'];
                            $total = $subTotal + $shippingCharge;
                            @endphp
                            <input type="hidden" name="sub_total" value="{{$subTotal}}">
                            <input type="hidden" name="shipping" value="{{$shippingCharge}}">
                            <input type="hidden" name="coupon" value="{{$coupon}}">
                            <input type="hidden" name="total" value="{{$total}}">
                         </div>
                      </div>
                   </div>
                </div>
                <div id="accordion ">
                   <div class="card">
                      <div class="card-header" id="headingFour">
                         <h5 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                               <h2 class="text-xl font-semibold">Payment Methods</h2>
                               <span class="a-d"><i class="fa fa-angle-down" aria-hidden="true"></i>
                               </span>
                            </a>
                         </h5>
                      </div>
                      <div id="collapsefour" class="mt-md-0 collapse" aria-labelledby="headingFour" data-parent="#accordion" style="">
                         <div class="card">
                            <div class="card-body">                               
                               <div class="clearfix">
                                  <input id="paypal" value="paypal" name="payment_type" type="radio" class="radio">
                                  <label for="paypal">Paypal</label>
                               </div>
                               <div class="clearfix">
                                  <input id="cod" value="cod" name="payment_type" type="radio" class="radio">
                                  <label for="cod">COD</label>
                               </div>
                               <div class="d-none">
                                  <div class="mt-2"></div>
                                  <label>Cart Number</label>
                                  <div class="form-group">
                                     <input type="text" class="form-control form-control--sm">
                                  </div>
                                  <div class="row">
                                     <div class="col-sm-6">
                                        <label>Month:</label>
                                        <div class="form-group select-wrapper">
                                           <select class="form-control form-control--sm">
                                              <option selected="" value="1">January</option>
                                              <option value="2">February</option>
                                              <option value="3">March</option>
                                              <option value="4">April</option>
                                              <option value="5">May</option>
                                              <option value="6">June</option>
                                              <option value="7">July</option>
                                              <option value="8">August</option>
                                              <option value="9">September</option>
                                              <option value="10">October</option>
                                              <option value="11">November</option>
                                              <option value="12">December</option>
                                           </select>
                                        </div>
                                     </div>
                                     <div class="col-sm-6">
                                        <label>Year:</label>
                                        <div class="form-group select-wrapper">
                                           <select class="form-control form-control--sm">
                                              <option value="2019">2019</option>
                                              <option value="2020">2020</option>
                                              <option value="2021">2021</option>
                                              <option value="2022">2022</option>
                                              <option value="2023">2023</option>
                                              <option value="2024">2024</option>
                                           </select>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="mt-4">
                                     <label>CVV Code</label>
                                     <div class="form-group">
                                        <input type="text" class="form-control form-control--sm">
                                     </div>
                                  </div>                              
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-md-12 col-lg-4 mt-2 mt-md-0">            
                <div class="cart-area">
                   <div class="coupon-wrap">
                      <div class="shops-form">
                         <h3>Apply Coupon</h3>
                         <div class="form-group">
                            <input type="text" class="form-control" id="couponName" placeholder="Add Coupon Code">
                         </div>
                         <a href="#" class="default-btn" id="applyCoupon">
                         Apply Coupon
                         <i class="flaticon-right"></i>
                         </a>
                      </div>
                   </div>
                   <div class="cart-totals m-0 mt-4">
                      <h3>Cart Totals</h3>
                      {{-- @php
                        echo '<pre>';
                        print_r(Session::get('payment_detail')['total_amount']);
                      @endphp --}}
                      <ul>                        
                         <li>Subtotal <span>${{ $subTotal }}</span></li>
                         <li>Shipping <span>${{ $shippingCharge }}</span></li>
                         <li>Coupon <span>${{ Session::get('coupon')['coupon'] }}</span></li>
                         <li>Total <span><b>${{ $total }}</b></span></li>
                      </ul>
                      <div id="">
                        <input type="hidden" id="paymentRoute" name="" value="place-order">
                        <button type="submit" id="checkoutFormBtn" class="default-btn">Place Order<i class="flaticon-right"></i></button>                   
                        {{-- <a href="{{ route('make.payment') }}" id="paypalBtn" class="default-btn d-none">Make Payment<i class="flaticon-right"></i></a>                   --}}
                      </div>
                   </div>
                </div>
             </div>
          </div>        
        </form>
      @else
        You don't have any product to place order!
      @endif
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
@endsection