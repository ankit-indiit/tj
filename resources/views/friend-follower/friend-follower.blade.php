@extends('layouts.app')
@section('content')
<div class="main_content frnds-page">
   <div class="mcontainer friends-following">
      <nav class="cd-secondary-nav border-b extanded mb-2">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
               <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Friends</a>
            </li>
            <li class="nav-item" role="presentation">
               <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Shops</a>
            </li>
         </ul>
      </nav>
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
                                 <a href="shop-1.html" class="text-blue-500 sm:block hidden"> See all </a>
                              </div>
                           </div> 
                        </div>
                        <ul class="uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid">
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Unfollow</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-2.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Unfollow</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-3.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Unfollow</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-4.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Unfollow</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-5.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Unfollow</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-6.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Unfollow</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-7.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Unfollow</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-8.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Unfollow</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-5.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                        </ul>
                        <div class="flex justify-between relative md:mb-4 mb-3">
                           <div class="flex-1">
                              <div class="sm:my-6 my-3 flex items-center justify-between ms">
                                 <div class="">
                                    <h2 class="text-xl font-semibold"> Followers</h2>
                                 </div>
                                 <a href="shop-1.html" class="text-blue-500 sm:block hidden"> See all </a>
                              </div>
                           </div>
                        </div>
                        <ul class="uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid">
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-2.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-3.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-4.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-5.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-6.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-7.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-8.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/avatars/avatar-5.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> James Lewis  </h4>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="relative" uk-slider="finite: true">
                     <div class="uk-slider-container px-1 py-3">
                        <div class="flex justify-between relative md:mb-4 mb-3">
                           <div class="flex-1">
                              <div class="sm:my-6 my-3 flex items-center justify-between ms">
                                 <div class="">
                                    <h2 class="text-xl font-semibold"> Following </h2>
                                 </div>
                                 <a href="shop-1.html" class="text-blue-500 sm:block hidden"> See all </a>
                              </div>
                           </div>
                        </div>
                        <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid">                          
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Unfollow</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/post/img-3.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> Decorama Boutique </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Unfollow</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/post/img-2.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold">One of a Kind Studio</h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/post/img-2.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold">Dollar Savings Store </h4>
                                 </div>
                              </a>
                           </li>
                        </ul>
                        <div class="flex justify-between relative md:mb-4 mb-3">
                           <div class="flex-1">
                              <div class="sm:my-6 my-3 flex items-center justify-between ms">
                                 <div class="mt-3">
                                    <h2 class="text-xl font-semibold"> Followers </h2>
                                 </div>
                                 <a href="shop-1.html" class="text-blue-500 sm:block hidden"> See all </a>
                              </div>
                           </div>
                        </div>
                        <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid">                          
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/post/img-3.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold"> Decorama Boutique </h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <div class="dropdown">
                                 <i class="icon-feather-more-horizontal dropdown-toggle text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"> <i class="uil-trash-alt mr-1"></i>  Remove</a>
                                 </div>
                              </div>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/post/img-2.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold">One of a Kind Studio</h4>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <a href="timeline-page.html">
                                 <img src="{{ url('public/assets/images/post/img-2.jpg') }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                                 <div class="pt-2">
                                    <h4 class="text-lg font-semibold">Dollar Savings Store </h4>
                                 </div>
                              </a>
                           </li>
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
                  <a href="#" class="text-blue-500"> See all </a>
               </div>
               <div class="mt-1">
                  <div class="flex items-center space-x-4 rounded-md -mx-2 p-2">
                     <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                        <img src="{{ url('public/assets/images/avatars/avatar-1.jpg') }}" class="absolute w-full h-full inset-0 rounded-md" alt="">
                     </div>
                     <div class="flex-1">
                        <a href="timeline-page.html" class="text-md font-semibold capitalize"> Stella Johnson </a>
                        <div class="text-sm text-gray-500 mt-0.5"> 845K Following</div>
                     </div>
                     <a href="timeline-page.html" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold">
                     Follow
                     </a>
                  </div>
                  <div class="flex items-center space-x-4 rounded-md -mx-2 p-2">
                     <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                        <img src="{{ url('public/assets/images/avatars/avatar-2.jpg') }}" class="absolute w-full h-full inset-0 rounded-md" alt="">
                     </div>
                     <div class="flex-1">
                        <a href="timeline-page.html" class="text-md font-semibold capitalize"> Alex Dolgove </a>
                        <div class="text-sm text-gray-500 mt-0.5"> 356k Following </div>
                     </div>
                     <a href="timeline-page.html" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold">
                     Follow
                     </a>
                  </div>
                  <div class="flex items-center space-x-4 rounded-md -mx-2 p-2">
                     <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                        <img src="{{ url('public/assets/images/avatars/avatar-3.jpg') }}" class="absolute w-full h-full inset-0 rounded-md" alt="">
                     </div>
                     <div class="flex-1">
                        <a href="timeline-page.html" class="text-md font-semibold capitalize"> John Michael  </a>
                        <div class="text-sm text-gray-500 mt-0.5"> 845K Following</div>
                     </div>
                     <a href="timeline-page.html" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold">
                     Follow
                     </a>
                  </div>
                  <div class="flex items-center space-x-4 rounded-md -mx-2 p-2">
                     <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                        <img src="{{ url('public/assets/images/avatars/avatar-4.jpg') }}" class="absolute w-full h-full inset-0 rounded-md" alt="">
                     </div>
                     <div class="flex-1">
                        <a href="timeline-page.html" class="text-md font-semibold capitalize"> Dennis Han </a>
                        <div class="text-sm text-gray-500 mt-0.5"> 845K Following</div>
                     </div>
                     <a href="timeline-page.html" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold">
                     Follow
                     </a>
                  </div>
                  <div class="flex items-center space-x-4 rounded-md -mx-2 p-2">
                     <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                        <img src="{{ url('public/assets/images/avatars/avatar-5.jpg') }}" class="absolute w-full h-full inset-0 rounded-md" alt="">
                     </div>
                     <div class="flex-1">
                        <a href="timeline-page.html" class="text-md font-semibold capitalize">   Martin Gray </a>
                        <div class="text-sm text-gray-500 mt-0.5"> 845K Following</div>
                     </div>
                     <a href="timeline-page.html" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold">
                     Follow
                     </a>
                  </div>
                  <div class="flex items-center space-x-4 rounded-md -mx-2 p-2">
                     <div class="w-14 h-14 flex-shrink-0 rounded-md relative">
                        <img src="{{ url('public/assets/images/avatars/avatar-6.jpg') }}" class="absolute w-full h-full inset-0 rounded-md" alt="">
                     </div>
                     <div class="flex-1">
                        <a href="timeline-page.html" class="text-md font-semibold capitalize">  Erica Jones </a>
                        <div class="text-sm text-gray-500 mt-0.5"> 845K Following</div>
                     </div>
                     <a href="timeline-page.html" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold">
                     Follow
                     </a>
                  </div>
               </div>
               <a href="#" class="bg-gray-200 flex flex-1 h-8 items-center justify-center rounded-md capitalize mt-2"> 
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
<script type="text/javascript"></script>
@endsection