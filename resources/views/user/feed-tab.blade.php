<div class="space-y-5 flex-shrink-0 lg:w-7/12">
    <div class="bg-white shadow border border-gray-100 rounded-lg dark:bg-gray-900 lg:mx-0 p-4">
        <div class="flex space-x-3">
            <img src="{{ show_user_image() }}" class="w-10 h-10 rounded-full" />
            <input placeholder="What's Your Mind?" class="bg-gray-100 hover:bg-gray-200 flex-1 h-10 px-6 rounded-full" uk-toggle="target: #create-post-modal" />
        </div>        
        @if (Auth::user()->switch_as == 'seller')
          <div class="grid grid-flow-col pt-3 -mx-1 -mb-1 font-semibold text-sm d-flex justify-center">
            <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer " uk-toggle="target: #create-post-modal">
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
        @else
          <div class="grid grid-flow-col pt-3 -mx-1 -mb-1 font-semibold text-sm">
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
            <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer" uk-toggle="target: #product-post-modal">
                <i class="fa fa-upload" aria-hidden="true"></i>
                Post Listing
            </div>
            <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer" uk-toggle="target: #suggestions-post-modal">
                <i class="fa fa-commenting" aria-hidden="true"></i>
                Suggestions
            </div>
          </div>
        @endif   
    </div>


        @if (Auth::user()->switch_as == 'seller')
            @include('feed.seller-feed')
        @else
            @include('feed.buyer-feed')
        @endif 

    <div class="flex justify-center mt-6">
        <a href="#" class="bg-white dark:bg-gray-900 font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white"> Load more ..</a>
    </div>

    <div id="share-post-modal" class="create-post" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
           <div class="text-center py-4 border-b">
              <h3 class="text-lg font-semibold" id="postTitle">Share Post</h3>
              <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
           </div>
           <div class="d-flex justify-content-center my-4">
              <a href="http://www.facebook.com/sharer.php?u={{url('/')}}" target="_blank" style="text-decoration:none">
                 <h1><i class="uil-facebook mx-3"></i></h1>
              </a>

              <!-- LinkedIn -->
              <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{url('/')}}" target="_blank" style="text-decoration:none">
                 <h1><i class="uil-linkedin mx-3"></i></h1>
              </a>

              <!-- Twitter -->
              <a href="https://twitter.com/share?url={{url('/')}}" target="_blank" style="text-decoration:none">
                 <h1><i class="uil-twitter mx-3"></i></h1>
              </a>               
           </div>
        </div>
    </div>

    <div id="update-post-modal" class="create-post" uk-modal>
         <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
            <div class="text-center py-4 border-b">
               <h3 class="text-lg font-semibold" id="postTitle">Simple Post</h3>
               <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
            </div>
            <form id="simplePostUpdateForm" enctype="multipart/form-data" method="post">
               @csrf
               <input type="hidden" value="1" name="postType">
               <input type="hidden" name="postId" id="editedPostId">
               <div class="flex flex-1 items-start space-x-4 p-5">
                  <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-11 h-11">
                  <div class="flex-1 pt-2">
                     <textarea name="post_content" id="edited_post_content" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="5" placeholder="What's Your Mind ?"></textarea>
                  </div>

               </div>
               <div class="bsolute bottom-0 p-4 space-x-4 w-full">
                  <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
                     <div class="lg:block hidden"> Add to your post </div>
                     <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                        <input type="file" id="post_image_upload" name="post_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('post_image_upload','output_simple_post_image')">
                        <a href="#" onclick="$('#post_image_upload').trigger('click'); return false;">
                           <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                           </svg>
                        </a>

                        <svg class="text-red-600 h-9 p-1.5 rounded-full bg-red-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"> </path>
                        </svg>

                        <svg class="text-green-600 h-9 p-1.5 rounded-full bg-green-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                     </div>
                  </div>
                  <img id="output_simple_post_image" />
               </div>
               <div class="flex items-center w-full justify-between p-3 border-t">
                  <div class="flex space-x-2 pull-right">
                     <button type="submit" id="update_simple_post_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                        Post
                     </button>
                     <a href="javascript:void(0);" onclick="hideCurrentOpenModal('update-post-modal');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
                        Cancel </a>
                  </div>
               </div>
            </form>
         </div>
      </div>
        <div id="disable-comment-confirm-box" class="create-post" uk-modal>
           <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
               <div class="text-center py-4 border-b">
                   <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
               </div>
               <div class="main-txt">
                   <h3 class="text-lg font-semibold">Are you sure you want to disable?</h3>
                   <div class="space-x-2 buttons-yesno">
                       <a href="#" id="disablePostComment" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium"> Yes </a>
                       <a href="javascript:void(0);" onclick="$('#disable-comment-confirm-box').removeClass('uk-open').hide();" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm"> Cancel </a>
                   </div>                   
               </div>
           </div>
         </div>

       <div id="enable-comment-confirm-box" class="create-post" uk-modal>
         <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
             <div class="text-center py-4 border-b">
                 <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
             </div>
             <div class="main-txt">
                 <h3 class="text-lg font-semibold">Are you sure you want to enable?</h3>
                 <div class="space-x-2 buttons-yesno">
                     <a href="#" id="enablePostComment" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium"> Yes </a>
                     <a href="javascript:void(0);" onclick="$('#enable-comment-confirm-box').removeClass('uk-open').hide();" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm"> Cancel </a>
                 </div>                   
             </div>
         </div>
       </div>

        <div id="delete-post-confirm-box" class="create-post" uk-modal>
           <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
               <div class="text-center py-4 border-b">
                   <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
               </div>
               <div class="main-txt">
                   <h3 class="text-lg font-semibold">Are you sure you want to delete?</h3>
                   <div class="space-x-2 buttons-yesno">
                       <a href="#" id="delete-post" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium"> Yes </a>
                       <a href="javascript:void(0);" onclick="$('#delete-post-confirm-box').removeClass('uk-open').hide();" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm"> Cancel </a>
                   </div>                   
               </div>
           </div>
        </div>
      
