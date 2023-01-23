@extends('layouts.app')
@section('content')
<div class="main_content timeline-page">
   <div class="mcontainer">
      <div class="profile user-profile bg-white rounded-2xl -mt-4">
         <div class="profiles_banner">
            <img src="{{ url('public/profile/cover/') }}/{{ $userProfile->cover_image ? $userProfile->cover_image : 'download.png' }}" alt="">
            <div class="profile_action absolute bottom-0 right-0 space-x-1.5 p-3 text-sm z-50 hidden lg:flex">
            </div>
         </div>
         <div class="profiles_content">
            <div class="profile_avatar">
               <div class="profile_avatar_holder"> 
                  <img src="{{ show_user_image($userProfile->id) }}" alt="">
               </div>
               <div class="user_status status_online"></div>
               <div class="icon_change_photo" hidden="">
                  <ion-icon name="camera" class="text-xl md hydrated" role="img" aria-label="camera"></ion-icon>
               </div>
            </div>
            <div class="profile_info">
              <h1>{{ $userProfile->name }}</h1>
              <div class="userFriendshipBtnSection">                
                {!! @userFollowUnFollowButtonSection($userProfile->id) !!}
              </div>           
              </div>
         </div>
         <div class="flex justify-between lg:border-t flex-col-reverse lg:flex-row">
            <nav class="cd-secondary-nav pl-2 is_ligh -mb-0.5 border-transparent">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Timeline</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link " id="pics-tab" data-toggle="tab" href="#user-photos" role="tab" aria-controls="pics" aria-selected="true">Photos</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Friends</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">About</a>
                  </li>
               </ul>
            </nav>
         </div>
      </div>
      <div class="tab-content">
         <div class="lg:flex lg:mt-8 mt-4 lg:space-x-8 tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="space-y-5 flex-shrink-0 lg:w-7/12">               
              @php $user_posts = user_posts($userId); @endphp
              @if(count($user_posts) > 0)
                @foreach($user_posts as $posts)
                    @if($posts->post_type == 1)
                        @include('layouts.templates.simplepost' , array('post'=>$posts))
                    @elseif(($posts->post_type == 2))
                        @include('layouts.templates.pollpost', array('post'=>$posts))
                    @elseif(($posts->post_type == 3))
                        @include('layouts.templates.productpost', array('post'=>$posts))
                    @elseif(($posts->post_type == 4))
                        @include('layouts.templates.suggestionpost', array('post'=>$posts))
                    @endif
                @endforeach              
                <div class="flex justify-center mt-6">
                  <a href="#" class="bg-white dark:bg-gray-900 font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white"> Load more ..</a>
                </div>
              @else
                <div class="flex justify-center mt-6">
                   No post found
                </div>
              @endif


            </div>
            <div class="lg:w-4/12 space-y-6">
               <div class="widget">
                  <h4 class="text-2xl mb-3 font-semibold">About</h4>                  
                  <ul class="text-gray-600 space-y-4">
                     @if(count($address) > 0)
                        @switch(getUserPrivacy($userId))
                           @case('public')
                              @foreach($address as $addr)
                                 <li>{{  $addr->title }}</li>
                                 <li>{{  $addr->first_name }} {{  $addr->last_name }}</li>
                                 <li>{{  $addr->phone_no }}</li>
                                 <li>{{  $addr->Address }}, {{  $addr->nicename }}</li>
                              @endforeach
                           @break
                           @case('friends')
                              @if (userFriends($userId) && in_array(Auth::id(), userFriends($userId)))
                                 @foreach($address as $addr)
                                    <li>{{  $addr->title }}</li>
                                    <li>{{  $addr->first_name }} {{  $addr->last_name }}</li>
                                    <li>{{  $addr->phone_no }}</li>
                                    <li>{{  $addr->Address }}, {{  $addr->nicename }}</li>
                                 @endforeach
                              @else
                                 <span>This account is private!</span>                              
                              @endif
                           @break                                                  
                           @case('only_me')
                              @if (Auth::id() == $userId)
                                 @foreach($address as $addr)
                                    <li>{{  $addr->title }}</li>
                                    <li>{{  $addr->first_name }} {{  $addr->last_name }}</li>
                                    <li>{{  $addr->phone_no }}</li>
                                    <li>{{  $addr->Address }}, {{  $addr->nicename }}</li>
                                 @endforeach
                              @else
                                 <span>This account is private!</span>
                              @endif
                           @break
                        @endswitch                        
                     @endif
                  </ul>
               </div>
               <div class="widget border-t pt-4">
                  <div class="flex items-center justify-between mb-4">
                     <div>
                        <h4 class="text-2xl -mb-0.5 font-semibold"> Friends </h4>
                        <p>{{ userFriends($userId) != '' ? count(userFriends($userId)) : 0}} Friends</p>
                     </div>
                    @if (userFriends($userId) != '' && count(userFriends($userId)) > 0)
                      <a href="{{ route('see.all-friendFollower', 'following') }}" class="text-blue-600 ">See all</a>
                     @endif
                  </div>
                  <div class="grid grid-cols-3 gap-3 text-gray-600 font-semibold">
                     @if (userFriends($userId) != '' && count(userFriends($userId)) > 0)
                        @foreach (userFriends($userId) as $friend)
                           @php $userId= Crypt::encrypt($friend); @endphp
                           <a href="{{ $friend == Auth::user()->id ? route('my-profile') : route('time.line', $userId) }}">
                              <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                                 <img src="{{ show_user_image($friend) }}" alt="" class="w-full h-full object-cover absolute" />
                              </div>
                              <div>{{ show_user_name($friend) }}</div>
                           </a>
                        @endforeach
                     @else
                        No user found!
                     @endif
                </div>
                @if (userFriends($userId) != '' && count(userFriends($userId)) > 0)
                  <a href="#" class="bg-gray-100 py-2.5 text-center font-semibold w-full mt-4 block rounded"> See all </a>
                @endif
               </div>
            </div>
         </div>
         <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row mt-4">
               <div class="col-12">
                  <h4 class="text-2xl mb-3 font-semibold">About</h4>
                    
                    <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
                   <span id="succes_mess" style="color: green;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
                    <form method="POST" action="{{ url('update-profile') }}" id="updateProfileForm">
                            @csrf
                      <div class="name-info">
                         <div class="row">
                           <div class="col-sm-1">
                              <i class="fas fa-user"></i> 
                           </div>
                           <div class="col-sm-10 pull-right">
                              {{ $userProfile->name }}
                           </div>
                         </div>
                      </div>
                      <div class="name-info">
                         <div class="row">
                           <div class="col-sm-1">
                              <i class="fa fa-envelope" aria-hidden="true"></i>
                           </div>
                           <div class="col-sm-10 pull-right">
                              {{ $userProfile->email }}
                           </div>
                         </div>
                      </div>

                      <div class="name-info">
                         <div class="row">
                            <div class="col-sm-1">
                               <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <div class="col-sm-10 pull-right">
                                {{ $userProfile->phone_no }}
                                {{ $userProfile->country_code }}
                            </div>
                         </div>
                      </div>                      
                     </form>    
               </div>
            </div>
            <div class="row mt-4">
               <div class="col-12">
                  <h4 class="text-xl mb-3 font-semibold">Addresses</h4>
                  <div class="name-info" id="addressList">                    
                     @if(count($address) > 0)
                        @foreach($address as $addr)
                           <div id="editAddress_{{ $addr->id }}">
                           <div class="row" style="margin-top: 14px;">
                              <div class="col-sm-12"><span class="badge badge-secondary">{{  $addr->title }}</span></div>
                           </div>
                           <div class="row">
                              <div class="col-sm-4">
                                 <a href="#" class="name-fld"><b>{{  $addr->first_name }} {{  $addr->last_name }}</b></a>
                              </div>                        
                           </div>
                           <div class="row">
                              <div class="col-sm-4">
                                 <a href="javascript:void(0);" class="name-fld">{{  $addr->phone_no }}</a>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-4">
                                 <a href="javascript:void(0);" class="name-fld">{{  $addr->Address }}, {{  $addr->nicename }}</a>
                              </div>
                           </div>
                           <hr />
                         </div>                                                           
                        @endforeach
                     @endif
                  </div>
               </div>
            </div>            
         </div>
         <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
            <!-- post header-->
            <div class="row mt-4">
               <div class="col-sm-3">
                  <h4 class="text-2xl mb-3 font-semibold "> Friends </h4>
               </div>
               <div class="col-sm-9 pull-right">
                  <div class="header_search" aria-expanded="false">
                     <input
                        type="text"
                        class="form-control"
                        placeholder="Search for Friends.."
                        autocomplete="off"
                        id="searchUser"
                        data-status="following"
                     >
                     <i class="uil-search-alt"></i>
                  </div>
               </div>
            </div>
            <div class="row filteredUserData">
               @if (userFriends($userProfile->id) != '' && count(userFriends($userProfile->id)) > 0)
               @foreach (userFriends($userProfile->id) as $friend)
                  @php $userId= Crypt::encrypt($friend); @endphp
                   <div class="col-sm-6">
                      <div class="flex justify-between items-center lg:p-4 p-2.5">
                         <div class="flex flex-1 items-center space-x-4">
                            <a href="{{ $friend == Auth::user()->id ? route('my-profile') : route('time.line', $userId) }}">
                            <img src="{{ show_user_image($friend) }}" class="bg-gray-200 border border-white rounded-full w-10 h-10" />
                            </a>
                            <div class="flex-1 font-semibold capitalize">
                               <a href="{{ $friend == Auth::user()->id ? route('my-profile') : route('time.line', $userId) }}" class="text-black">{{ show_user_name($friend) }}</a>
                            </div>
                         </div>                         
                      </div>
                   </div>
               @endforeach
               @else
                  No User Found!
               @endif
            </div>
         </div>
         <div class="tab-pane photos-page" id="user-photos" role="tabpanel" aria-labelledby="user-photos-tab">
            <div class="tab-pane active" id="pics" role="tabpanel" aria-labelledby="pics-tab">
               <div class="flex justify-between relative md:mb-4 mb-3">
                  <div class="flex-1">
                     <h2 class="text-xl font-semibold mt-4"> Photos </h2>
                     <nav class="cd-secondary-nav border-b md:m-0 -mx-4">
                        <ul>
                           <li class="active"><a href="#" class="lg:px-2">  Photos of you  <span> {{ count($userPhotos) }}</span> </a></li>
                        </ul>
                     </nav>
                  </div>
               </div>
               <div class="grid md:grid-cols-4 grid-cols-2 gap-3 mt-5">
                  @foreach ($userPhotos as $userPhoto)
                     @if ($userPhoto != NULL)
                        <div>
                           <div id="photosOfYou" class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                              <img src="{{ url("public/posts/images/$userPhoto") }}" class="w-full h-full absolute object-cover inset-0">
                              <!-- overly-->
                              <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                           </div>
                        </div>
                     @endif
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
<script type="text/javascript"></script>
@endsection