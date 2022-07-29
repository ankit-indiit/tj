@extends('layouts.app-without-sidebar')
@section('content')
<div class="main_contentzz">
   <div class="mcontainer  mt-5">
      <div class="items-center justify-between">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
               <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
               <li class="breadcrumb-item active" aria-current="page">Product Details</li>
            </ol>
         </nav>
      </div>
      <!-- Start Product Details Area -->
      <section class="product-details-area main-bgs ptb-100">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-6 col-md-12">
               	@php
                   $unSerlizeProImage = unserialize($productDetail->image);
                   $productImage = reset($unSerlizeProImage);
                @endphp
                  <div class="product-details-image">
                     <img src="{{ url("public/images/product/$productImage") }}" width="92%" alt="image">
                  </div>
               </div>
               <div class="col-lg-6 col-md-12">
                  <div class="product-details-desc">
                     <h3>{{ $productDetail->name }}</h3>
                     <div class="price">
                        <span class="new-price">${{ $productDetail->discounted_price }}</span>
                        <span class="old-price">${{ $productDetail->price }}</span>
                     </div>
                     <div class="product-review">                        
                        {!! showProductRating($productDetail->id) !!}
                     </div>
                     <p>{{ $productDetail->description }}</p>                     
                     @foreach ($productCollectionIds as $collectionId)
                        <a href="javascript:void(0);" class="btn btn-secondary btn-sm">
                           {{ getProductCollection($collectionId) }}
                        </a>
                     @endforeach
                     <div class="product-add-to-cart">
                        <div class="input-counter quantity">
                           <span class="minus-btn">
                              <a href="javascript:void(0);" class="dicreseProductQty">
                                 <i class="fa fa-minus"></i>                        
                              </a>
                           </span>
                           <input type="text" name="quantity" id="productQuantity{{ $productDetail->id }}" class="productQty" value="1">
                           <input type="hidden" name="quantity" class="proQty" value="{{ $productDetail->quantity }}">
                           <span class="plus-btn">
                              <a href="javascript:void(0);" class="increseProductQty">
                                 <i class="fa fa-plus"></i>                         
                              </a>
                           </span>
                        </div>
                        @if ($productDetail->check_cart_status == 1)
                           <div class="addToCartDiv{{ $productDetail->id }}">
                              <a type="submit" class="default-btn" href="{{ route('cart') }}">
                                 Go To Cart
                              </a>
                           </div>
                        @else
                           <div class="addToCartDiv{{ $productDetail->id }}">
                              <a type="submit" class="default-btn" href="javascript:void(0);" id="addToCart" data-product="{{ $productDetail->id }}">
                                 Add to Cart
                                 </a>
                              </div>
                        @endif
                        @if (Auth::user()->switch_as == 'seller')
                           <a href="javascript:void(0);" class="is_link featured-btn pull-right" aria-expanded="false" style="
                              margin-top: 0px;
                              padding: 23px 20px;
                              line-height: 2px;
                              background: #ff980024;
                              color: #ffc107;
                              margin-right: 9px;
                              "> Add to Collections </a>
                           @if (count($collections) > 0)
                              <div class="bg-white w-56 main-df shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small main-ss">
                                 <div class="sidebar_innersss" data-simplebar="init">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                       <div class="simplebar-height-auto-observer-wrapper">
                                          <div class="simplebar-height-auto-observer"></div>
                                       </div>
                                       <div class="simplebar-mask">
                                          <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                             <div class="simplebar-content" style="padding: 0px; height: auto; overflow: hidden;">
                                                <ul class="space-y-1 ">
                                                   @foreach ($collections as $collection)
                                                      <li>
                                                         <a href="javascript:void(0);" id="assignCollection" data-id="{{$collection->id}}" data-product="{{$productDetail->id}}">
                                                            {{$collection->name}}
                                                         </a>
                                                      </li>
                                                   @endforeach
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                       <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                       <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
                                    </div>
                                 </div>
                              </div>
                           @endif
                        @endif
                     </div>                     
                  </div>
               </div>
               <div class="col-lg-12 col-md-12">
                  <div class="tab products-details-tab">
                     <div class="row">
                        <div class="col-lg-12 col-md-12">
                           <ul class="tabs active">
                              <li class="current">
                                 <a href="#">
                                    <div class="dot"></div>
                                    Description
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                    <div class="dot"></div>
                                    Additional information
                                 </a>
                              </li>
                              @if (!empty($existOrderProduct))
                                 <li>
                                    <a href="#">
                                       <div class="dot"></div>
                                       Reviews
                                    </a>
                                 </li>
                              @endif
                           </ul>
                        </div>
                        <div class="col-lg-12 col-md-12">
                           <div class="tab_content">
                              <div class="tabs_item">
                                 <div class="products-details-tab-content">
                                    <p>Design inspiration lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. Nullam sit amet enim. Suspendisse id velit vitae ligula volutpat condimentum.  Aliquam erat volutpat. Sed quis velit. Nulla facilisi. Nulla libero. Vivamus pharetra posuere sapien. Nam consectetuer. Sed aliquam, nunc eget euismod ullamcorper, lectus nunc ullamcorper orci, fermentum bibendum enim nibh eget ipsum. Nam consectetuer. Sed aliquam, nunc eget euismod ullamcorper, lectus nunc ullamcorper orci, fermentum bibendum enim nibh eget ipsum. Nulla libero. Vivamus pharetra posuere sapien.</p>
                                 </div>
                              </div>
                              <div class="tabs_item">
                                 <div class="products-details-tab-content">
                                    <ul class="additional-information">
                                       <li><span>Color:</span> Brown</li>
                                       <li><span>Size:</span> Large, Medium</li>
                                       <li><span>Weight:</span> 27 kg</li>
                                       <li><span>Dimensions:</span> 16 x 22 x 123 cm</li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="tabs_item">
                                 <div class="products-details-tab-content">
                                    <div class="product-review-form">
                                       <h3>Customer Reviews</h3>
                                       <div class="review-title">
                                          <div class="rating">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                          </div>
                                          <p>Based on 3 reviews</p>
                                          <a href="#" class="btn default-btn">Write a Review</a>
                                       </div>
                                       <div class="review-comments">
                                          @foreach ($productReviews as $productReview)
                                             <div class="review-item">
                                                @if ($productReview->rating == 5)
                                                   <div class="rating">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </div>
                                                @elseif ($productReview->rating == 4)
                                                   <div class="rating">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </div>
                                                @elseif ($productReview->rating == 3)
                                                   <div class="rating">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </div>
                                                @elseif ($productReview->rating == 2)
                                                   <div class="rating">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </div>
                                                @elseif ($productReview->rating == 1)
                                                   <div class="rating">
                                                      <i class="fa fa-star"></i>       
                                                   </div>
                                                @endif                                          
                                                <h3>{{ $productReview->title }}</h3>
                                                <span><strong>{{ @show_user_name($productReview->user_id) }}</strong> on <strong>{{ $productReview->created_at }}</strong></span>
                                                <p>{{ $productReview->comment }}</p>
                                                <a href="#" class="review-report-link">Report as Inappropriate</a>
                                             </div>
                                          @endforeach
                                       </div>
                                       @if (checkIfUserSubmitedReview($productDetail->id) != 1)    
                                          <div class="review-form">
                                             <h3>Write a Review</h3>
                                             <form id="productReviewForm" action="{{ route('product-review') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $productDetail->id }}">
                                                <div class="row">                               
                                                   <div class="col-lg-6 col-md-6">
                                                      <div class="form-group">
                                                         <label>Rating</label>
                                                         <select class="star-rating" name="rating">
                                                             <option value="">Select a rating</option>
                                                             <option value="5">Excellent</option>
                                                             <option value="4">Very Good</option>
                                                             <option value="3">Average</option>
                                                             <option value="2">Poor</option>
                                                             <option value="1">Terrible</option>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12 col-md-12">
                                                      <div class="form-group">
                                                         <label>Body of Review (1500)</label>
                                                         <textarea name="comment" id="review-body" cols="30" rows="3" placeholder="Write your comments here" class="form-control"></textarea>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12 col-md-12">
                                                      <button type="submit" id="productReviewBtn" class="btn default-btn">Submit Review</button>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Product Details Area -->
      <div class="box_products">
         <div class="flex justify-between relative md:mb-4 mb-3">
            <div class="flex-1">
               <h2 class="text-xl font-semibold">Our Related Product
               </h2>
               <p class="font-medium text-gray-500 leading-6" style="
                  padding-bottom: 20px;
                  "> </p>
               <hr>
            </div>
         </div>
         <div class="relative">
            <div class="uk-slider-container px-1 py-3">
               <div class="row">
               		@foreach ($relatedProducts as $relatedProduct)
	               		@php
		                   $unSerlizeProImage = unserialize($relatedProduct->image);
		                   $productImage = reset($unSerlizeProImage);
		                @endphp
		                  <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
		                     <div class="card">
		                        <div class="card-media h-44">
		                           <div class="card-media-overly"></div>
		                           <img src="{{ url("public/images/product/$productImage") }}" alt="image">
		                           <div style="display: inline-block;" data-toggle="tooltip" data-placement="top" title="Add to Collection">
		                              <a class="remove" href="#" aria-expanded="false"><i class="fa fa-bookmark" aria-hidden="true"></i>
		                              </a>
		                              <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small main-ss">
		                                 <div class="sidebar_innersss" data-simplebar="init">
		                                    <div class="simplebar-wrapper" style="margin: 0px;">
		                                       <div class="simplebar-height-auto-observer-wrapper">
		                                          <div class="simplebar-height-auto-observer"></div>
		                                       </div>
		                                       <div class="simplebar-mask">
		                                          <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
		                                             <div class="simplebar-content" style="padding: 0px; height: auto; overflow: hidden;">
		                                                <ul class="space-y-1 ">
		                                                   <li> summer collection 2021
		                                                   </li>
		                                                   <li> 
		                                                      winter collection 2020
		                                                   </li>
		                                                   <li> 
		                                                      Exclusive collection 
		                                                   </li>
		                                                </ul>
		                                             </div>
		                                          </div>
		                                       </div>
		                                       <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
		                                    </div>
		                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
		                                       <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
		                                    </div>
		                                    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
		                                       <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
		                                    </div>
		                                 </div>
		                              </div>
		                           </div>
		                           {!! addToWishlistButtonSection(Auth::user()->id, $relatedProduct->id) !!}
		                        </div>
		                        <div class="card-body">                          
		                              <div class="ext-lg font-medium mt-1 t truncate">
		                           		<a href="{{ route('product.detail', $relatedProduct->slug) }}">
		                           			{{ $relatedProduct->name }}
                                          <input type="hidden" id="productQuantity{{$relatedProduct->id}}" value="1" name="">
		                           		</a>
		                           	</div>
                                 @if ($relatedProduct->check_cart_status == 1)
                                    <div class="addToCartDiv{{ $relatedProduct->id }}">
                                       <a type="submit" class="absolute right-2 top-2 p-0.5 px-1.5 text-red-500 cart-icon-main" href="{{ route('cart') }}">
                                          Go To Cart
                                       </a>
                                    </div>
                                 @else
                                    <div class="addToCartDiv{{ $relatedProduct->id }}">
                                       <a href="javascript:void(0);" class="absolute right-2 top-2 p-0.5 px-1.5 text-red-500 cart-icon-main" id="addToCart" data-product="{{ $relatedProduct->id }}">
                                          Add to Cart
                                       </a>
                                    </div>
                                 @endif		                           
		                           <div class="text-xs font-semibold uppercase text-yellow-500">${{ $relatedProduct->price }}</div>
		                           <div class="ratings">
		                              <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
		                           </div>
		                        </div>
		                     </div>
		                  </div>
                	@endforeach
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
   $(document).ready(function(){
      $('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
         $('.tab ul.tabs li a').on('click', function (g) {
            var tab = $(this).closest('.tab'), 
            index = $(this).closest('li').index();
            tab.find('ul.tabs > li').removeClass('current');
            $(this).closest('li').addClass('current');
            tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
            tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
            g.preventDefault();
      });
      var starRatingControl = new StarRating('.star-rating',{
          tooltip: 'Select a Rating',
      });
   });

  // $(document).on('click', '#addProductToWishlist', function(){
  //   var productId = $(this).data('id');
  //   $.ajax({
  //       headers: {
  //           'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  //       },
  //       type: 'post',
  //       url: _baseURL + "/add-to-wishlist",
  //       data: { productId: productId },
  //       dataType: 'json',
  //       success: function (data) {
  //         console.log(data);
  //         if (data.erro == '101') {
  //             swal("", data.message, "success", {
  //                button: "close",
  //             });              
  //             $('.swal-button--confirm').on('click', function(){
  //                window.location.reload();
  //             });
  //          } else {
  //             swal("", data.message, "error", {
  //                button: "close",
  //             });              
  //          }
  //       }
  //   });
  // });

   $("#productReviewForm").validate({
      rules: {
         rating: {
            required: true,
         },
         comment: {
            required: true,
         },
      },
      messages: {
         rating: "Please enter your rating.",
         comment: "Please enter comment.",
      },
      submitHandler: function(forms,e) {
         e.preventDefault();
         var form = $('#productReviewForm')[0];
         var serializedData = new FormData(form);
         //var serializedData = $(form).serialize();
         $("#productReviewBtn").attr("disabled", true);
         $('#productReviewBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
         $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: "{{ url('product-review') }}",
            data: serializedData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
               
               $("#productReviewBtn").attr("disabled", false);

               $('#productReviewBtn').html('Post');

               if (data.erro == '101') {
                  swal("", data.message, "success", {
                     button: "close",
                  });

                  $("#productReviewForm").trigger('reset');
                  $(".review-form").addClass('d-none');
                  $(".review-comments").append(data.data);
                  
               } else {
                  swal("", data.message, "error", {
                     button: "close",
                  });
               }
            }
         });
         return false;
      }
   });
</script>
@endsection