</div>
<div class="lg:w-4/12 space-y-6">
    <div class="widget">
        <h4 class="text-2xl mb-3 font-semibold">My Bio</h4>
        <ul class="text-gray-600 space-y-4">
            <li>{{ Auth::user()->bio}}</li>
        </ul>
    </div>

    <div class="widget border-t pt-4">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h4 class="text-2xl -mb-0.5 font-semibold">Friends</h4>
                <p>3,4510 Friends</p>
            </div>
            <a href="#" class="text-blue-600">See all</a>
        </div>
        <div class="grid grid-cols-3 gap-3 text-gray-600 font-semibold">
            <a href="#">
                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                    <img src="{{ asset('images/avatars/avatar-1.jpg') }}" alt="" class="w-full h-full object-cover absolute" />
                </div>
                <div>Jonathan Ali</div>
            </a>
            <a href="#">
                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                    <img src="{{ asset('images/avatars/avatar-2.jpg') }}" alt="" class="w-full h-full object-cover absolute" />
                </div>
                <div>Jonathan Ali</div>
            </a>
            <a href="#">
                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                    <img src="{{ asset('images/avatars/avatar-3.jpg') }}" alt="" class="w-full h-full object-cover absolute" />
                </div>
                <div>Jonathan Ali</div>
            </a>
            <a href="#">
                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                    <img src="{{ asset('images/avatars/avatar-4.jpg') }}" alt="" class="w-full h-full object-cover absolute" />
                </div>
                <div>Jonathan Ali</div>
            </a>
            <a href="#">
                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                    <img src="{{ asset('images/avatars/avatar-5.jpg') }}" alt="" class="w-full h-full object-cover absolute" />
                </div>
                <div>Jonathan Ali</div>
            </a>
            <a href="#">
                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                    <img src="{{ asset('images/avatars/avatar-6.jpg') }}" alt="" class="w-full h-full object-cover absolute" />
                </div>
                <div>Jonathan Ali</div>
            </a>
        </div>
        <a href="#" class="bg-gray-100 py-2.5 text-center font-semibold w-full mt-4 block rounded"> See all </a>
    </div>
</div>