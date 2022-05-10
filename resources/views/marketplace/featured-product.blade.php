@extends('layouts.app')
@section('content')
<div class="main_content">
   <div class="mcontainer pro-th">
      <div class="flex justify-between relative md:mb-4 mb-3">
         <div class="flex-1">
            <div class="sm:my-6 my-3 flex items-center justify-between ms">
               <div class="">
                  <h2 class="text-xl font-semibold"> Featured Products </h2>
               </div>
               <a href="shop-1.html" class="text-blue-500 sm:block hidden"> See all </a>
            </div>
         </div>
      </div>
      <div class="relative uk-slider" uk-slider="finite: true">
         <div class="uk-slider-container px-1 py-3">
            <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-1 uk-grid-small uk-grid" style="transform: translate3d(0px, 0px, 0px);">
              @foreach ($products as $product)
                @php
                  $unSerlizeProImage = unserialize($product->image);
                  $productImage = reset($unSerlizeProImage);
                @endphp
                <li tabindex="-1" class="uk-active">
                    <div class="card">
                       <div class="card-media h-44">
                          <div class="card-media-overly"></div>
                          <img src="{{ url("public/images/product/$productImage") }}" alt="">
                          <div class="product-wishlist-btn-section{{ $product->id }}">
                            {!! addToWishlistButtonSection(Auth::user()->id, $product->id) !!}
                          </div>  
                       </div>
                       <div class="card-body">
                          <div class="ext-lg font-medium mt-1 t truncate">{{ $product->name }}</div>
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
                </li>
              @endforeach
            </ul>
            <a class="absolute bg-white bottom-1/2 flex items-center justify-center p-2 -left-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white uk-invisible" href="#" uk-slider-item="previous"> <i class="icon-feather-chevron-left"></i></a>
            <a class="absolute bg-white bottom-1/2 flex items-center justify-center p-2 -right-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="next"> <i class="icon-feather-chevron-right"></i></a>
         </div>
      </div>
      <br>
      
      
   </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript"></script>
@endsection