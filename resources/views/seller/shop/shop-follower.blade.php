@extends('layouts.app')
@section('content')
<div class="main_content timeline-page">
   <div class="mcontainer">
      <div class="profile user-profile bg-white rounded-2xl -mt-4">
         <div class="profiles_banner">
            <img src="{{ $shopDetails->image }}" alt="">
            <div class="profile_action absolute bottom-0 right-0 space-x-1.5 p-3 text-sm z-50 hidden lg:flex">               
            </div>
         </div>
         <div class="profiles_content">
            <div class="profile_avatar">
            </div>
            <div class="profile_info">
               <h1>{{ $shopDetails->shop_name }}</h1>
               Public group · {{$shopDetails->followers_count}} members
            </div>
         </div>
         <div class="flex justify-between lg:border-t flex-col-reverse lg:flex-row px-4">
            <div class="lg:w-1/3 w-full">
               <div uk-sticky="media @m ; offset:80 ; bottom : true">
                  <div class="flex justify-between relative md:mb-4 mb-3 mt-4">
                     <div>
                        <h2 class="text-xl font-semibold">Followers</h2>
                     </div>
                  </div>
                  <div class="mt-1">
                     @foreach ($shopMembers as $shopMember)
                        @php $userId= Crypt::encrypt($shopMember); @endphp
                           <div class="flex items-center space-x-4 rounded-md -mx-2 p-2">
                              <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                                 <img src="{{ show_user_image($shopMember) }}" class="absolute w-full h-full inset-0 rounded-md" alt="">
                              </div>
                              <div class="flex-1 suggestion">
                                 <a href="{{ $shopMember == Auth::user()->id ? route('my-profile') : route('time.line', $userId) }}" class="text-md font-semibold capitalize">{{ show_user_name($shopMember) }}</a>
                                 <div class="text-sm text-gray-500 mt-0.5"> {{count(userFriends())}} Following</div>
                              </div>
                                 {{-- <a href="javascript:void(0);" id="followForFriendship" data-id="{{$shopMember}}" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold">Follow</a> --}}
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
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
   
</script>
@endsection