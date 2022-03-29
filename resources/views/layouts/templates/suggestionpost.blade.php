<div class="bg-white shadow border border-gray-100 rounded-lg dark:bg-gray-900 lg:mx-0 uk-animation-slide-bottom-small">
    <!-- post header-->
    <div class="flex justify-between items-center lg:p-4 p-2.5">
        <div class="flex flex-1 items-center space-x-4">
            <a href="#">
                <img src="{{ show_user_image() }}" class="bg-gray-200 border border-white rounded-full w-10 h-10" />
            </a>
            <div class="flex-1 font-semibold capitalize">
                <a href="#" class="text-black"> {{ show_user_name($post->user_id) }} </a>
                <div class="text-gray-700 flex items-center space-x-2">{{ show_time_ago($post->created_at) }}
                    <ion-icon name="people" role="img" class="md hydrated" aria-label="people"></ion-icon>
                </div>
            </div>
        </div>
        <div>
            <a href="#" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
            <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">
                <ul class="space-y-1">
                    <li>
                        <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800" onclick="updatePost(<?php echo $post->id; ?>);"> <i class="uil-edit-alt mr-1"></i> Edit Post </a>
                    </li>
                    <li>
                        @if ($post->hide_comment == 1)
                            <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800" uk-toggle="target: #enable-comment-confirm-box" onclick="enableComment(<?php echo $post->id; ?>);">
                            <i class="uil-comment-slash mr-1"></i> 
                                Enable Suggestion
                            </a>
                        @else
                            <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800" uk-toggle="target: #disable-comment-confirm-box" onclick="disableComment(<?php echo $post->id; ?>);">
                            <i class="uil-comment-slash mr-1"></i> 
                                Disable Suggestion
                            </a>
                        @endif
                    </li>                   
                    <li>
                        <hr class="-mx-2 my-2 dark:border-gray-800" />
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600"  uk-toggle="target: #delete-post-confirm-box" onclick="deletePost(<?php echo $post->id; ?>);"> <i class="uil-trash-alt mr-1"></i> Delete </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @if($post->image != '')
    <div uk-lightbox="">
        <a href="{{ url('public/posts/images') }}/{{ $post->image }}">
            <img src="{{ url('public/posts/images') }}/{{ $post->image }}" alt="" class="max-h-96 w-full object-cover" />
        </a>
    </div>
    @endif
    <div class="p-3 border-b dark:border-gray-700">
        {{ $post->content }}
    </div>

    <div class="p-4 space-y-3">
        <div class="flex space-x-4 lg:font-bold">
            <div id="like__{{ $post->id }}">
            {!! show_like_module($post->id) !!}
            </div>
            <a href="javascript:void(0);" class="flex items-center space-x-2" onclick="showHideComment('{{ $post->id }}');">
                @if ($post->hide_comment != 1)
                    <div class="p-2 rounded-full text-black lg:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>Suggestion</div>
                @endif
            </a>
        </div>
        @if (post_like_counts($post->id) > 0)
            <div class="flex items-center space-x-3 pt-2">
                <div class="flex items-center">
                    @foreach (get_first_three_user_image($post->id) as $userId)                    
                        <img src="{{ get_user_image_by_id($userId->user_id) }}" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900" />
                    @endforeach 
                </div>
                <div class="dark:text-gray-100">Liked by<strong> {{ show_user_name(post_liked_user_id($post->id)) }}</strong> and <strong> {{ post_like_counts($post->id) }} Others </strong></div>
            </div>
        @endif
        <div class="border-t py-4 space-y-4 dark:border-gray-600" id="commentsection__{{ $post->id }}">
            {!! showPostComments($post->id) !!}
        </div>

        <div class="bg-gray-100 rounded-full relative dark:bg-gray-800 border-t commentBox__{{ $post->id }}" style="display:none;">


            <input placeholder="Add your Comment.." class="bg-transparent max-h-10 shadow-none px-5" id="comment-form{{ $post->id }}" data-emojiable="true" data-postId="{{ $post->id }}" onkeydown="saveComment(this,'{{ $post->id }}')">
        </div>
    </div>
</div>