@extends('layouts.app-without-sidebar')
@section('content')
<div class="main_contentssss chat-page">
   <div class="container-fluid m-auto pt-5">
      <div class="lg:flex lg:shadow lg:bg-white lg:space-y-0 space-y-8 rounded-md lg:-mx-0 -mx-5 overflow-hidden lg:dark:bg-gray-800">
         <!-- left message-->
         <div class="lg:w-4/12 bg-white border-r  dark:bg-gray-800 dark:border-gray-600 dropdown_scrollbar" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
               <div class="simplebar-height-auto-observer-wrapper">
                  <div class="simplebar-height-auto-observer"></div>
               </div>
               <div class="simplebar-mask">
                  <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                     <div class="simplebar-content" style="padding: 0px; height: auto; overflow: hidden;">
                        <h1 class="font-semibold lg:mb-6 mb-3 text-2xl px-4 py-4 msg-head"> Chat</h1>
                        <!-- search-->
                        <div class="border-b px-4 py-4 dark:border-gray-600">
                           <div class="bg-gray-100 input-with-icon rounded-md dark:bg-gray-700">
                              <input id="autocomplete-input" type="text" onkeyup="searchUser();" placeholder="Search" class="bg-transparent max-h-10 shadow-none">
                              <i class="icon-material-outline-search"></i>
                           </div>                          
                        </div>
                        <!-- user list-->
                        <div class="pb-16 w-full">
                           <ul class="dark:text-gray-100">
                              <li class="" id="searchedUser"></li>
                              @foreach ($listUsers as $user)                                 
                                 <li>
                                    <a href="javascript:void(0);" onclick="userThread({{$user}})" data-id="{{ $user }}" class="block flex items-center py-3 px-4 space-x-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                       <div class="w-12 h-12 rounded-full relative flex-shrink-0">
                                          <img src="{{ show_user_image($user) }}" alt="" class="absolute h-full rounded-full w-full">
                                          <span class="absolute bg-green-500 border-2 border-white bottom-0 h-3 m-0.5 right-0 rounded-full shadow-md w-3"></span>
                                       </div>
                                       <div class="flex-1 min-w-0 relative text-gray-500">
                                          <h4 class="text-black font-semibold dark:text-white">{{ show_user_name($user) }}</h4>
                                          <span class="absolute right-0 top-1 text-xs">Sun</span>
                                          <p class="truncate">{{getLastMessage($user)}}</p>
                                       </div>
                                    </a>
                                 </li>
                              @endforeach
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="simplebar-placeholder" style="width: 440px; height: 593px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
               <div class="simplebar-scrollbar simplebar-visible" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
               <div class="simplebar-scrollbar simplebar-visible" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
            </div>
         </div>
         <!--  message-->
         <div class="lg:w-8/12 bg-white dark:bg-gray-800 mt-6 dropdown_scrollbar userThreadData">
            @if (!empty($userchat))
              @include('chat.component.single-thread');
            @else
              Start Chat
            @endif
         </div>
      </div>
   </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
   function userThread(userId)
   {
       // var userId = $(this).data('id');
       $.ajax({
           headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
           },    
           type: 'get',
           url: _baseURL + "/user-chat",
           data: { 
               userId: userId,
           },
           success: function (data) {
              var uri = window.location.href.toString();
              if (uri.indexOf("?") > 0) {
                  var clean_uri = uri.substring(0, uri.indexOf("?"));
                  window.history.replaceState({}, document.title, clean_uri);
              }
              $('.userThreadData').html(data);       
           }            
       });

   }
   function searchUser(){
      var name = $('#autocomplete-input').val();
      $.ajax({
           headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
           },    
           type: 'get',
           url: _baseURL + "/search-user-for-chat",
           data: { 
               name: name,
           },
           success: function (data) {
               if (data.success == '101') {
                  $('#searchedUser').removeClass('d-none')
                  $('#searchedUser').html(data.data);       
               } else {
                  $('#searchedUser').addClass('d-none');
               }
           }            
       });
   }

   $(document).on('click', '#deleteConversation', function(){
      var userId = $(this).data('id');
      $.ajax({
           headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
           },    
           type: 'post',
           url: _baseURL + "/delete-conversation",
           data: { 
               userId: userId,
           },
           dataType: 'json',
           success: function (data) {
               if (data.erro == '101') {
                  swal("", data.message, "success", {
                     button: "close",
                  });
                  userThread(userId);
               } else {
                  swal("", data.message, "error", {
                     button: "close",
                  });
               }
           }            
       });
   });
</script>
@endsection