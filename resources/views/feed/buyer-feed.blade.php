@extends('layouts.app')
@section('content')
<style>
   .radio-bt ul li .check {
      left: 62px;
      top: 12px;
   }

   .radio-bt ul li label {
      margin-left: 56px !important;
      padding: 0px;
   }

   .radio-bt ul li {
      display: flex;
   }

   .radio-bt ul li {
      display: flex;
      padding: 0 53px;
      justify-content: center;
      align-items: center;
   }

   .radio-bt ul li label {
      margin-left: 56px !important;
      padding: 0px;
      margin-bottom: 0;
   }

   .radio-bt {
      display: inline-block;
      padding-bottom: 29px;
   }
</style>
<div class="main_content">
   <div class="mcontainer">
      <!--  Feeds  -->
      <div class="lg:flex lg:space-x-10">
         <div class="lg:w-3/4 lg:px-20 space-y-7">
            <div class="bg-white shadow border border-gray-100 rounded-lg dark:bg-gray-900 lg:mx-0 p-4">
               <div class="flex space-x-3">
                  <img src="{{ asset('images/avatars/avatar-2.jpg') }}" class="w-10 h-10 rounded-full" />
                  <input placeholder="Share your thoughts" class="bg-gray-100 hover:bg-gray-200 flex-1 h-10 px-6 rounded-full" uk-toggle="target: #create-post-modal" />
               </div>              
                <div class="grid grid-flow-col pt-3 -mx-1 -mb-1 font-semibold text-sm">
                  <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer" uk-toggle="target: #create-post-modal">
                     <svg class="bg-blue-100 h-9 mr-2 p-1.5 rounded-full text-blue-600 w-9 -my-0.5 hidden lg:block" data-tippy-placement="top" title="Tooltip" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                     </svg>
                     Simple Post
                  </div>
                  <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer" uk-toggle="target: #poll-post-modal"><i class="fa fa-line-chart" aria-hidden="true"></i>Poll Post</div>
                  <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer" uk-toggle="target: #product-post-modal"><i class="fa fa-upload" aria-hidden="true"></i>Post Listing</div>
                  <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer" uk-toggle="target: #suggestions-post-modal"><i class="fa fa-commenting" aria-hidden="true"></i>Suggestions</div>
                </div>                          
            </div>

            @php $user_posts = user_posts(); @endphp
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
                            <input type="file" id="updated_post_image_upload" name="post_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('updated_post_image_upload','update_preview_simple_post_image')">
                            <a href="#" onclick="$('#updated_post_image_upload').trigger('click'); return false;">
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
                      <img id="update_preview_simple_post_image" style="height: 150px; width: 150px; padding: 10px;" />
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
         @include('layouts.includes.rightsidebarfeed')

      </div>
   </div>
</div>

@endsection

