@extends('layouts.app')
@section('content')
<div class="main_content order-h-d-p">
   <div class="mcontainer">
      <div class="flex justify-between relative md:mb-4 mb-3 border-b pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold"> My Orders
            </h2>
         </div>
         <div>
         </div>
      </div>
      <div class="">
         <div class="full-w">
            <div class="full-w ">
               <div class="job-list">
                  <!-- job 1 -->
                  <div class="job-details">
                     <div class="job-description">
                        <h3>  Delivery Address</h3>
                        <hr>
                        <div class="inner-info">
                           <div class="row">
                              <div class="col-sm-12">
                                 <h5 class="name">{{ show_user_name($userAddress->userId) }}</h5>
                                 <h4>{{ $userAddress->Address }}</h4>
                                 <h5 class="name">{{ $userAddress->phone_no }}</h5>
                              </div>
                              <div class="job-tags">
                                 <br><br>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="job-details timeline-order">
                     <a href="{{ route('product.detail', $product->product_slug) }}" class="job-logo">
                        <img src="{{ $product->product_image }}" alt="">
                     </a>
                     <div class="job-description">
                        <div class="inner-info">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-3">
                                 <h3>{{ $product->product_name }}</h3>
                                 <h4>{{ $product->product_sku }}</h4>
                                 <b class="color-black">${{ $product->product_price }}</b>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-6">
                                 <ul class="timeline" id="timeline">
                                    <li class="li {{ getProductDeleveryStatus($order->id, $product->product_id, 0) ? 'complete' : 'uncompleted' }}">
                                       <div class="timestamp">
                                          <span class="date">{{ $product->created_at }}<span>
                                          </span></span>
                                       </div>
                                       <div class="status">
                                          <h4> Ordered</h4>
                                       </div>
                                    </li>
                                    <li class="li {{ getProductDeleveryStatus($order->id, $product->product_id, 1) ? 'complete' : 'uncompleted' }}">
                                       <div class="timestamp">
                                          <span class="date">
                                             {{ @getProductDeleveryStatus($order->id, $product->product_id, 1)->created_at }}
                                          <span>
                                          </span></span>
                                       </div>
                                       <div class="status">
                                          <h4> Approved </h4>
                                       </div>
                                    </li>
                                    <li class="li {{ getProductDeleveryStatus($order->id, $product->product_id, 2) ? 'complete' : 'uncompleted' }}">
                                       <div class="timestamp">
                                          <span class="date">
                                             {{ @getProductDeleveryStatus($order->id, $product->product_id, 2)->created_at }}
                                          <span>
                                          </span></span>
                                       </div>
                                       <div class="status">
                                          <h4> Packed </h4>
                                       </div>
                                    </li>
                                    <li class="li {{ getProductDeleveryStatus($order->id, $product->product_id, 2) ? 'complete' : 'uncompleted' }}">
                                       <div class="timestamp">
                                          <span class="date">
                                             {{ @getProductDeleveryStatus($order->id, $product->product_id, 3)->created_at }}
                                          <span>
                                          </span></span>
                                       </div>
                                       <div class="status">
                                          <h4>Shipped </h4>
                                       </div>
                                    </li>
                                    <li class="li {{ getProductDeleveryStatus($order->id, $product->product_id, 3) ? 'complete' : 'uncompleted' }}">
                                       <div class="timestamp">
                                          <span class="date">
                                             <b>{{ @getProductDeleveryStatus($order->id, $product->product_id, 4)->created_at }}<b><span>
                                          </span></b></b></span>
                                       </div>
                                       <b>
                                          <b>
                                             <div class="status">
                                                <h4> Delivered </h4>
                                             </div>
                                          </b>
                                       </b>
                                    </li>
                                    <b><b>
                                    </b></b>
                                 </ul>
                                 <b><b>                   
                                 </b></b>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-3">
                                 <b>
                                    <b>
                                       <div class="job-tags">
                                          <h4>
                                             <div class="green-dot"></div>
                                             Delivered
                                             {{ $product->estimate_delevery }} 
                                          </h4>
                                       </div>
                                    </b>
                                 </b>
                              </div>
                              <b><b>
                              </b></b>
                           </div>
                           <div class="row">
                              <div class="product-status">
                                 @if (getUpdatedProductDeleveryStatus($order->id, $product->product_id) == 0)
                                    <p class="payment-details yellow">Pending</p>
                                 @elseif (getUpdatedProductDeleveryStatus($order->id, $product->product_id) == 1)
                                    <p class="payment-details yellow">Approved</p>
                                 @elseif (getUpdatedProductDeleveryStatus($order->id, $product->product_id) == 2)
                                    <p class="payment-details yellow">Packed</p>
                                 @elseif (getUpdatedProductDeleveryStatus($order->id, $product->product_id) == 3)
                                    <p class="payment-details yellow">Shipped</p>
                                 @elseif (getUpdatedProductDeleveryStatus($order->id, $product->product_id) == 4)
                                    <p class="payment-details yellow">Delivered</p>
                                 @endif
                              </div>
                              <div class="product-status-dropdown">
                                 <select class="form-control w-100" id="sellerOrder" data-order-id="{{ $order->id }}" data-product-id="{{ $product->product_id }}">
                                    <option {{getUpdatedProductDeleveryStatus($order->id, $product->product_id) == 0 ? 'selected' : ''}} value="0" >Pending</option>
                                    <option {{getUpdatedProductDeleveryStatus($order->id, $product->product_id) == 1 ? 'selected' : ''}} value="1" >Approved</option>
                                    <option {{getUpdatedProductDeleveryStatus($order->id, $product->product_id) == 2 ? 'selected' : ''}} value="2">Packed</option>
                                    <option {{getUpdatedProductDeleveryStatus($order->id, $product->product_id) == 3 ? 'selected' : ''}} value="3">Shipped</option>
                                    <option {{getUpdatedProductDeleveryStatus($order->id, $product->product_id) == 4 ? 'selected' : ''}} value="4">Delivered</option>
                                 </select>   
                              </div>                              
                           </div>
                           </div>
                           <b><b> </b></b>
                        </div>
                        <b><b> </b></b>
                     </div>
                     <b><b>
                     </b></b>
                  </div>
                  <b><b>
                  </b></b>
               </div>
               <b>
                  <b>
                     <!-- job 1 -->
                     <!-- job 1 -->
                  </b>
               </b>
            </div>
            <b><b>
            </b></b>
         </div>
         <b><b>
         </b></b>
      </div>
      <b><b>
      </b></b>
   </div>
   <b><b> </b></b>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
   $(document).on('change', '#sellerOrder', function(){
      var productStatus = $(this).val();
      var order_id = $(this).data('order-id');
      var product_id = $(this).data('product-id');
      $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: _baseURL + "/update-seller-order-status",
        data: { 
            productStatus: productStatus,
            order_id: order_id,
            product_id: product_id,
        },
        dataType: 'json',
        success: function (data) {
          if (data.erro == 101) {
            swal("", data.message, "success", {
              button: "close",
            });
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
   });
</script>
@endsection