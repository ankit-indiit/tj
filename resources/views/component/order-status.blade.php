<div class="job-details timeline-order">
   <a href="" class="job-logo">
      <img src="{{ $product->product_image }}" alt="" class="w-full">
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
                     <li class="li {{ in_array('request', orderStatus($product->id)) ? 'complete' : 'pt-4' }}">
                        <div class="timestamp">
                           @if (in_array('request', orderStatus($product->id)))
                              <span class="date">
                                 {{ $product->created_at }}
                              <span>
                              </span></span>
                           @endif
                        </div>
                        <div class="status">
                           <h4> Ordered</h4>
                        </div>
                     </li>
                     <li class="li {{ in_array('approved', orderStatus($product->id)) ? 'complete' : 'pt-4' }}">
                        <div class="timestamp">
                           @if (in_array('approved', orderStatus($product->id)))
                              <span class="date">
                                 {{ $product->updated_at }}
                              <span>
                              </span></span>
                           @endif
                        </div>
                        <div class="status">
                           <h4> Approved</h4>
                        </div>
                     </li>
                     <li class="li {{ in_array('packed', orderStatus($product->id)) ? 'complete' : 'pt-4' }}">
                        <div class="timestamp">
                           @if (in_array('packed', orderStatus($product->id)))
                              <span class="date">
                                 {{ $product->updated_at }}
                              <span>
                              </span></span>
                           @endif
                           </span></span>
                        </div>
                        <div class="status">
                           <h4> Packed </h4>
                        </div>
                     </li>
                     <li class="li {{ in_array('shipped', orderStatus($product->id)) ? 'complete' : 'pt-4' }}">
                        <div class="timestamp">
                           @if (in_array('shipped', orderStatus($product->id)))
                              <span class="date">
                                 {{ $product->updated_at }}
                              <span>
                              </span></span>
                           @endif
                        </div>
                        <div class="status">
                           <h4>Shipped </h4>
                        </div>
                     </li>
                     <li class="li {{ in_array('delivered', orderStatus($product->id)) ? 'complete' : 'pt-4' }}">
                        <div class="timestamp">
                           @if (in_array('delivered', orderStatus($product->id)))
                              <span class="date">
                                 {{ $product->updated_at }}
                              <span>
                              </span></span>
                           @endif
                        </div>
                        <div class="status">
                           <h4> Delivered </h4>
                        </div>
                     </li>
                  </ul>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-3">
                  <div class="job-tags">
                     <h4>
                        <div class="green-dot"></div>
                        {{ $product->estimate_delevery }}
                     </h4>
                  </div>
               </div>
            </div>
            @if (Route::currentRouteName() == 'seller-order-detail')
            <div class="row mb-4">
               <div class="col-sm-6">
                  <select class="form-control" id="sellerOrder" data-order-id="{{ $product->order_id }}" data-product-id="{{ $product->product_id }}">
                     <optionvalue="">Select status</option>
                     <option {{getOrderStatus($product->id) == 'pending' ? 'selected' : ''}} value="pending">Pending</option>
                     <option {{getOrderStatus($product->id) == 'approved' ? 'selected' : ''}} value="approved">Approved</option>
                     <option {{getOrderStatus($product->id) == 'packed' ? 'selected' : ''}} value="packed">Packed</option>
                     <option {{getOrderStatus($product->id) == 'shipped' ? 'selected' : ''}} value="shipped">Shipped</option>
                     <option {{getOrderStatus($product->id) == 'delivered' ? 'selected' : ''}} value="delivered">Delivered</option>
                  </select>            
               </div>
            </div>
            @endif
      </div>
   </div>
</div>  