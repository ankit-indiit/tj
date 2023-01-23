<div class="col-sm-3">
   <div class="card">
      <div class="card-media h-44">
         @php
            $unSerlizeProImage = unserialize($product->image);
            $productImage = reset($unSerlizeProImage);
         @endphp
         <div class="card-media-overly"></div>
         <img src="{{ url("public/images/product/$productImage") }}" alt="">
         <div class="main-tools" style="display: inline-block;" data-toggle="tooltip" data-placement="top" title="Edit Product">
            <a class="remove" href="#" aria-expanded="false"><i class="icon-feather-more-horizontal"></i>
            </a>
            <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop main-ss uk-drop-bottom-right" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small main-ss" style="left: -182px; top: -6px; height: 80px !important;">
               <div class="sidebar_innersss" data-simplebar="init">
                  <div class="simplebar-wrapper" style="margin: 0px;">
                     <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                     </div>
                     <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                           <div class="simplebar-content" style="padding: 0px; height: auto; overflow: hidden;">
                              <ul class="space-y-1 ">
                                 <li>
                                    <a href="{{ route('product.edit', $product->id) }}">Edit Product</a>
                                 </li>
                                 <li>
                                    <a href="javascript:void(0);" id="deleteSellerProductBtn" data-id="{{ $product->id }}">Delete Product</a>
                                 </li>                                 
                              </ul>
                           </div>
                        </div>
                     </div>                                             
                  </div>                                         
               </div>
            </div>
         </div>
         @if ($product->feature != 1)
            <div class="product-list feature-check-box">                                    
               <label class="cont">
                  <input type="checkbox" class="checkme addFeatureProduct" name="addFeatureProduct[]" value="{{ $product->id }}">
                  <span class="checkmark"></span>
               </label>
            </div>
         @endif
      </div>
      <div class="card-body">
         <a href="{{ route('product.detail', $product->slug) }}" class="ext-lg font-medium mt-1 t truncate"> {{ $product->name }} </a>
         <div class="featuredProduct">
            @if ($product->feature == 1)
               <a href="javascript:void(0);" id="removeFeatureProduct" data-id="{{ $product->id }}" class="absolute right-2 top-2 p-0.5 px-1.5 text-red-500 cart-icon-main">Featured</a>
            @endif                                    
         </div>
         <div class="text-xs font-semibold uppercase text-yellow-500">${{ $product->discounted_price }}</div>
         <div class="text-xs font-semibold ven-nam text-yellow-500">
            @foreach ($product->productCategoryId as $proCatId)
               <a href="{{ route('category.show', str_replace(' ', '-', strtolower(getProductCategoryNameById($proCatId->cat_id)))) }}">
                  {{ getProductCategoryNameById($proCatId->cat_id) }}
               </a>
            @endforeach
         </div>
         <div class="ratings">
            {!! @showProductRating($product->id) !!}
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).on('click', '.addFeatureProduct', function(){
      if (($('.addFeatureProduct:checkbox:checked').length) > 0) {
         $('.addFeatureProductBtn').removeClass('d-none');
      } else {
         $('.addFeatureProductBtn').addClass('d-none');
      }
   })
</script>