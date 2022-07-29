<!-- sidebar -->
<div class="sidebar">
    <div class="sidebar_inner" data-simplebar>
        <div class=" bg-white rounded-2xl -mt-4">
            <div class="profile_avatar">
                <div class="profile_avatar_holder"> 
                    <img  class="user_profile_image" src="{{ show_user_image() }}" alt="">
                </div>
                <div class="user_status status_online"></div>
                <div class="icon_change_photo" hidden=""> <ion-icon name="camera" class="text-xl md hydrated" role="img" aria-label="camera"></ion-icon> </div>
            </div>
        </div>
        <ul>
            <li class="feed-home"><a href="{{ url('feed') }}"> 
                <i class="fa fa-home" aria-hidden="true"></i>
                <span> Feed </span> </a> 
            </li>
            <li  class=" mains">
                <div class="" id="menu">
                    <button class="" id="auctions"><i class="fa fa-shopping-bag" aria-hidden="true"></i><a class="ds" href="#">Marketplace</a></button>
                    <div class="sidebarbox"  style="display:none;">
                        <a class="submenu" href="{{ route('shop') }}">Shop</a>
                        <a class="submenu" href="{{ route('category.index') }}">Categories</a>
                        <a class="submenu" href="trendings.html">Trending</a>
                        <a class="submenu" href="best-seller.html">Best Sellers</a>
                        <a class="submenu" href="featured-products.html">Featured products</a>
                    </div>
                </div>
            </li>
            <li><a href="{{ route('collection.index') }}">
                <i class="icon-feather-layers" style="font-weight: bold;"> </i>
                    <span> Collections</span></a> 
            </li> 
            <li><a href="friends-followers.html">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                <span> Friends & Followers</span></a> 
            </li>
            <li><a href="order-history.html"> 
                <i class="fa fa-gift" aria-hidden="true"></i>
                <span> Orders</span> </a> 
            </li> 
                @if ( checkIfAuthIsSeller(Auth::user()->id) )
                    <li><a href="{{ route('switch-as') }}">
                       <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <span> Switch to {{ Auth::user()->switch_as == 'buyer' ? 'Seller' : 'Buyer'}}  </span> </a> 
                    </li>
                @else
                    <li><a href="{{ route('become.seller') }}"> 
                       <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <span> Become a Seller </span> </a> 
                    </li>
                @endif    		
        </ul>


        <li class="active-submenu" hidden>
            <a href="#"> 
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="text-pink-500">
                    <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                </svg>  <span>  Games </span>
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
            
            <a href="chat.html">
                <div class="contact-avatar">
                    <img src="{{ asset('images/avatars/avatar-1.jpg') }}" alt="">
                    <span class="user_status status_online"></span>
                </div>
                <div class="contact-username"> Dennis Han</div>
            </a>
            
        </div>
        <br>
        <br>
    </div>
</div>  