@extends('layouts.app')
@section('content')
<div class="main_content">
   <div class="mcontainer">
      <div class="lg:flex lg:space-x-12">
         <div class="lg:w-2/3 flex-shirink-0">
            <div class="flex justify-between relative md:mb-4 mb-3">
               <div class="flex-1">
                  <h2 class="text-2xl font-semibold"> Notifications </h2>                  
               </div>
            </div>
            <ul class="card divide-y divide-gray-100 sm:m-0 -mx-5">
              @if (count($notifications) > 0)
                @foreach ($notifications as $notification)
                  @php
                    $friend = $notification->data['data']['sender_id'];
                    $userId= Crypt::encrypt($friend);
                  @endphp
                    <li>
                        <div class="flex items-start space-x-5 p-7 my-4">
                           <img src="{{ show_user_image($notification->data['data']['sender_id']) }}" alt="" class="w-12 h-12 rounded-full">
                           <div class="flex-1">
                              <a href="{{ $friend == Auth::user()->id ? route('my-profile') : route('time.line', $userId) }}" class="text-lg font-semibold line-clamp-1 mb-1">{{$notification->data['data']['body']}}</a>
                              <p class="text-sm text-gray-400 mb-2">{{ show_time_ago($notification->created_at) }}</p>                            
                              @if (isset($notification->data['data']['friendshipId']) && getUserById($friend)->user_friendship_status == 'pending')
                                <div class="my-1 followBackBtnSec">
                                  <a
                                    href="javascript:void(0);"
                                    id="followBack"
                                    data-id="{{$notification->data['data']['friendshipId']}}"
                                    data-user-id="{{$notification->data['data']['sender_id']}}"
                                    data-notification-id="{{$notification->id}}"
                                    class="btn btn-primary btn-sm"
                                  >Follow back</a>
                                  <a
                                    href="javascript:void(0);"
                                    id="deleteSenderRequest"
                                    data-id="{{$notification->data['data']['friendshipId']}}"
                                    data-notification-id="{{$notification->id}}"
                                    class="btn btn-secondary btn-sm"
                                  >Delete</a>
                                </div>                            
                              @endif
                           </div>
                        </div>
                    </li>
                @endforeach
              @endif
            </ul>
         </div>
      </div>
   </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript"></script>
@endsection