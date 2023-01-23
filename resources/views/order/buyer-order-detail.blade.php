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
                  {{-- @foreach ($order as $product) --}}
                     @php
                        $unSerlizeProImage = unserialize(getProductById($product->product_id)->image);
                        $productImage = reset($unSerlizeProImage);                         
                     @endphp
                     <div class="job-details timeline-order">
                        @include('component.order-status', ['product' => $product])
                     </div>
                  {{-- @endforeach --}}                  
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