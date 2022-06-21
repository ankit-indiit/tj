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
                                 <h5 class="name">{{ Auth::user()->name }}</h5>
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
                  @php
                     // $unSerlizeProImage = unserialize($product->image);
                     // $productImage = reset($unSerlizeProImage);                         
                  @endphp
                  @foreach ($order->orderProduct as $product)
                     @php
                        $unSerlizeProImage = unserialize(getProductById($product->product_id)->image);
                        $productImage = reset($unSerlizeProImage);                         
                     @endphp
                     <div class="job-details timeline-order">
                        <a href="{{ route('product.detail', getProductById($product->product_id)->slug) }}" class="job-logo">
                           <img src="{{ url("public/images/product/$productImage") }}" alt="">
                        </a>
                        <div class="job-description">
                           <div class="inner-info">
                                 <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                       <h3>{{ getProductById($product->product_id)->name }}</h3>
                                       <h4>{{ getProductById($product->product_id)->sku }}</h4>
                                       <b class="color-black">${{ getProductById($product->product_id)->discounted_price }}</b>
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
                                                <h4> Approved</h4>
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
                                          <li class="li {{ getProductDeleveryStatus($order->id, $product->product_id, 3) ? 'complete' : 'uncompleted' }}">
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
                                          <li class="li {{ getProductDeleveryStatus($order->id, $product->product_id, 4) ? 'complete' : 'uncompleted' }}">
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
                              <b><b> </b></b>
                           </div>
                           <b><b> </b></b>
                        </div>
                        <b><b>
                        </b></b>
                     </div>
                  @endforeach
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
<script type="text/javascript"></script>
@endsection