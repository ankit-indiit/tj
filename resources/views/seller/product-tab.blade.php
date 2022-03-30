<div class="tab-content">
   <div class="lg:flex lg:mt-8 mt-4 lg:space-x-8 tab-pane show" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="space-y-5 flex-shrink-0 lg:w-7/12">
         <div class="bg-white shadow border border-gray-100 rounded-lg dark:bg-gray-900 lg:mx-0 p-4">
            <div class="flex space-x-3">
               <img src="{{ asset('images/avatars/avatar-2.jpg') }}" class="w-10 h-10 rounded-full">
               <input placeholder="Share your thoughts" class="bg-gray-100 hover:bg-gray-200 flex-1 h-10 px-6 rounded-full" uk-toggle="target: #create-post-modal"> 
            </div>
            <div class="grid grid-flow-col pt-3 -mx-1 -mb-1 font-semibold text-sm  my-txty">
               <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer" uk-toggle="target: #create-post-modal">
                  <svg class="bg-blue-100 h-9 mr-2 p-1.5 rounded-full text-blue-600 w-9 -my-0.5 hidden lg:block" data-tippy-placement="top" title="Tooltip" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  Simple Post
               </div>
               <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer" uk-toggle="target: #poll-post-modal"> 
                  <i class="fa fa-line-chart" aria-hidden="true"></i>
                  Poll Post
               </div>
            </div>
         </div>
         <div class="bg-white shadow border border-gray-100 rounded-lg dark:bg-gray-900 lg:mx-0 uk-animation-slide-bottom-small">
            <!-- post header-->
            <div class="flex justify-between items-center lg:p-4 p-2.5">
               <div class="flex flex-1 items-center space-x-4">
                  <a href="#">
                  <img src="{{ asset('images/avatars/avatar-2.jpg') }}" class="bg-gray-200 border border-white rounded-full w-10 h-10">
                  </a>
                  <div class="flex-1 font-semibold capitalize">
                     <a href="#" class="text-black"> Johnson smith </a>
                     <div class="text-gray-700 flex items-center space-x-2">
                        5 <span> hrs </span> 
                        <ion-icon name="people" role="img" class="md hydrated" aria-label="people"></ion-icon>
                     </div>
                  </div>
               </div>
               <div>
                  <a href="#" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
                  <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">
                     <ul class="space-y-1">
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-share-alt mr-1"></i> Share
                           </a> 
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-edit-alt mr-1"></i>  Edit Post 
                           </a> 
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-comment-slash mr-1"></i>   Disable comments
                           </a> 
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-favorite mr-1"></i>  Add favorites 
                           </a> 
                        </li>
                        <li>
                           <hr class="-mx-2 my-2 dark:border-gray-800">
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                           <i class="uil-trash-alt mr-1"></i>  Delete
                           </a> 
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div uk-lightbox="">
               <a href="{{ asset('images/avatars/avatar-lg-3.jpg') }}">  
               <img src="{{ asset('images/avatars/avatar-lg-4.jpg') }}" alt="" class="max-h-96 w-full object-cover">
               </a>
            </div>
            <div class="p-4 space-y-3">
               <div class="flex space-x-4 lg:font-bold">
                  <a href="#" class="flex items-center space-x-2">
                     <div class="p-2 rounded-full text-black lg:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                           <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
                        </svg>
                     </div>
                     <div> Like</div>
                  </a>
                  <a href="#" class="flex items-center space-x-2">
                     <div class="p-2 rounded-full text-black lg:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                           <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                        </svg>
                     </div>
                     <div> Comment</div>
                  </a>
               </div>
               <div class="flex items-center space-x-3 pt-2">
                  <div class="flex items-center">
                     <img src="{{ asset('images/avatars/avatar-1.jpg') }}" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900">
                     <img src="{{ asset('images/avatars/avatar-4.jpg') }}" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900 -ml-2">
                     <img src="{{ asset('images/avatars/avatar-2.jpg') }}" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900 -ml-2">
                  </div>
                  <div class="dark:text-gray-100">
                     Liked <strong> Johnson</strong> and <strong> 209 Others </strong>
                  </div>
               </div>
               <div class="border-t py-4 space-y-4 dark:border-gray-600">
                  <div class="flex">
                     <div class="w-10 h-10 rounded-full relative flex-shrink-0">
                        <img src="{{ asset('images/avatars/avatar-1.jpg') }}" alt="" class="absolute h-full rounded-full w-full">
                     </div>
                     <div>
                        <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 relative lg:ml-5 ml-2 lg:mr-12  dark:bg-gray-800 dark:text-gray-100">
                           <p class="leading-6">
                              In ut odio libero vulputate 
                              <urna class="i uil-heart"></urna>
                              <i class="uil-grin-tongue-wink"> </i> 
                           </p>
                           <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div>
                        </div>
                        <div class="text-sm flex items-center space-x-3 mt-2 ml-5">
                           <a href="#" class="text-red-600"> <i class="uil-heart"></i> Love </a>
                           <a href="#"> Replay </a>
                           <span> 3d </span>
                        </div>
                     </div>
                  </div>
                  <div class="flex">
                     <div class="w-10 h-10 rounded-full relative flex-shrink-0">
                        <img src="{{ asset('images/avatars/avatar-1.jpg') }}" alt="" class="absolute h-full rounded-full w-full">
                     </div>
                     <div>
                        <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 relative lg:ml-5 ml-2 lg:mr-12  dark:bg-gray-800 dark:text-gray-100">
                           <p class="leading-6"> sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. David !<i class="uil-grin-tongue-wink-alt"></i> </p>
                           <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div>
                        </div>
                        <div class="text-xs flex items-center space-x-3 mt-2 ml-5">
                           <a href="#" class="text-red-600"> <i class="uil-heart"></i> Love </a>
                           <a href="#"> Replay </a>
                           <span> 3d </span>
                        </div>
                     </div>
                  </div>
               </div>
               <a href="#" class="hover:text-blue-600 hover:underline">  Veiw 8 more Comments </a>
               <div class="bg-gray-100 rounded-full relative dark:bg-gray-800 border-t">
                  <input placeholder="Add your Comment.." class="bg-transparent max-h-10 shadow-none px-5">
                  <div class="-m-0.5 absolute bottom-0 flex items-center right-3 text-xl">
                     <a href="#">
                        <ion-icon name="happy-outline" class="hover:bg-gray-200 p-1.5 rounded-full md hydrated" role="img" aria-label="happy outline"></ion-icon>
                     </a>
                     <a href="#">
                        <ion-icon name="image-outline" class="hover:bg-gray-200 p-1.5 rounded-full md hydrated" role="img" aria-label="image outline"></ion-icon>
                     </a>
                     <a href="#">
                        <ion-icon name="link-outline" class="hover:bg-gray-200 p-1.5 rounded-full md hydrated" role="img" aria-label="link outline"></ion-icon>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="bg-white shadow border border-gray-100 rounded-lg dark:bg-gray-900 lg:mx-0 uk-animation-slide-bottom-small">
            <!-- post header-->
            <div class="flex justify-between items-center lg:p-4 p-2.5">
               <div class="flex flex-1 items-center space-x-4">
                  <a href="#">
                  <img src="{{ asset('images/avatars/avatar-2.jpg') }}" class="bg-gray-200 border border-white rounded-full w-10 h-10">
                  </a>
                  <div class="flex-1 font-semibold capitalize">
                     <a href="#" class="text-black"> Johnson smith </a>
                     <div class="text-gray-700 flex items-center space-x-2">
                        5 <span> hrs </span> 
                        <ion-icon name="people" role="img" class="md hydrated" aria-label="people"></ion-icon>
                     </div>
                  </div>
               </div>
               <div>
                  <a href="#" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
                  <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">
                     <ul class="space-y-1">
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-edit-alt mr-1"></i>  Edit Post 
                           </a> 
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-comment-slash mr-1"></i>   Disable comments
                           </a> 
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-favorite mr-1"></i>  Add favorites 
                           </a> 
                        </li>
                        <li>
                           <hr class="-mx-2 my-2 dark:border-gray-800">
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                           <i class="uil-trash-alt mr-1"></i>  Delete
                           </a> 
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="p-3 border-b dark:border-gray-700">
               Lorem ipsum dolor <a class="hash" href="#">#hashtag</a> sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim laoreet dolore magna aliquam erat volutpat
            </div>
            <div class="p-4 space-y-3">
               <div class="flex space-x-4 lg:font-bold">
                  <a href="#" class="flex items-center space-x-2">
                     <div class="p-2 rounded-full text-black lg:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                           <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
                        </svg>
                     </div>
                     <div> Like</div>
                  </a>
                  <a href="#" class="flex items-center space-x-2">
                     <div class="p-2 rounded-full text-black lg:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                           <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                        </svg>
                     </div>
                     <div> Suggestion</div>
                  </a>
               </div>
               <div class="flex items-center space-x-3 pt-2">
                  <div class="flex items-center">
                     <img src="{{ asset('images/avatars/avatar-1.jpg') }}" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900">
                     <img src="{{ asset('images/avatars/avatar-4.jpg') }}" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900 -ml-2">
                     <img src="{{ asset('images/avatars/avatar-2.jpg') }}" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900 -ml-2">
                  </div>
                  <div class="dark:text-gray-100">
                     Liked <strong> Johnson</strong> and <strong> 209 Others </strong>
                  </div>
               </div>
               <div class="border-t py-4 space-y-4 dark:border-gray-600">
                  <div class="flex">
                     <div class="w-10 h-10 rounded-full relative flex-shrink-0">
                        <img src="{{ asset('images/avatars/avatar-1.jpg') }}" alt="" class="absolute h-full rounded-full w-full">
                     </div>
                     <div>
                        <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 relative lg:ml-5 ml-2 lg:mr-12 dark:bg-gray-800 dark:text-gray-100">
                           <p class="leading-6">
                              In ut <a class="hash" href="#">#hashtag</a> odio libero vulputate 
                              <urna class="i uil-heart"></urna>
                              <i class="uil-grin-tongue-wink"> </i> 
                           </p>
                           <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div>
                        </div>
                        <div class="text-sm flex items-center space-x-3 mt-2 ml-5">
                           <a href="#" class="text-red-600"> <i class="uil-heart"></i> Love </a>
                           <a href="#"> Replay </a>
                           <span> 3d </span>
                        </div>
                     </div>
                  </div>
                  <div class="flex">
                     <div class="w-10 h-10 rounded-full relative flex-shrink-0">
                        <img src="{{ asset('images/avatars/avatar-1.jpg') }}" alt="" class="absolute h-full rounded-full w-full">
                     </div>
                     <div>
                        <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 relative lg:ml-5 ml-2 lg:mr-12 dark:bg-gray-800 dark:text-gray-100">
                           <p class="leading-6"> sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. David !<i class="uil-grin-tongue-wink-alt"></i> </p>
                           <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div>
                        </div>
                        <div class="text-xs flex items-center space-x-3 mt-2 ml-5">
                           <a href="#" class="text-red-600"> <i class="uil-heart"></i> Love </a>
                           <a href="#"> Replay </a>
                           <span> 3d </span>
                        </div>
                     </div>
                  </div>
               </div>
               <a href="#" class="hover:text-blue-600 hover:underline">  Veiw 8 more Comments </a>
               <div class="bg-gray-100 rounded-full relative dark:bg-gray-800 border-t">
                  <input placeholder="Add your Comment.." class="bg-transparent max-h-10 shadow-none px-5">
                  <div class="-m-0.5 absolute bottom-0 flex items-center right-3 text-xl">
                     <a href="#">
                        <ion-icon name="happy-outline" class="hover:bg-gray-200 p-1.5 rounded-full md hydrated" role="img" aria-label="happy outline"></ion-icon>
                     </a>
                     <a href="#">
                        <ion-icon name="image-outline" class="hover:bg-gray-200 p-1.5 rounded-full md hydrated" role="img" aria-label="image outline"></ion-icon>
                     </a>
                     <a href="#">
                        <ion-icon name="link-outline" class="hover:bg-gray-200 p-1.5 rounded-full md hydrated" role="img" aria-label="link outline"></ion-icon>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="bg-white shadow border border-gray-100 rounded-lg dark:bg-gray-900 lg:mx-0 uk-animation-slide-bottom-small">
            <!-- post header-->
            <div class="flex justify-between items-center lg:p-4 p-2.5">
               <div class="flex flex-1 items-center space-x-4">
                  <a href="#">
                  <img src="{{ asset('images/avatars/avatar-2.jpg') }}" class="bg-gray-200 border border-white rounded-full w-10 h-10">
                  </a>
                  <div class="flex-1 font-semibold capitalize">
                     <a href="#" class="text-black"> Johnson smith </a>
                     <div class="text-gray-700 flex items-center space-x-2">
                        5 <span> hrs </span> 
                        <ion-icon name="people" role="img" class="md hydrated" aria-label="people"></ion-icon>
                     </div>
                  </div>
               </div>
               <div>
                  <a href="#" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
                  <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">
                     <ul class="space-y-1">
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-share-alt mr-1"></i> Share
                           </a> 
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-edit-alt mr-1"></i>  Edit Post 
                           </a> 
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-comment-slash mr-1"></i>   Disable comments
                           </a> 
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                           <i class="uil-favorite mr-1"></i>  Add favorites 
                           </a> 
                        </li>
                        <li>
                           <hr class="-mx-2 my-2 dark:border-gray-800">
                        </li>
                        <li> 
                           <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                           <i class="uil-trash-alt mr-1"></i>  Delete
                           </a> 
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="p-3 border-b dark:border-gray-700">
               <div class="poll-container">
                  <h3 class="poll-question">Which one is more badass?</h3>
                  <span class="btngroup">
                  <button class="btngroup--btn ys-btn">Yes<br> 0%</button>
                  <button class="btngroup--btn">No <br> 10%</button>
                  </span>
               </div>
            </div>
            <!--div class="w-full h-full">
               <iframe src="https://www.youtube.com/embed/pQN-pnXPaVg" frameborder="0"
                   uk-video="automute: true" allowfullscreen uk-responsive class="w-full lg:h-64 h-40"></iframe>
               </div-->
         </div>
         <div class="flex justify-center mt-6">
            <a href="#" class="bg-white dark:bg-gray-900 font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
            Load more ..</a>
         </div>
      </div>
      <div class="lg:w-4/12 space-y-6">
         <!--div class="widget mb-4">
            <h4 class="text-2xl mb-2 font-semibold">    Personal Information </h4>
            
            <ul class="text-gray-600 space-y-4">
                <li class="flex items-center space-x-2"> 
                
                    Live In Cairo , Eygept  </strong>
                </li>
                <li class="flex items-center space-x-2"> 
                   
                    From  Aden , Yemen  </strong>
                </li>
               
                             
            </ul>
            </div-->
         <div class="widget mb-4 main-w">
            <h4 class="text-2xl mb-2 font-semibold">    Shop Information </h4>
            <ul class="text-gray-600 space-y-4">
               <li class="flex items-center space-x-2"> 
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  1331 Artesa Dr, Marrero, LA, 70072  
               </li>
               <li class="flex items-center space-x-2"> 
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  897-9809-899  
               </li>
               <li><i class="fa fa-map-o" aria-hidden="true"></i>
                  <a href="https://www.google.com/maps"> https://www.google.com/maps </a> 
               </li>
            </ul>
         </div>
         <div class="widget border-t pt-4">
            <div class="flex items-center justify-between mb-4">
               <div>
                  <h4 class="text-2xl -mb-0.5 font-semibold"> Followers </h4>
                  <p> 3,4510 Friends</p>
               </div>
               <a href="#" class="text-blue-600 ">See all</a>
            </div>
            <div class="grid grid-cols-3 gap-3 text-gray-600 font-semibold">
               <a href="#">
                  <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                     <img src="{{ asset('images/avatars/avatar-1.jpg') }}" alt="" class="w-full h-full object-cover absolute">
                  </div>
                  <div> Jonathan Ali </div>
               </a>
               <a href="#">
                  <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                     <img src="{{ asset('images/avatars/avatar-2.jpg') }}" alt="" class="w-full h-full object-cover absolute">
                  </div>
                  <div> Jonathan Ali </div>
               </a>
               <a href="#">
                  <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                     <img src="{{ asset('images/avatars/avatar-3.jpg') }}" alt="" class="w-full h-full object-cover absolute">
                  </div>
                  <div> Jonathan Ali </div>
               </a>
               <a href="#">
                  <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                     <img src="{{ asset('images/avatars/avatar-4.jpg') }}" alt="" class="w-full h-full object-cover absolute">
                  </div>
                  <div> Jonathan Ali </div>
               </a>
               <a href="#">
                  <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                     <img src="{{ asset('images/avatars/avatar-5.jpg') }}" alt="" class="w-full h-full object-cover absolute">
                  </div>
                  <div> Jonathan Ali </div>
               </a>
               <a href="#">
                  <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                     <img src="{{ asset('images/avatars/avatar-6.jpg') }}" alt="" class="w-full h-full object-cover absolute">
                  </div>
                  <div> Jonathan Ali </div>
               </a>
            </div>
            <a href="#" class="bg-gray-100 py-2.5 text-center font-semibold w-full mt-4 block rounded"> See all </a>
         </div>
      </div>
   </div>
   <div class="tab-pane" id="pics" role="tabpanel" aria-labelledby="pics-tab">
      <div class="flex justify-between relative md:mb-4 mb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold mt-4"> Photos </h2>
            <nav class="cd-secondary-nav border-b md:m-0 -mx-4">
               <ul>
                  <li class="active"><a href="#" class="lg:px-2">  Photos of you  <span> 230</span> </a></li>
                  <li><a href="#" class="lg:px-2"> Recently added </a></li>
               </ul>
            </nav>
         </div>
      </div>
      <div class="grid md:grid-cols-4 grid-cols-2 gap-3 mt-5">
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/post/img-1.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/post/img-2.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/avatars/avatar-3.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/post/img-4.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/avatars/avatar-7.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/avatars/avatar-4.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/post/img-1.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/post/img-2.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/post/img-3.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/post/img-2.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/post/img-3.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
         <div>
            <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
               <img src="{{ asset('images/post/img-2.jpg') }}" class="w-full h-full absolute object-cover inset-0">
               <!-- overly-->
               <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
            </div>
         </div>
      </div>
   </div>
   <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <div class="row mt-4">
         <div class="col-12">
           
         </div>
      </div>
      <div class="row mt-4">
         <div class="col-12">
            <h4 class="text-xl mb-3 font-semibold">  Social Links </h4>
            <div class="name-info">
               <div class="row">
                  <div class="col-sm-4">
                     <i class="fa fa-twitter" aria-hidden="true"></i>
                     <a href="#" class="name-fld">https://twitter.com</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-4">
         <div class="col-12">
            <h4 class="text-xl mb-3 font-semibold">  Working Hours </h4>
            <div class="name-info">
               <div class="row">
                  <div class="col-sm-4">
                     <a href="#" class="name-fld"><i class="fa fa-clock-o" aria-hidden="true"></i> 7 am to 4 pm</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-4">
         <div class="col-12">
            <h4 class="text-xl mb-3 font-semibold"> Estimated Delivery </h4>
            <div class="name-info">
               <div class="row">
                  <div class="col-sm-4">
                     <a href="#" class="name-fld"><i class="fa fa-truck" aria-hidden="true"></i>
                     7 to 8 Days</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-4">
         <div class="col-12">
            <h4 class="text-xl mb-3 font-semibold"> Discount Coupan </h4>
            <div class="name-info">
               <div class="row">
                  <div class="col-sm-4">
                     <div id="carbonads"><span><span class="carbon-wrap"><a href="#" class="carbon-img" target="_blank" rel="noopener sponsored">
                        <img src="{{ asset('images/coupan-img.jpg') }}" alt="ads via Carbon" border="0" height="100" width="130" style="max-width: 130px;"></a>
                        <a href="#" class="carbon-text" target="_blank" rel="noopener sponsored">Limited time offer: Get 10 free lorem ipsum dolor sit amet.</a></span><br>
                        <a href="#" class="carbon-poweredby" target="_blank" rel="noopener sponsored">lorem ipsum dolor sit amet</a></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="tab-pane mt-5 active" id="list" role="tabpanel" aria-labelledby="list-tab">
      <div class="flex justify-between relative md:mb-4 mb-3 mt-5 border-b pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold"> Products
            </h2>
         </div>
         <div id="divcheck" style="display:none;">
            <a href="#" class="is_link featured-btn pull-right"> Add to featured products </a>
         </div>
         <div class="wishlist-search">
            <div class="header_search" aria-expanded="false">
               <input value="" type="text" class="form-control" placeholder="Search " autocomplete="off">
               <i class="uil-search-alt"></i>
            </div>
         </div>
         <a href="{{ route('product.create') }}" class="is_link featured-btn pull-right mx-1"> Add Product </a>
         <a href="javascript:void(0);" uk-toggle="target: #add-product-category-modal" class="is_link featured-btn pull-right mx-1"> Add Category </a>
         <a href="{{ route('product.create') }}" class="is_link featured-btn pull-right mx-1"> Add Collection </a>
         </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="relative">
               <div class="uk-slider-container px-1 py-3">
                  <div class="row">
                     @foreach ($products as $product)
                        @php
                           $unSerlizeProImage = unserialize($product->image);
                           $productImage = reset($unSerlizeProImage);
                        @endphp
                        <div class="col-sm-3">
                           <div class="card">
                              <div class="card-media h-44">
                                 <div class="card-media-overly"></div>
                                 <img src="{{ url("public/images/product/$productImage") }}" alt="">
                                 <div class="product-list"> 
                                    <label class="cont">
                                    <input type="checkbox" class="checkme">
                                    <span class="checkmark"></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <a href="{{ route('product.detail', $product->slug) }}" class="ext-lg font-medium mt-1 t truncate"> {{ $product->name }} </a>
                                 <div class="text-xs font-semibold uppercase text-yellow-500">${{ $product->price }}</div>
                                 <div class="text-xs font-semibold ven-nam text-yellow-500">
                                    @foreach ($product->productCategoryId as $proCatId)
                                       <a href="{{ route('category.show', str_replace(' ', '-', strtolower(getProductCategoryNameById($proCatId->cat_id)))) }}">
                                          {{ getProductCategoryNameById($proCatId->cat_id) }}
                                       </a>
                                    @endforeach
                                 </div>
                                 <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="tab-pane mt-5" id="featp" role="tabpanel" aria-labelledby="featp-tab">
      <div class="flex justify-between relative md:mb-4 mb-3 mt-5 border-b pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold"> Featured Products
            </h2>
         </div>
         <div id="divchecks" style="display:none;">
            <a href="#" class="is_link featured-btn pull-right"> Remove featured products </a>
         </div>
         <div class="wishlist-search">
            <div class="header_search" aria-expanded="false">
               <input value="" type="text" class="form-control" placeholder="Search " autocomplete="off">
               <i class="uil-search-alt"></i>
            </div>
         </div>
         <div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="relative">
               <div class="uk-slider-container px-1 py-3">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="card">
                           <div class="card-media h-44">
                              <div class="card-media-overly"></div>
                              <img src="{{ asset('images/tshert.png') }}" alt="">
                              <div class="product-list"> 
                                 <label class="cont">
                                 <input type="checkbox" class="checkmes">
                                 <span class="checkmark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="card-body">
                              <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                              <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                              <div class="text-xs font-semibold ven-nam text-yellow-500">
                                 <a href="shop-timeline.html">Forever 21</a>
                              </div>
                              <div class="ratings">
                                 <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="card">
                           <div class="card-media h-44">
                              <div class="card-media-overly"></div>
                              <img src="{{ asset('images/tshert.png') }}" alt="">
                              <div class="product-list"> 
                                 <label class="cont">
                                 <input type="checkbox" class="checkmes">
                                 <span class="checkmark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="card-body">
                              <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                              <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                              <div class="text-xs font-semibold ven-nam text-yellow-500">
                                 <a href="shop-timeline.html">Forever 21</a>
                              </div>
                              <div class="ratings">
                                 <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="card">
                           <div class="card-media h-44">
                              <div class="card-media-overly"></div>
                              <img src="{{ asset('images/tshert.png') }}" alt="">
                              <div class="product-list"> 
                                 <label class="cont">
                                 <input type="checkbox" class="checkmes">
                                 <span class="checkmark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="card-body">
                              <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                              <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                              <div class="text-xs font-semibold ven-nam text-yellow-500">
                                 <a href="shop-timeline.html">Forever 21</a>
                              </div>
                              <div class="ratings">
                                 <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="card">
                           <div class="card-media h-44">
                              <div class="card-media-overly"></div>
                              <img src="{{ asset('images/tshert.png') }}" alt="">
                              <div class="product-list"> 
                                 <label class="cont">
                                 <input type="checkbox" class="checkmes">
                                 <span class="checkmark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="card-body">                              
                              <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                              <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                              <div class="text-xs font-semibold ven-nam text-yellow-500">
                                 <a href="shop-timeline.html">Forever 21</a>
                              </div>
                              <div class="ratings">
                                 <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="card">
                           <div class="card-media h-44">
                              <div class="card-media-overly"></div>
                              <img src="{{ asset('images/tshert.png') }}" alt="">
                              <div class="product-list"> 
                                 <label class="cont">
                                 <input type="checkbox" class="checkmes">
                                 <span class="checkmark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="card-body">                              
                              <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                              <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                              <div class="text-xs font-semibold ven-nam text-yellow-500">
                                 <a href="shop-timeline.html">Forever 21</a>
                              </div>
                              <div class="ratings">
                                 <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="card">
                           <div class="card-media h-44">
                              <div class="card-media-overly"></div>
                              <img src="{{ asset('images/tshert.png') }}" alt="">
                              <div class="product-list"> 
                                 <label class="cont">
                                 <input type="checkbox" class="checkmes">
                                 <span class="checkmark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="card-body">                             
                              <a href="shop-4.html" class="ext-lg font-medium mt-1 t truncate"> Men T-shirt </a>
                              <div class="text-xs font-semibold uppercase text-yellow-500">$19.99</div>
                              <div class="text-xs font-semibold ven-nam text-yellow-500">
                                 <a href="shop-timeline.html">Forever 21</a>
                              </div>
                              <div class="ratings">
                                 <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="tab-pane" id="bio" role="tabpanel" aria-labelledby="bio-tab">
      <div class="flex justify-between relative md:mb-4 mb-3 mt-5 border-b pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold"> Bio
            </h2>
         </div>
         <div>
         </div>
      </div>
      <div class="row mt-4">
         <div class="col-8">
            <div class="row">
               <div class="col-sm-12">
                  <div class="profile-inp">
                     <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Bio"></textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12"><a href="timeline-page.html" class=" flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                  Save Changes
                  </a><a href="timeline-page.html" class=" flex text-center items-center justify-center  gray-bg w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                  Cancel
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>