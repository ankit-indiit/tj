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
                                 <h5 class="name">{{ show_user_name(@$userAddress->userId) }}</h5>
                                 <h4>{{ @$userAddress->Address }}</h4>
                                 <h5 class="name">{{ @$userAddress->phone_no }}</h5>
                              </div>
                              <div class="job-tags">
                                 <br><br>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="job-details timeline-order">
                     @include('component.order-status', ['product' => $product])                     
                  </div>
               </div>
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