@extends('layouts.app')
@section('content')
<div class="main_content">
   <div class="mcontainer">
      <div class="flex justify-between relative md:mb-4 mb-3">
         <div class="flex-1">
            <h2 class="text-2xl font-semibold"> Feature Shops </h2>
            <nav class="responsive-nav border-b md:m-0 -mx-4">
               <ul>
                  <li class="active"><a href="#" class="lg:px-2">   Suggestions </a></li>
                  <li><a href="#" class="lg:px-2"> Newest </a></li>
                  <li><a href="#" class="lg:px-2"> My Shops </a></li>
               </ul>
            </nav>
         </div>
         <a href="create-group.html" class="flex items-center justify-center h-9 lg:px-5 px-2 rounded-md bg-blue-600 text-white space-x-1.5 absolute right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
               <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
            </svg>
            <span class="md:block hidden"> Create </span>
         </a>
      </div>
      <div class="relative uk-slider" uk-slider="finite: true">
         <div class="uk-slider-container px-1 py-3">
            <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-grid-small uk-grid" style="transform: translate3d(0px, 0px, 0px);">
               @foreach (showAllShop() as $shop)
                  <li tabindex="-1" class="uk-active">
                     <div class="card">
                        <div class="card-media h-28">
                           <div class="card-media-overly"></div>
                           <img src="{{ $shop->image }}" alt="" class="">
                           <div class="absolute bg-red-100 font-semibold px-2.5 py-1 rounded-lg text-red-500 text-xs top-2.5 left-2.5"> </div>
                        </div>
                        <div class="card-body">
                           <a href="{{ route('shop.detail', $shop->id) }}" class="font-semibold text-lg truncate">
                              {{ $shop->shop_name }}
                           </a>
                           <div class="flex items-center flex-wrap space-x-1 mt-1 text-sm text-gray-500 capitalize">
                              <a href="#"> <span> {{getShopMemberCount($shop->id)}} members </span> </a>
                              <a href="#"> <span> 1.7k post a day </span> </a>
                           </div>
                           {!! getShopMemberSection($shop->id) !!}
                           @if (checkFollowShopStatus($shop->id) == 1)
                              <div class="flex mt-3.5 space-x-2 text-sm font-medium shopJoinUnjoinSection{{$shop->id}}">
                                 <a href="javascript:void(0);" class="bg-blue-600 flex flex-1 h-8 items-center justify-center rounded-md text-white capitalize unFollowShop{{$shop->id}}" id="unFollowShop" data-id="{{$shop->id}}"> 
                                 Joined 
                                 </a>
                              </div>
                           @else
                              <div class="flex mt-3.5 space-x-2 text-sm font-medium shopJoinUnjoinSection{{$shop->id}}">
                                 <a href="javascript:void(0);" class="bg-blue-600 flex flex-1 h-8 items-center justify-center rounded-md text-white capitalize followShop{{$shop->id}}" id="followShop" data-id="{{$shop->id}}"> 
                                 Join 
                                 </a>
                                 <a href="{{ route('shop.detail', $shop->id) }}" class="bg-gray-200 flex flex-1 h-8 items-center justify-center rounded-md capitalize"> 
                                 View 
                                 </a>
                              </div>
                           @endif
                        </div>
                     </div>
                  </li>
               @endforeach
            </ul>
            <a class="absolute bg-white bottom-1/2 flex items-center justify-center p-2 -left-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white uk-invisible" href="#" uk-slider-item="previous"> <i class="icon-feather-chevron-left"></i></a>
            <a class="absolute bg-white bottom-1/2 flex items-center justify-center p-2 -right-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="next"> <i class="icon-feather-chevron-right"></i></a>
         </div>
      </div>      
   </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script></script>
@endsection