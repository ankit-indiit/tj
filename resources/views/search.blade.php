@extends('layouts.app')
@section('content')
<div class="main_content">
   <div class="mcontainer">
      <div class="my-2 flex items-center justify-between pb-3">
         <div>
            <h2 class="text-xl font-semibold {{ $searchBy == 'all' ? 'd-none' : '' }}">{{ ucfirst($searchBy) }}</h2>
            @php
               // echo '<pre>';
               // // foreach ($filteredData as $data) {
               // //    print_r($data->searchable);
               // // }
               // // print_r($filteredData->groupByType());
               // $query = '';
               // foreach ($filteredData->groupByType() as $type => $data) {
               //    $query = $type;
               //    // print_r($value);
               // }
               //    echo $query;
               // die;
            @endphp            
         </div>
      </div>
      @if ($searchBy == 'category')
         <hr>
         <div class="relative mb-4 uk-slider" uk-slider="finite: true">
            <div class="uk-slider-container px-1 py-3">
               <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid" style="transform: translate3d(0px, 0px, 0px);">
                  @foreach ($filteredData as $category)
                  @php
                     $category = $category->searchable == '' ? $category : $category->searchable;
                  @endphp
                  <li tabindex="-1" class="uk-active">
                     <a href="{{ route('category.show', $category->slug) }}">
                        <img src="{{ url("public/images/category/$category->feature_image") }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                        <div class="pt-2">
                           <h4 class="text-lg font-semibold">{{ $category->name }}</h4>
                        </div>
                     </a>
                  </li>
                  @endforeach
               </ul>
            </div>
         </div>
      @endif
      @if ($searchBy == 'product')
         <hr>
         <div class="relative">
            <div class="uk-slider-container px-1 py-3">
               <div class="row">
                  @foreach ($filteredData as $product)
                  @php
                     $product = $product->searchable == '' ? $product : $product->searchable;
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
                        </div>
                        <div class="card-body">
                           <a href="{{ route('product.detail', $product->slug) }}" class="ext-lg font-medium mt-1 t truncate">{{ $product->name }}</a>
                           {!! productCartButton($product->id) !!}
                           <div class="text-xs font-semibold uppercase text-yellow-500">
                              ${{ $product->discounted_price }}
                           </div>
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
      @endif
      
      @if ($searchBy == 'people')
         <div class="tab-pane active" id="messages" role="tabpanel" aria-labelledby="messages-tab">         
            <div class="row">
               @foreach ($filteredData as $user)
                  @php 
                     $user = $user->searchable == '' ? $user : $user->searchable;
                     $userId= Crypt::encrypt($user->id); 
                  @endphp                    
                     <div class="col-sm-6 followingUser">
                        <div class="flex justify-between items-center lg:p-4 p-2.5">
                           <div class="flex flex-1 items-center space-x-4">
                              <a href="{{ route('time.line', $userId) }}">
                              <img src="{{ show_user_image($user->id) }}" class="bg-gray-200 border border-white rounded-full w-10 h-10">
                              </a>
                              <div class="flex-1 font-semibold capitalize">
                                 <a href="{{ route('time.line', $userId) }}" class="text-black">{{ show_user_name($user->id) }}</a>
                              </div>
                                 @if (checkFriendshipPendingStatus($user->id) == 1)
                                    <div class="my-3 userFriendshipBtnSection{{ $user->id }}">
                                      <a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="{{ $user->id }}" data-status="pending" class="btn btn-primary btn-sm">Requested</a>
                                    </div> 
                                 @else
                                    <div class="my-3 userFriendshipBtnSection{{ $user->id }}">
                                       <a href="javascript:void(0);" id="followForFriendship" data-id="{{ $user->id }}" class="btn btn-primary btn-sm">Follow</a>
                                    </div> 
                                 @endif                          
                           </div>                     
                     </div>
                  </div>
               @endforeach
         </div>
      @endif

      @if ($searchBy == 'all' && $filteredData->groupByType())
         @foreach ($filteredData->groupByType() as $type => $data)
            @if ($type == 'products')
               <div class="relative">
                  <h2 class="text-xl font-semibold">Products</h2>
                  <div class="uk-slider-container px-1 py-3">
                     <div class="row">
                        @foreach ($data as $product)
                        @php
                           $unSerlizeProImage = unserialize($product->searchable->image);
                           $productImage = reset($unSerlizeProImage);
                        @endphp
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                           <div class="card">
                              <div class="card-media h-44">
                                 <div class="card-media-overly"></div>
                                 <img src="{{ url("public/images/product/$productImage") }}" alt="">
                                 <div class="product-wishlist-btn-section{{ $product->searchable->id }}">
                                    {!! addToWishlistButtonSection(Auth::user()->id, $product->searchable->id) !!}
                                 </div>
                              </div>
                              <div class="card-body">
                                 <a href="{{ route('product.detail', $product->searchable->slug) }}" class="ext-lg font-medium mt-1 t truncate">{{ $product->searchable->name }}</a>
                                 {!! productCartButton($product->searchable->id) !!}
                                 <div class="text-xs font-semibold uppercase text-yellow-500">
                                    ${{ $product->searchable->discounted_price }}
                                 </div>
                                 <div class="text-xs font-semibold ven-nam text-yellow-500">
                                    @foreach ($product->searchable->productCategoryId as $proCatId)
                                    <a href="{{ route('category.show', str_replace(' ', '-', strtolower(getProductCategoryNameById($proCatId->cat_id)))) }}">
                                    {{ getProductCategoryNameById($proCatId->cat_id) }}
                                    </a>
                                    @endforeach
                                 </div>
                                 <div class="ratings">
                                    {!! @showProductRating($product->searchable->id) !!}
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            @endif
            @if ($type == 'product_categories')
               <hr>
               <div class="relative mb-4 uk-slider" uk-slider="finite: true">
                  <h2 class="text-xl font-semibold">Categories</h2>
                  <div class="uk-slider-container px-1 py-3">
                     <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid" style="transform: translate3d(0px, 0px, 0px);">
                        @foreach ($data as $category)  
                        @php
                           $featureImage = $category->searchable->feature_image;                           
                        @endphp                                              
                        <li tabindex="-1" class="uk-active">
                           <a href="{{ route('category.show', $category->searchable->slug) }}">
                              <img src="{{ url("public/images/category/$featureImage") }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                              <div class="pt-2">
                                 <h4 class="text-lg font-semibold">{{ $category->searchable->name }}</h4>
                              </div>
                           </a>
                        </li>
                        @endforeach
                     </ul>
                  </div>
               </div>
            @endif
            @if ($type == 'users')
               <div class="tab-pane active" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                  <h2 class="text-xl font-semibold">People</h2>
                  <div class="row">
                     @foreach ($data as $user)
                        @php 
                           $userId= Crypt::encrypt($user->searchable->id); 
                        @endphp                    
                           <div class="col-sm-6 followingUser">
                              <div class="flex justify-between items-center lg:p-4 p-2.5">
                                 <div class="flex flex-1 items-center space-x-4">
                                    <a href="{{ route('time.line', $userId) }}">
                                    <img src="{{ show_user_image($user->searchable->id) }}" class="bg-gray-200 border border-white rounded-full w-10 h-10">
                                    </a>
                                    <div class="flex-1 font-semibold capitalize">
                                       <a href="{{ route('time.line', $userId) }}" class="text-black">{{ show_user_name($user->searchable->id) }}</a>
                                    </div>
                                       @if (checkFriendshipPendingStatus($user->searchable->id) == 1)
                                          <div class="my-3 userFriendshipBtnSection{{ $user->searchable->id }}">
                                            <a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="{{ $user->searchable->id }}" data-status="pending" class="btn btn-primary btn-sm">Requested</a>
                                          </div> 
                                       @else
                                          <div class="my-3 userFriendshipBtnSection{{ $user->searchable->id }}">
                                             <a href="javascript:void(0);" id="followForFriendship" data-id="{{ $user->searchable->id }}" class="btn btn-primary btn-sm">Follow</a>
                                          </div> 
                                       @endif                          
                                 </div>                     
                           </div>
                        </div>
                     @endforeach
               </div>
            @endif
         @endforeach
      @endif
   </div>
</div>
@endsection