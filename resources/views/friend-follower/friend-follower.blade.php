@extends('layouts.app')
@section('content')
<div class="main_content frnds-page">
   <div class="mcontainer friends-following">      
      <div class="lg:flex lg:space-x-10">
         <div class="tab-content">
            <div class="">
               <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="relative uk-slider" uk-slider="finite: true">
                     <div class="uk-slider-container px-1 py-3 frdnds">
                        <div class="flex justify-between relative md:mb-4 mb-3">
                           <div class="flex-1">
                              <div class="sm:my-6 my-3 flex items-center justify-between ms">
                                 <div class="">
                                    <h2 class="text-xl font-semibold"> Following </h2>
                                 </div>
                                 <a href="{{ route('see.all-friendFollower', 'following') }}" class="text-blue-500 sm:block hidden"> See all </a>
                              </div>
                           </div> 
                        </div>
                        <ul class="uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid">
                           @foreach (userFriends() as $friend)
                              @php
                                 $profileRoute = route('my-profile').'?tab=feed';
                                 $userId= Crypt::encrypt($friend);
                              @endphp
                              <li id="followingUser">
                                 <div class="dropdown">
                                    <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                       <a class="dropdown-item" href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="{{ $friend }}" data-status="confirmed"> <i class="uil-trash-alt mr-1"></i>Unfollow</a>
                                    </div>
                                 </div>
                                 <a href="{{ $friend == Auth::user()->id ? $profileRoute : route('time.line', $userId) }}">
                                    <img src="{{ show_user_image($friend) }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                    <div class="pt-2">
                                       <h4 class="text-lg font-semibold">{{ show_user_name($friend) }}</h4>
                                    </div>
                                 </a>
                              </li>
                           @endforeach
                        </ul>
                        <div class="flex justify-between relative md:mb-4 mb-3">
                           <div class="flex-1">
                              <div class="sm:my-6 my-3 flex items-center justify-between ms">
                                 <div class="">
                                    <h2 class="text-xl font-semibold"> Followers</h2>
                                 </div>
                                 <a href="{{ route('see.all-friendFollower', 'followers') }}"  class="text-blue-500 sm:block hidden"> See all </a>
                              </div>
                           </div>
                        </div>
                        <ul class="uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid">
                           @foreach (userFollowers() as $follower)
                              @php
                                 $profileRoute = route('my-profile').'?tab=feed';
                                 $userId= Crypt::encrypt($follower);
                              @endphp
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="{{ $follower == Auth::user()->id ? $profileRoute : route('time.line', $userId) }}">
                                 <img src="{{ show_user_image($follower) }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold">{{ show_user_name($follower) }}</h4>
                                 </div>
                              </a>
                           </li>
                           @endforeach
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="lg:w-1/3 w-full">
            <div uk-sticky="media @m ; offset:80 ; bottom : true">
               <div class="flex justify-between relative md:mb-4 mb-3 mt-4">
                  <div>
                     <h2 class="text-xl font-semibold">Suggestions</h2>
                  </div>
                  <a href="{{ route('see.all-friendFollower', 'suggestion') }}" class="text-blue-500"> See all </a>
               </div>
               <div class="mt-1">
                  @foreach (getAllUserIds() as $user)
                     @php $userId= Crypt::encrypt($user); @endphp
                     @if (getUserById($user)->user_friendship_status != 'pending')
                        <div class="flex items-center space-x-4 rounded-md -mx-2 p-2 suggestion-list-{{$user}} ">
                           <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                              <img src="{{ show_user_image($user) }}" class="absolute w-full h-full inset-0 rounded-md" alt="">
                           </div>
                           <div class="flex-1 suggestion">
                              <a href="{{ route('time.line', $userId) }}" class="text-md font-semibold capitalize">{{ show_user_name($user) }}</a>
                              <div class="text-sm text-gray-500 mt-0.5"> {{count(userFriends())}} Following</div>
                           </div>
                              <a href="javascript:void(0);" id="followForFriendship" data-id="{{$user}}" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold">Follow</a>
                        </div>
                     @endif
                  @endforeach
               </div>
               <a href="{{ route('see.all-friendFollower', 'suggestion') }}" class="bg-gray-200 flex flex-1 h-8 items-center justify-center rounded-md capitalize mt-2"> 
               See all 
               </a>
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