@section('customModals')
<!-- Craete post modal -->
<div id="create-post-modal" class="create-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold">Simple Post</h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <form id="simplePostForm" enctype="multipart/form-data" method="post">
         @csrf
         <input type="hidden" value="1" name="postType">
         <div class="flex flex-1 items-start space-x-4 p-5">
            <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-11 h-11">
            <div class="flex-1 pt-2">
               <textarea name="post_content" id="post_content" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="5" placeholder="What's Your Mind ?"></textarea>
            </div>

         </div>
         <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add to your post </div>
               <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">                  
                  <a href="#" onclick="$('#post_image_upload').trigger('click'); return false;">
                     <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                     </svg>
                  </a>                  
                  <a href="#" onclick="$('#post_video_upload').trigger('click'); return false;">
                    <svg class="text-red-600 h-9 p-1.5 rounded-full bg-red-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"> </path>
                    </svg>
                  </a>

                  {{-- <svg class="text-green-600 h-9 p-1.5 rounded-full bg-green-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                  </svg> --}}
               </div>
            </div>
            <input type="file" id="post_image_upload" name="post_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('post_image_upload','output_simple_post_image')">
            <input type="file" id="post_video_upload" name="post_video_upload" style="visibility:hidden;" onchange="ValidateFileUpload('post_video_upload','output_simple_post_video')" accept="video/mp4,video/x-m4v,video/*">
            <img id="output_simple_post_image" />
            <img id="output_simple_post_video" />
         </div>
         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">
               <button type="submit" id="add_simple_post_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                  Post
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('create-post-modal', 'output_simple_post_image');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
                  Cancel </a>
            </div>
         </div>
      </form>
   </div>
</div>

<div id="poll-post-modal" class="create-post main-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold">Poll Post</h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <form id="pollPostForm" enctype="multipart/form-data" method="post">
         @csrf
         <input type="hidden" value="2" name="postType">
        <div class="flex flex-1 items-start space-x-4 p-5">
            <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-11 h-11">
            <div class="flex-1 pt-2 small-textarea">
               <textarea name="poll_post_content" id="poll_post_content" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="5" placeholder="Enter Your Question?"></textarea>
            </div>
         </div>
         <div class="radio-bt">
            <ul>
               <li>
                  <input type="radio" id="f-option" name="selector">
                  <label for="f-option"><input type="text" name="pollButton1" id="pollButton1" class=" my-clas uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="1" placeholder="Option 1"></label>

                  <div class="check"></div>
               </li>

               <li>
                  <input type="radio" id="s-option" name="selector">
                  <label for="s-option"><input type="text" name="pollButton2" id="pollButton2" class=" my-clas uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="1" placeholder="Option 2"></label>

                  <div class="check">
                     <div class="inside"></div>
                  </div>
               </li>
            </ul>
         </div>
         <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add to your post </div>
               <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                  <input type="file" id="poll_image_upload" name="poll_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('poll_image_upload','output_poll_post_image')">
                  <a href="#" onclick="$('#poll_image_upload').trigger('click'); return false;">
                  <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  </a>

               </div>
            </div>
            <img id="output_poll_post_image" />
         </div>

         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">
               <button type="submit" id="add_poll_post_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                  Post
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('poll-post-modal', 'output_poll_post_image');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
                  Cancel </a>
            </div>
         </div>
      </form>
   </div>
</div>

<div id="product-post-modal" class="create-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold">Post Listing</h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <form id="productPostForm" enctype="multipart/form-data" method="post">
         @csrf
         <input type="hidden" value="3" name="postType">
         <div class="flex flex-1 items-start space-x-4 p-5">
            <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-11 h-11">
            <div class="flex-1 pt-2">
               <textarea name="product_post_content" id="product_post_content" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="2" placeholder="Add Product Details"></textarea>
            </div>
         </div>
         <div class="bsolute bottom-0 p-4 pb-0 space-x-4 w-full flex flex-1 items-start">

            <div class="form-group">
               <label class="sr-only" for="exampleInputAmount">Amount (in Swiss Francs)</label>
               <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i>
                  </div>
                  <input type="number" min="0.00" step="0.05" id="product_price" name="product_price" class="form-control" placeholder="Price">
               </div>
            </div>

         </div>
         <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add to your post </div>
               <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                  <input type="file" id="product_image_upload" name="product_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('product_image_upload','output_product_post_image')">
                  <a href="#" onclick="$('#product_image_upload').trigger('click'); return false;">
                  <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  </a>
                  <svg class="text-red-600 h-9 p-1.5 rounded-full bg-red-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"> </path>
                  </svg>

               </div>
            </div>
            <img id="output_product_post_image" />
            
         </div>

         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">
               <button type="submit" id="add_product_post_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                  Add Listing
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('product-post-modal', 'output_product_post_image');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
                  Cancel </a>

            </div>
         </div>
      </form>
   </div>
</div>

<div id="suggestions-post-modal" class="create-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold">Suggestions</h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <form id="suggestionPostForm" enctype="multipart/form-data" method="post">
         @csrf
         <input type="hidden" value="4" name="postType">
         <div class="flex flex-1 items-start space-x-4 p-5">
            <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-11 h-11">
            <div class="flex-1 pt-2">
               <textarea name="suggestion_post_content" id="suggestion_post_content" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="4" placeholder="Ask for any Question"></textarea>

            </div>

         </div>
         <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add to your post </div>
               <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                  <input type="file" id="suggestion_image_upload" name="suggestion_image_upload" style="visibility:hidden;" onchange="ValidateFileUpload('suggestion_image_upload','output_suggestion_post_image')">
                  <a href="#" onclick="$('#suggestion_image_upload').trigger('click'); return false;">
                  <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  </a>

               </div>
            </div>
            <img id="output_suggestion_post_image" />
         </div>

         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">

               <button type="submit" id="add_suggestion_post_btn" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium">
                  Ask for suggestions
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('suggestions-post-modal', 'output_suggestion_post_image');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
                  Cancel </a>
            </div>
         </div>

      </form>
   </div>
</div>


@endsection


@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
    function ValidateFileUpload(fileId, previewId) {
     
      var fuData = document.getElementById(fileId);
      var FileUploadPath = fuData.value;

      //To check if user upload any file
      if (FileUploadPath == '') {
         // swal("", 'Please upload an image', "error", {
         //    button: "close",
         // });

      } else {
         var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
         //The file uploaded is an image

         if (Extension == "gif" || Extension == "png" || Extension == "bmp" ||
            Extension == "jpeg" || Extension == "jpg"|| Extension == "mp4"|| Extension == "x-mp4") {

            // To Display
            if (fuData.files && fuData.files[0]) {
               var reader = new FileReader();

               reader.onload = function(e) {
                  var output = document.getElementById(previewId);
                  output.style.height = '150px';
                  output.style.width = '150px';
                  output.style.padding = '10px';
                  output.src = e.target.result;
               }

               reader.readAsDataURL(fuData.files[0]);
            }

         }
         //The file upload is NOT an image
         else {
            swal("", 'Photo only allows file types of GIF, PNG, JPG, JPEG and BMP.', "error", {
               button: "close",
            });
         }
      }
   }

   $("#simplePostUpdateForm").validate({
      rules: {
         post_content: {
            required: true,
            minlength: 2
         }
      },
      messages: {
         post_content: "Please enter post description!",
      },
      submitHandler: function(forms, e) {
         e.preventDefault();
         var form = $('#simplePostUpdateForm')[0];
         var serializedData = new FormData(form);

         $("#update_simple_post_btn").attr("disabled", true);
         $('#update_simple_post_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
         $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ url('update-simple-post') }}",
            data: serializedData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
               $("#update_simple_post_btn").attr("disabled", false);

               $('#update_simple_post_btn').html('Post');

               if (data.erro == '101') {
                  clearImage('output_simple_post_image');
                 
                  UIkit.modal('#update-post-modal').hide();

                  swal("", data.message, "success", {
                     button: "close",
                  });

                  $("#simplePostUpdateForm").trigger('reset');
                  $('.swal-button--confirm').on('click', function(){
                     window.location.reload();
                  });
               } else {
                  swal("", data.message, "error", {
                     button: "close",
                  });
               }
            }
         });
         return false;
      }
   });

   $("#simplePostForm").validate({
      rules: {
         post_content: {
            required: true,
            minlength: 2
         }
      },
      messages: {
         post_content: "Please enter post description!",
      },
      submitHandler: function(forms, e) {
         e.preventDefault();
         var form = $('#simplePostForm')[0];
         var serializedData = new FormData(form);

         $("#add_simple_post_btn").attr("disabled", true);
         $('#add_simple_post_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
         $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ url('add-simple-post') }}",
            data: serializedData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
               $("#add_simple_post_btn").attr("disabled", false);

               $('#add_simple_post_btn').html('Post');

               if (data.erro == '101') {
                  clearImage('output_simple_post_image');
                 
                  UIkit.modal('#create-post-modal').hide();

                  swal("", data.message, "success", {
                     button: "close",
                  });

                  $("#simplePostForm").trigger('reset');
                  $('.swal-button--confirm').on('click', function(){
                     window.location.reload();
                  });
               } else {
                  swal("", data.message, "error", {
                     button: "close",
                  });
               }
            }
         });
         return false;
      }
   });
   $("#pollPostForm").validate({
      rules: {
         poll_post_content: {
            required: true,
            minlength: 2
         },
         pollButton1: {
            required: true,
         },
         pollButton2: {
            required: true,
         }
      },
      messages: {
         poll_post_content: "Please enter your question.",
         pollButton1: "Please enter button name.",
         pollButton2: "Please enter button name.",
      },
      submitHandler: function(forms,e) {
         e.preventDefault();
         var form = $('#pollPostForm')[0];
         var serializedData = new FormData(form);
         //var serializedData = $(form).serialize();
         $("#add_poll_post_btn").attr("disabled", true);
         $('#add_poll_post_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
         $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            enctype: 'multipart/form-data',
            type: 'post',
            url: "{{ url('add-poll-post') }}",
            data: serializedData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
               $("#add_poll_post_btn").attr("disabled", false);

               $('#add_poll_post_btn').html('Post');

               if (data.erro == '101') {
                  UIkit.modal('#poll-post-modal').hide();
                   clearImage('output_poll_post_image');
                  swal("", data.message, "success", {
                     button: "close",
                  });

                  $("#pollPostForm").trigger('reset');
                  $('.swal-button--confirm').on('click', function(){
                     window.location.reload();
                  });
               } else {
                  swal("", data.message, "error", {
                     button: "close",
                  });
               }
            }
         });
         return false;
      }
   });

   $("#productPostForm").validate({
      rules: {
         product_post_content: {
            required: true,
            minlength: 2
         },
         product_price: {
            required: true,
         }
      },
      messages: {
         product_post_content: "Please enter product name.",
         product_price: "Please enter product price."
      },
      submitHandler: function(form,e) {
         e.preventDefault();
         var form = $('#productPostForm')[0];
         var serializedData = new FormData(form);
         //var serializedData = $(form).serialize();
         $("#add_product_post_btn").attr("disabled", true);
         $('#add_product_post_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
         $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: "{{ url('add-product-post') }}",
            data: serializedData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
               $("#add_product_post_btn").attr("disabled", false);

               $('#add_product_post_btn').html('Post');

               if (data.erro == '101') {
                  clearImage('output_product_post_image');
                  UIkit.modal('#product-post-modal').hide();
                  swal("", data.message, "success", {
                     button: "close",
                  });

                  $("#productPostForm").trigger('reset');
                  $('.swal-button--confirm').on('click', function(){
                     window.location.reload();
                  });
               } else {
                  swal("", data.message, "error", {
                     button: "close",
                  });
               }
            }
         });
         return false;
      }
   });

   $("#suggestionPostForm").validate({
      rules: {
         suggestion_post_content: {
            required: true,
            minlength: 2
         }
      },
      messages: {
         suggestion_post_content: "Please enter your question.",
      },
      submitHandler: function(form,e) {
          e.preventDefault();
         var form = $('#suggestionPostForm')[0];
         var serializedData = new FormData(form);
        // var serializedData = $(form).serialize();
         $("#add_suggestion_post_btn").attr("disabled", true);
         $('#add_suggestion_post_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
         $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: "{{ url('add-suggestion-post') }}",
            data: serializedData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
               $("#add_suggestion_post_btn").attr("disabled", false);

               $('#add_suggestion_post_btn').html('Post');

               if (data.erro == '101') {
                  UIkit.modal('#suggestions-post-modal').hide();
                  clearImage('output_suggestion_post_image');
                  swal("", data.message, "success", {
                     button: "close",
                  });

                  $("#suggestionPostForm").trigger('reset');
                  $('.swal-button--confirm').on('click', function(){
                     window.location.reload();
                  });
               } else {
                  swal("", data.message, "error", {
                     button: "close",
                  });
               }
            }
         });
         return false;
      }
   });
</script>
@endsection