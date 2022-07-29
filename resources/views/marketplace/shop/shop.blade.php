@extends('layouts.app')
@section('content')
<div class="main_content">
   <div class="mcontainer">
      <div class="my-2 flex items-center justify-between pb-3">
         <div>
            <h2 class="text-xl font-semibold"> Categories</h2>
         </div>
      </div>
      <hr>
      <div class="relative mb-4 uk-slider" uk-slider="finite: true">
         <div class="uk-slider-container px-1 py-3">
            <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid" style="transform: translate3d(0px, 0px, 0px);">
              @foreach ($productCategories as $productCategory)
                <li tabindex="-1" class="uk-active">
                  <a href="{{ route('category.show', $productCategory->slug) }}">
                     <img src="{{ url("public/images/category/$productCategory->feature_image") }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                     <div class="pt-2">
                        <h4 class="text-lg font-semibold">{{ $productCategory->name }}</h4>
                     </div>
                  </a>
                </li>
              @endforeach
            </ul>
            <a class="absolute bg-white bottom-1/2 flex items-center justify-center p-2 -left-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white uk-invisible" href="#" uk-slider-item="previous"> <i class="icon-feather-chevron-left"></i></a>
            <a class="absolute bg-white bottom-1/2 flex items-center justify-center p-2 -right-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="next"> <i class="icon-feather-chevron-right"></i></a>
         </div>
      </div>
      <div class="my-2 flex items-center justify-between pb-3 mt-62">
         <div>
            <h2 class="text-xl font-semibold">Products</h2>
         </div>
      </div>
      <hr>
      <div class="relative">
         <div class="uk-slider-container px-1 py-3">
            <div class="row">
              @foreach ($products as $product)
                @php
                  $unSerlizeProImage = unserialize($product->image);
                  $productImage = reset($unSerlizeProImage);
                @endphp
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                  <div class="card">
                     <div class="card-media h-44">
                        <div class="card-media-overly"></div>
                        <img src="{{ url("public/images/product/$productImage") }}" alt="">
                        <div class="product-wishlist-btn-section{{ $product->id }}">
                          {!! addToWishlistButtonSection(Auth::user()->id, $product->id) !!}
                        </div>                                       
                        <a href="" class="ad_to_colletion_btn" data-toggle="modal" data-target="#exampleModal"><i class="icon-feather-layers" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Collection"> </i></a>
                     </div>
                     <div class="card-body">
                        <a href="{{ route('product.detail', $product->slug) }}" class="ext-lg font-medium mt-1 t truncate">{{ $product->name }}</a>
                        {!! productCartButton($product->id) !!}
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
              @endforeach
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
  
</script>
@endsection