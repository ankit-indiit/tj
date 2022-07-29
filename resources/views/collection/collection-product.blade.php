@extends('layouts.app')
@section('content')
<div class="main_content">
   <div class="mcontainer">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('collection.index') }}">Collection</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              {{ str_replace('-', ' ', ucfirst(Request::segment(2))) }}
            </li>
         </ol>
      </nav>
      
      <hr>      
      <div class="row">
         <div class="col-lg-12">
            <div class="relative">
               <div class="uk-slider-container px-1 py-3">
                  <div class="row">
                     @foreach ($products as $product)
                        @php
                           $unSerlizeProImage = unserialize($product->image);
                           $productImage = reset($unSerlizeProImage);
                        @endphp
                        <div class="col-sm-3">
                           <div class="card">
                              <div class="card-media h-44">
                                 <div class="card-media-overly"></div>
                                 <img src="{{ url("public/images/product/$productImage") }}" alt="">
                                 <div class="product-list"> 
                                    <label class="cont">
                                    <input type="checkbox" class="checkme">
                                    <span class="checkmark"></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <a href="{{ route('product.detail', $product->slug) }}" class="ext-lg font-medium mt-1 t truncate"> {{ $product->name }} </a>
                                 <div class="text-xs font-semibold uppercase text-yellow-500">${{ $product->discounted_price }}</div>
                                 <div class="text-xs font-semibold ven-nam text-yellow-500">
                                    @foreach ($product->productCategoryId as $proCatId)
                                       <a href="shop-timeline.html">
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
   </div>
</div>
@endsection

@section('customScripts')
{{-- <script src="{{ asset('js/jquery.validate.min.js') }}"></script> --}}
<script type="text/javascript">

</script>
@endsection