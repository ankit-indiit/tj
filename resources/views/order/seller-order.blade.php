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
                     @include('component.order-filter')
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
                  @if (count($orderProducts) > 0)
                     @foreach ($orderProducts as $product)                     
                        {{-- @foreach ($order->orderProduct as $product)        --}}
                        <div class="job-detai ">
                           <div class="main-head">
                              <div class="row">
                                 <div class="col-sm-2">
                                    <h3>ORDER PLACED</h3>
                                    <h6>{{ $product->created_at }}</h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h3>TOTAL</h3>
                                    <h6>$ {{ $product->product_price }}</h6>
                                 </div>
                                 <div class="col-sm-4 text-right">
                                    <h3>ORDER #{{ $product->id }}</h3>
                                    <h6><a href="{{ route('seller-order-detail', $product->id) }}">View order details</a> <a href="">Invoice</a></h6>
                                 </div>
                              </div>
                           </div>
                           <div class="maind-bgf">
                              @include('component.order-status', ['product' => $product])
                           </div>
                        </div>
                        {{-- @endforeach --}}
                     @endforeach
                  @else
                     No order found!
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
          } else {
            swal("", data.message, "error", {
              button: "close",
            });
          }          
        }
      });    
   });

   $(document).ready(function(){
      $("#filterOrderForm").on("change", "#filterOrder", function(){
         $("#filterOrderForm").submit();
      });
   });   
</script>
@endsection