<div class="bg-white shadow border border-gray-100 rounded-lg dark:bg-gray-900 lg:mx-0 uk-animation-slide-bottom-small">
    <!-- post header-->
    <div class="flex justify-between items-center lg:p-4 p-2.5">
        <div class="flex flex-1 items-center space-x-4">
            @php
                $profileRoute = route('my-profile').'?tab=feed';
                $userId= Crypt::encrypt($post->user_id);
            @endphp
            <a href="{{ $post->user_id == Auth::user()->id ? $profileRoute : route('time.line', $userId) }}">
                <img src="{{ show_user_image($post->user_id) }}" class="bg-gray-200 border border-white rounded-full w-10 h-10" />
            </a>
            <div class="flex-1 font-semibold capitalize">
                <a href="{{ $post->user_id == Auth::user()->id ? $profileRoute : route('time.line', $userId) }}" class="text-black"> {{ show_user_name($post->user_id) }} </a>
                <div class="text-gray-700 flex items-center space-x-2"> {{ show_time_ago($post->created_at) }}
                    <ion-icon name="people" role="img" class="md hydrated" aria-label="people"></ion-icon>
                </div>
            </div>
        </div>
        <div class="{{ hideFeedThingFromTimeLine() }}">
            <a href="#" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
            <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">
                <ul class="space-y-1">
                    <li>
                        <a href="#"  uk-toggle="target: #share-post-modal" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800"> <i class="uil-share-alt mr-1"></i> Share </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800" onclick="updatePost(<?php echo $post->id; ?>);"> <i class="uil-edit-alt mr-1"></i> Edit Post </a>
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
        <div class="poll-container">
            <h3 class="poll-question">{{ $post->content }}</h3>
            @php
                $pollPostData = pollPostData($post->id);
            @endphp
            <span class="btngroup">
                <button class="btngroup--btn ys-btn" onclick="pollPost('{{ $post->id }}','{{ $post->button1 }}')">
                    {{ $post->button1 }}<br />
                    <span id="btn1__{{ $post->id }}">{{ $pollPostData->option1Percentage }}</span>%
                </button>
                <button class="btngroup--btn" onclick="pollPost('{{ $post->id }}','{{ $post->button2 }}')">
                    {{ $post->button2 }} <br />
                    <span id="btn2__{{ $post->id }}">{{ $pollPostData->option2Percentage }}</span>%
                </button>
            </span>
        </div>
    </div>
</div>