@extends('layouts.app-without-sidebar')
@section('content')
<div class="main_contents mt-8">
   <section class="cart-area w-100">
      <div class="container">
        <div class="flex justify-between relative md:mb-4 mb-3 border-b pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold"> My Wishlist({{ count($products) }})
            </h2>
         </div>
         <div>
         </div>
      </div>
         <div class="row">
            <div class="col-lg-12 col-md-12">
               <form>
                  <div class="cart-wraps">
                     <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th scope="col">Product</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">Unit Price</th>
                                 <th scope="col">Rating</th>
                                 <th scope="col">Sold By</th>
                                 <th scope="col">Total</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($products as $product)
                                @php
                                  $unSerlizeProImage = unserialize($product->image);
                                  $productImage = reset($unSerlizeProImage);
                                @endphp
                                <tr class="cart-product-list{{ $product->id }}">
                                   <td class="product-thumbnail">
                                      <a href="#">
                                      <img src="{{ url("public/images/product/$productImage") }}" alt="item">
                                      </a>
                                   </td>
                                   <td class="product-name">
                                      <a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                   </td>
                                   <td class="product-price">
                                      <span class="unit-amount">${{ $product->discounted_price }}</span>
                                   </td>
                                   <td class="product-quantity">
                                      <div class="star">
                                         <i class="fa fa-star" aria-hidden="true"></i>
                                         <i class="fa fa-star" aria-hidden="true"></i>
                                         <i class="fa fa-star" aria-hidden="true"></i>
                                         <i class="fa fa-star" aria-hidden="true"></i>
                                         <i class="fa fa-star" aria-hidden="true"></i>
                                      </div>
                                   </td>
                                   <td class="product-price">
                                      <span class="unit-amount">Nureca Limited</span>
                                   </td>
                                   <td class="product-subtotal">
                                      <span class="subtotal-amount">$25.00</span>
                                   </td>
                                   <td class="product-subtotal fnd">    
                                      <span class="continue-shopping-box cart-buttons" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                         <span href="#" class="">
                                            <a href="javascript:void(0);" id="addToCart" data-product="{{ $product->id }}" class="is_icon" aria-expanded="false">
                                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                               </svg>
                                            </a>
                                            <input type="hidden" id="productQuantity{{ $product->id }}" value="1" name="">
                                         </span>
                                      </span>
                                      <a href="javascript:void(0);" id="deleteProductFromWishlist" data-id="{{ $product->id }}" class="remove" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="fa fa-trash-o"></i>
                                      </a>
                                   </td>
                                </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
   <!-- End Cart Area -->   
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
  $(document).on('click', '#deleteProductFromWishlist', function(){
    var productId = $(this).data('id');
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: _baseURL + "/delete-product-from-wishlist",
        data: { productId: productId },
        dataType: 'json',
        success: function (data) {
          if (data.erro == '101') {
            swal("", data.message, "success", {
               button: "close",
            });               
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
          }
        }
    });
  });
</script>
@endsection