@extends('layouts.app')
@section('content')
<div class="main_content order-his oredr-pag">
   <div class="mcontainer">
      <div class="flex justify-between relative md:mb-4 mb-3 border-b pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold d-inline"> All Orders
            </h2>
            <div class="filter-select pull-right d-inline m-all">
               <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filter value
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                     <ul class="space-y-1">
                        <li> 
                           <label class="cont">Unprocessed Orders
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           </label>
                        </li>
                        <li> 
                           <label class="cont">Open Orders
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           </label>
                        </li>
                        <li> 
                           <label class="cont">Delivered  Orders
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           </label>
                        </li>
                        <li> 
                           <label class="cont">Accepted   Orders
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           </label>
                        </li>
                        <li> 
                           <label class="cont">Rejected    Orders
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           </label>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div>
         </div>
      </div>
      <div class="full-w">
         <div class="full-w">
            <div class="sel-ord">
               <div class="job-list">
                  @if (count($orders) > 0)
                     @foreach ($orders as $order)
                        @foreach (getProductByOrderId($order->id) as $product)                     
                           <div class="job-detai ">
                              <div class="main-head">
                                 <div class="row">
                                    <div class="col-sm-2">
                                       <h3>ORDER PLACED</h3>
                                       <h6>{{ $order->created_at }}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                       <h3>TOTAL</h3>
                                       <h6>$ {{ $product->product_price }}</h6>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                       <h3>ORDER #{{ $order->id }}</h3>
                                       <h6>
                                          <a href="{{ route('buyer-order-detail', $order->id) }}">View order details</a>
                                          <a href="">Invoice</a>
                                       </h6>
                                    </div>
                                 </div>
                              </div>
                              <div class="maind-bgf">
                                 <div class="job-details timeline-order">
                                    <a href="" class="job-logo">
                                       <img src="{{ $product->product_image }}" alt="" width="100%" height="100%">
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
                                 <div class="row">
                                    {{-- <div class="col-sm-9">
                                       <div class="job-details">
                                         
                                       </div>
                                    </div>
                                    <div class="col-sm-3">
                                       @if (getUpdatedProductDeleveryStatus($product->order_id, $product->product_id) == 0)
                                          <p class="payment-details yellow">Pending</p>
                                       @elseif (getUpdatedProductDeleveryStatus($product->order_id, $product->product_id) == 1)
                                          <p class="payment-details yellow">Approved</p>
                                       @elseif (getUpdatedProductDeleveryStatus($product->order_id, $product->product_id) == 2)
                                          <p class="payment-details yellow">Packed</p>
                                       @elseif (getUpdatedProductDeleveryStatus($product->order_id, $product->product_id) == 3)
                                          <p class="payment-details yellow">Shipped</p>
                                       @elseif (getUpdatedProductDeleveryStatus($product->order_id, $product->product_id) == 4)
                                          <p class="payment-details yellow">Delivered</p>
                                       @endif                                 
                                       <div class="right">
                                          <a class="filters" href="{{ route('buyer-order-detail', $order->id) }}" aria-expanded="false">
                                          View Order Details</a><br>
                                       </div>
                                    </div> --}}
                                 </div>
                                 <div class="row"> </div>
                              </div>
                           </div>
                        @endforeach
                     @endforeach
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript"></script>
@endsection