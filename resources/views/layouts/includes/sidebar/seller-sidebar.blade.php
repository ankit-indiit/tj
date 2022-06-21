<div class="sidebar">
   <div class="sidebar_inner" data-simplebar="init">
      <div class="simplebar-wrapper" style="margin: -5px -13px;">
         <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
         </div>
         <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
               <div class="simplebar-content" style="padding: 5px 13px; height: 100%; overflow: hidden scroll;">
                  <div class=" bg-white rounded-2xl -mt-4">
                     <div class="profile_avatar">
                        <div class="profile_avatar_holder"> 
                           <img src="{{ show_user_image() }}" alt="">
                        </div>
                        <div class="user_status status_online"></div>
                        <div class="icon_change_photo" hidden="">
                           <ion-icon name="camera" class="text-xl md hydrated" role="img" aria-label="camera"></ion-icon>
                        </div>
                     </div>
                  </div>
                  <ul>
                     <li class=""><a href="{{ route('my-profile') }}"> 
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span> Dashboard </span> </a> 
                     </li>
                     <li class="feed-home"><a href="{{ route('feed') }}"> 
                        <i class="fa fa-rss" aria-hidden="true"></i>
                        <span> Feed </span> </a> 
                     </li>
                     <li class=""><a href="{{ route('seller.order') }}"> 
                        <i class="fa fa-gift" aria-hidden="true"></i>
                        <span> Orders </span> </a> 
                     </li>
                     <li class=""><a href="{{ route('inventory') }}"> 
                        <i class="fa fa-codepen" aria-hidden="true"></i>
                        <span> Inventory </span> </a> 
                     </li>
                     <li class=""><a href="{{ route('switch-as') }}"> 
                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                        <span> Switch to buyer </span> </a> 
                     </li>
                  </ul>
                  <li class="active-submenu" hidden="">
                     <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="text-pink-500">
                           <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path>
                        </svg>
                        <span>  Games </span>
                     </a>
                     <ul>
                        <li><a href="dashboard-manage-jobs.html">Manage Jobs <span class="nav-tag">3</span></a></li>
                        <li><a href="dashboard-manage-candidates.html">Manage Candidates</a></li>
                        <li><a href="dashboard-post-a-job.html">Post a Job</a></li>
                     </ul>
                  </li>
                  <hr>
                  <h3 class="text-lg mt-3 font-semibold ml-2 is-title"> Online Friends </h3>
                  <div class="contact-list mt-2 ml-1">
                     
                     @foreach (getOnlineUsers() as $onlineUser)
                        @php $userId= Crypt::encrypt($onlineUser->id); @endphp
                        <a href="{{ route('time.line', $userId) }}">
                            <div class="contact-avatar">
                                <img src="{{ $onlineUser->profile_image }}" alt="">
                                <span class="user_status status_online"></span>
                            </div>
                            <div class="contact-username">{{ $onlineUser->name }}</div>
                        </a>
                     @endforeach

                  </div>
                  <br>
                  <br>
               </div>
            </div>
         </div>
         <div class="simplebar-placeholder" style="width: 300px; height: 707px;"></div>
      </div>
      <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
         <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); visibility: hidden;"></div>
      </div>
      <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
         <div class="simplebar-scrollbar" style="height: 203px; transform: translate3d(0px, 0px, 0px); visibility: visible;"></div>
      </div>
   </div>
</div>