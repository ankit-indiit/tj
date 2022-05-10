@extends('layouts.app')
@section('content')
<div class="main_content timeline-page">
   <div class="mcontainer">      
      <div class="tab-pane active" id="messages" role="tabpanel" aria-labelledby="messages-tab">
            <div class="row mt-4">
               <div class="col-sm-3">
                  <h4 class="text-2xl mb-3 font-semibold ">{{ ucfirst($userStatus) }}</h4>                  
               </div>
               <div class="col-sm-9 pull-right">
                  <a href="#" class="text-black">
                     <div class="header_search" aria-expanded="false">
                        <input value="" type="text" id="searchUser" data-status="{{$userStatus}}" class="form-control" placeholder="Search for Friends.." autocomplete="off">
                        <i class="uil-search-alt"></i>
                     </div>
                  </a>
                  <div class="flex pull-right">
                     <a href="#" aria-expanded="false"> <i class="diff-icon icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
                     <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">
                        <a href="#" class="flex items-center px-3 py-2 text-black-500 hover:bg-gray-100 hover:text-gray-500 rounded-md dark:hover:bg-red-600 p-4">
                        <b>Select Audience</b>
                        </a>
                        <ul class="space-y-1">
                           <li> 
                              <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                              <i class="fa fa-users" aria-hidden="true"></i>
                              Friends
                              </a>  
                           </li>
                           <li> 
                              <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                              <i class="fa fa-globe" aria-hidden="true"></i>
                              Public
                              </a>  
                           </li>
                           <li> 
                              <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                              <i class="fa fa-lock" aria-hidden="true"></i> Only Me
                              </a>  
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row filteredUserData">
            	@foreach ($users as $user)
            		@php $userId= Crypt::encrypt($user); @endphp                    
	               	<div class="col-sm-6 followingUser">
	                  	<div class="flex justify-between items-center lg:p-4 p-2.5">
	                     	<div class="flex flex-1 items-center space-x-4">
		                        <a href="{{ route('time.line', $userId) }}">
		                        <img src="{{ show_user_image($user) }}" class="bg-gray-200 border border-white rounded-full w-10 h-10">
		                        </a>
		                        <div class="flex-1 font-semibold capitalize">
		                           <a href="{{ route('time.line', $userId) }}" class="text-black">{{ show_user_name($user) }}</a>
		                        </div>
		                        @if ($userStatus == 'suggestion')
		                        	@if (checkFriendshipPendingStatus($user) == 1)
			                        	<div class="my-3 userFriendshipBtnSection{{ $user }}">
						                    <a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="{{ $user }}" data-status="pending" class="btn btn-primary btn-sm">Requested</a>
						                </div> 
		                        	@else
		                        		<div class="my-3 userFriendshipBtnSection{{ $user }}">
								            <a href="javascript:void(0);" id="followForFriendship" data-id="{{ $user }}" class="btn btn-primary btn-sm">Follow</a>
								        </div> 
		                        	@endif
			                    @elseif ($userStatus == 'following')
			                    	<div>
			                             <a href="#" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
			                             <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">
			                                <ul class="space-y-1">
			                                    <li> 		                                       
			                                    </li>		                                
			                                   	<li>
			                                        <a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="{{ $user }}" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600"> <i class="uil-trash-alt mr-1"></i> Unfriend </a> 
			                                    </li>
			                                </ul>		                              
			                            </div>
			                        </div>
		                        @endif
	                     	</div>                     
	                  </div>
	               </div>
            	@endforeach
            </div>
         </div>
   </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
	$(document).on('keyup', '#searchUser', function(){
		var user = $(this).val();
		var searchFor = $(this).data('status');		
			$.ajax({
		        headers: {
		           'X-CSRF-Token': $('input[name="_token"]').val()
		        },    
		        type: 'get',
		        url: _baseURL + "/search-user",
		        data: { 
		            user: user,
		            searchFor: searchFor,
		        },
		        success: function (data) {
		        	var userData = '';
		        	if (user.length > 0) {
			        	$('.filteredUserData').html(data);
			        }
		         //   	$.each(data, function(index, value) {		           		
		         //   		if (searchFor == 'suggestion') {

		         //   			btnSection = '<a href="javascript:void(0);" id="followForFriendship" data-id="'+value.id+'" class="btn btn-primary btn-sm">Follow</a>';		           					           		
		         //   		} else if (searchFor == 'following' || searchFor == 'followers') {

		         //   			btnSection = '<div><a href="#" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a><div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small"><ul class="space-y-1"><li></li><li><a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="'+value.id+'" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600"><i class="uil-trash-alt mr-1"></i> Unfriend </a></li></ul></div></div>';			           		
		         //   		}
			            
			        //     userData += '<div class="col-sm-6 followingUser"><div class="flex justify-between items-center lg:p-4 p-2.5"><div class="flex flex-1 items-center space-x-4"> <a href=""> <img src="'+value.profile_image+'" class="bg-gray-200 border border-white rounded-full w-10 h-10"> </a> <div class="flex-1 font-semibold capitalize"> <a href="" class="text-black">'+value.name+'</a> </div>'+btnSection+'</div> </div> </div> </div>';
			        // });		           	
		        }            
		    });		
	});
</script>
@endsection