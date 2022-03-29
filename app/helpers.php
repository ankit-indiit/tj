<?php

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Posts;
use App\PostsLike;
use App\PostsPoll;
use App\PostsComments;
use App\CommentLike;
use App\BecomeSeller;
use App\ProductCategory;
use App\ProductAttr;
use App\Wishlist;
use App\SellerSocialLink;
use App\SellerWorkingHour;

if (!function_exists('show_user_image')) {
    function show_user_image($id = '')
    {
        if (!empty($id)) {
            $user_data = User::where('id', $id)->select('profile_image')->first();
            $user_image = $user_data->profile_image == '' ? asset('images/avatars/avatar-8.jpg') : url('public/profile') . "/" . $user_data->profile_image;
        } else {
            $user_image = Auth::user()->profile_image == '' ? asset('images/avatars/avatar-8.jpg') : url('public/profile') . "/" . Auth::user()->profile_image;
        }
        return  $user_image;
    }
}

if (!function_exists('show_user_name')) {
    function show_user_name($id = '')
    {       
        return  User::where('id', $id)->pluck('name')->first();
    }
}

if (!function_exists('checkIfAuthIsSeller')) {
    function checkIfAuthIsSeller($authId = '')
    {       
        return BecomeSeller::where('user_id', $authId)->exists();
    }
}

if (!function_exists('post_like_counts')) {
    function post_like_counts($postId = '')
    {       
        return PostsLike::where('post_id', $postId)->where('user_id', '!=', Auth::user()->id)->count();
    }
}

if (!function_exists('get_first_three_user_image')) {
    function get_first_three_user_image($postId = '')
    {       
        return  PostsLike::where('post_id', $postId)->where('user_id', '!=', Auth::user()->id)->select('user_id')->get();
    }
}

if (!function_exists('get_user_image_by_id')) {
    function get_user_image_by_id($id = '')
    {       
        $userImage =  User::where('id', $id)->pluck('profile_image')->first();
        $userImg = $userImage  != "" ? $userImage : '1646049529.png';
        return url('public/profile').'/'.$userImg;
    }
}

if (!function_exists('post_liked_user_id')) {
    function post_liked_user_id($postId = '')
    {       
        return  PostsLike::where('post_id', $postId)->where('user_id', '!=', Auth::user()->id)->pluck('user_id')->first();
    }
}


if (!function_exists('user_posts')) {
    function user_posts($id = '')
    {
        $user_id = $id == "" ? Auth::user()->id : $id;
        if (Route::currentRouteName() == 'feed') {
            return  Posts::orderBy('id', 'desc')->get();
        } else {
            return  Posts::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        }
    }
}


if (!function_exists('show_time_ago')) {
    function show_time_ago($timestamp)
    {
        return \Carbon\Carbon::createFromTimeStamp(strtotime($timestamp))->diffForHumans();
    }
}

if (!function_exists('show_like_module')) {
    function show_like_module($postId)
    {
        if (PostsLike::where('post_id', $postId)->where('user_id', Auth::user()->id)->exists()) {
            return '<a href="javascript:void(0);" onclick="unLikePost(' . $postId . ')" class="flex items-center space-x-2">
                <div class="p-2 rounded-full text-blue lg:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
                    </svg>
                </div>
                <div class="text-blue">Like</div>
            </a>';
        } else {
            return '<a href="javascript:void(0);" onclick="likePost(' . $postId . ')" class="flex items-center space-x-2">
                <div class="p-2 rounded-full text-black lg:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
                    </svg>
                </div>
                <div class="text-black">Like</div>
            </a>';
        }
    }
}


if (!function_exists('pollPostData')) {
    function pollPostData($postId)
    {
        $postData = Posts::where('id', $postId)->first();
        $option1 = $postData->button1;
        $option2 = $postData->button2;

        $pollOption1 = PostsPoll::where('post_id', $postId)->where('poll_reply', $option1)->count();
        $pollOption2 = PostsPoll::where('post_id', $postId)->where('poll_reply', $option2)->count();


        /*calculate pooling percentage*/
        $totalPolls = ($pollOption1 + $pollOption2);

        if ($totalPolls == 0) {
            $option1Percentage = 0;
            $option2Percentage = 0;
        } else {
            if ($pollOption1 == 0) {
                $option1Percentage = 0;
            } else {
                $option1Percentage = ($pollOption1 * 100) / $totalPolls;
            }

            if ($pollOption2 == 0) {
                $option2Percentage = 0;
            } else {
                $option2Percentage = ($pollOption2 * 100) / $totalPolls;
            }
        }

        $returnObject = new stdClass();
        $returnObject->option1Percentage = round($option1Percentage);
        $returnObject->option2Percentage = round($option2Percentage);

        return $returnObject;
    }
}

if (!function_exists('likedUnlikeComment')) {
    function likedUnlikeComment($commentId = '')
    {
        return  CommentLike::where('comment_id', $commentId)->where('user_id', Auth::user()->id)->exists();
    }
}

if (!function_exists('showPostComments')) {
    function showPostComments($postId)
    {
        $comments = PostsComments::where('post_id', $postId)->where('hide_comment', NULL)->get();

        $returnHtml = '';

        if (count($comments) > 0) {
            foreach ($comments as $comment) {
                $userimage = show_user_image($comment->user_id);
                $commentId = $comment->id;
                $heartColor = likedUnlikeComment($comment->id) ? 'text-primary-600 font-weight-bold' : 'text-red-600';
                $returnHtml .= '<div class="flex">
                    <div class="w-10 h-10 rounded-full relative flex-shrink-0">
                        <img src="'.$userimage.'" alt="" class="absolute h-full rounded-full w-full">
                    </div>
                    <div>
                        <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 relative lg:ml-5 ml-2 lg:mr-12  dark:bg-gray-800 dark:text-gray-100">
                            <p class="leading-6">'.$comment->post_comment.'</p>
                            <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div>
                        </div>
                        <div class="text-sm flex items-center space-x-3 mt-2 ml-5">
                            <a href="javascript:void(0);" id="likeUnlikeComment" data-id='.$comment->id.' class="'.$heartColor.'"> <i class="uil-heart"></i> Love </a>
                            <span> '.show_time_ago($comment->created_at).' </span>
                        </div>
                    </div>
                </div>';
            }
        }

        return $returnHtml;
    }
}

if (!function_exists('getAllProductCagetories')) {
    function getAllProductCagetories()
    {       
        return ProductCategory::select('id', 'name')->get();
    }
}

if (!function_exists('getAllProductAttributes')) {
    function getAllProductAttributes()
    {       
        return ProductAttr::where('user_id', Auth::user()->id)->select('name', 'option')->get();
    }
}

if (!function_exists('getProductCategoryNameById')) {
    function getProductCategoryNameById($id)
    {       
        return ProductCategory::where('id', $id)->pluck('name')->first();
    }
}

if (!function_exists('checkIfProductInWishlist')) {
    function checkIfProductInWishlist($userId, $productId)
    {       
        return Wishlist::where('product_id', $productId)->where('user_id', $userId)->exists();
    }
}

if (!function_exists('checkIfSocialLinkExist')) {
    function checkIfSociaLinknExist($userId, $socialIcon)
    {       
        return SellerSocialLink::where('seller_id', $userId)->where('social_icon', $socialIcon)->exists();
    }
}

if (!function_exists('checkIfWorkingDayExist')) {
    function checkIfWorkingDayExist($userId, $day)
    {       
        return SellerWorkingHour::where('seller_id', $userId)->where('day', $day)->exists();
    }
}

