<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Posts;
use App\PostsLike;
use App\PostsPoll;
use App\PostsComments;
use App\CommentLike;
use App\BecomeSeller;
use App\ProductCategory;
use App\ProductAttr;
use App\ProductCollection;
use App\Wishlist;
use App\SellerSocialLink;
use App\SellerWorkingHour;
use App\Friendship;
use App\ShopFollower;
use App\ProductReview;
use App\Cart;
use App\Product;
use App\Message;

if (!function_exists('show_user_image')) {
    function show_user_image($id = '')
    {
        if (!empty($id)) {
            $user_data = User::where('id', $id)->select('profile_image','name')->first();
            $user_image = $user_data->profile_image;
        } else {
            $user_image = Auth::user()->profile_image;
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

if (!function_exists('getUserById')) {
    function getUserById($id = '')
    {       
        return  User::findOrFail($id);
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
        return $userImage  != "" ? $userImage : url('public/profile').'/'.'1646049529.png';
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
        $userFrd = userFriends();
        $user_id = $id == "" ? Auth::user()->id : $id;
        array_push($userFrd, Auth::user()->id);
        if (Route::currentRouteName() == 'feed') {
            if ($userFrd) {
                return  Posts::orderBy('id', 'desc')->get();
            } else {
                return  Posts::whereIn('user_id', $userFrd)->orderBy('id', 'desc')->get();
            }
        } elseif (Route::currentRouteName() == 'shop.profile') {
            return  Posts::where('store_id', $id)->orderBy('id', 'desc')->get();
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

if (!function_exists('addToWishlistButtonSection')) {
    function addToWishlistButtonSection($userId, $productId)
    {       
        $checkWishlist = Wishlist::where('product_id', $productId)->where('user_id', $userId)->exists();
        if ($checkWishlist == 1) {
            return '<a href="javascript:void(0);" class="bg-blue-100 absolute right-2 top-2 p-0.5 px-1.5 rounded-full text-blue-500">
          <i class="icon-feather-heart"> </i>
          </a>';
        } else {
            return '<a href="javascript:void(0);" id="addProductToWishlist" data-id="'.$productId.'" class="bg-red-100 absolute right-2 top-2 p-0.5 px-1.5 rounded-full text-red-500" disabled>
          <i class="icon-feather-heart"> </i>
          </a>';
        }  
    }
}

if (!function_exists('wishlistCount')) {
    function wishlistCount()
    {       
        return Wishlist::where('user_id', Auth::user()->id)->count();
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

if (!function_exists('hideFeedThingFromTimeLine')) {
    function hideFeedThingFromTimeLine($userId = '')
    {       
        if (Route::currentRouteName() == 'time.line') {
            return 'd-none';
        } else {
            return '';
        }
    }
}

if (!function_exists('userFollowUnFollowButtonSection')) {
    function userFollowUnFollowButtonSection($id = '')
    {       
        $friendshipStatus = DB::select('SELECT * FROM
                (
                   SELECT * FROM friendships  where  first_user = "'.Auth::user()->id.'" AND second_user = "'.$id.'"
                   
                   UNION

                   SELECT * FROM friendships where second_user = "'.Auth::user()->id.'" AND first_user = "'.$id.'"

                )
            friendships');
        $sctedUser = Friendship::where('acted_user', Auth::user()->id)
            ->where('second_user', $id)
            ->where('status', 'pending')
            ->pluck('id')->first();

        // return $friendshipStatus[0]->block_by;
        if ($friendshipStatus[0]->status == 'pending') {

            if ($sctedUser) {
                return '<div class="my-3 userFriendshipBtnSection'.$id.'">
                    <a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="'.$id.'" data-status="pending" class="btn btn-primary btn-sm">Requested</a>
                    <a href="'.route('chat').'" onclick="sendMessage('.$id.');" data-id="'.$id.'" class="btn btn-primary btn-sm">Message</a>
                </div>';
            } else {
                return '<div class="my-3 userFriendshipBtnSection'.$id.'">
                    <a href="javascript:void(0);" id="followBack" data-id="'.$sctedUser.'" data-user-id="'.$id.'" data-notification-id="" class="btn btn-primary btn-sm">Follow back</a>
                    <a href="'.route('chat').'" onclick="sendMessage('.$id.');" class="btn btn-primary btn-sm">Message</a>
                </div>';
            }                     

        } elseif ($friendshipStatus[0]->status == 'confirmed') {
           
            return '<div class="my-3 userFriendshipBtnSection'.$id.'">
              <a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="'.$id.'" data-status="confirmed" class="btn btn-primary btn-sm">Friend</a>
              <a href="'.route('chat').'" onclick="sendMessage('.$id.');" class="btn btn-primary btn-sm">Message</a>
              <a href="javascript:void(0);" id="blockFriend" data-id="'.$id.'" class="btn btn-danger btn-sm">Block</a>
           </div>';

        } elseif ($friendshipStatus[0]->status == 'blocked') {

            if (isset($friendshipStatus[0]->block_by) && $friendshipStatus[0]->block_by == Auth::user()->id) {

                return '<div class="my-3 userFriendshipBtnSection'.$id.'">
                  <a href="javascript:void(0);" id="unBlockFriend" data-id="'.$id.'" class="btn btn-secondary btn-sm">Blocked</a>
                </div>';

            } else {
                return '';
            }

        } else {

            return '<div class="my-3 userFriendshipBtnSection'.$id.'">
              <a href="javascript:void(0);" id="followForFriendship" data-id="'.$id.'" class="btn btn-primary btn-sm">Follow</a>
            </div>';
        
        }
    }
}

if (!function_exists('userFriends')) {
    function userFriends($id = '')
    {       
        $userIds = array();
        $user_id = $id == "" ? Auth::user()->id : $id;
        $exceptUserIds = DB::select('SELECT DISTINCT(friendships.userIds) FROM
                (
                   SELECT first_user as userIds, created_at FROM friendships  where  second_user = "'.$user_id.'" AND status = "confirmed"
                   
                   UNION

                   SELECT second_user as userIds, created_at FROM friendships where first_user = "'.$user_id.'" AND status = "confirmed"

                )
            friendships WHERE friendships.userIds IS NOT NULL order by friendships.created_at desc');

        if(count($exceptUserIds) > 0)
        {
            foreach($exceptUserIds as $userId)
            {
               array_push($userIds, $userId->userIds);
            }
        }
        return array_unique($userIds);    
    }
}

if (!function_exists('userFollowers')) {
    function userFollowers($id = '')
    {
        $postIds = (array)Posts::where('user_id', Auth::user()->id)->pluck('id');
        $commentorIds = (array)PostsComments::whereIn('post_id', array_values($postIds)[0])
            ->where('user_id', '!=', Auth::user()->id)
            ->pluck('user_id');
        $commentorIds = array_unique(array_values($commentorIds)[0]);      
        $likerIds = (array)PostsLike::whereIn('post_id', array_values($postIds)[0])
            ->where('user_id', '!=', Auth::user()->id)
            ->pluck('user_id');
        $likerIds = array_unique(array_values($likerIds)[0]);
        $followerIds = array_merge($commentorIds, $likerIds);
        return User::whereIn('id', array_unique($followerIds))->pluck('id');
    }
}

if (!function_exists('checkFriendshipPendingStatus')) {
    function checkFriendshipPendingStatus($secondUser = '')
    {       
        $firendshipStatus = Friendship::where('first_user', $secondUser)
            ->orWhere('first_user', Auth::user()->id)
            ->where('second_user', Auth::user()->id)
            ->orWhere('second_user', $secondUser)
            ->pluck('status')->first();
        if (isset($firendshipStatus) && $firendshipStatus == 'pending') {
            return 1;
        }              
    }
}

if (!function_exists('userUnreadNotification')) {
    function userUnreadNotification($secondUser = '')
    {       
        $user = User::findOrFail(Auth::user()->id);
        return $user->unReadNotifications;              
    }
}

if (!function_exists('userMsgNotification')) {
    function userMsgNotification()
    {               
        return DB::table('notifications')
            ->where('type', 'App\Notifications\MessageNotification')
            ->where('notifiable_id', Auth::user()->id)
            ->where('read_at', NULL)
            ->get();;              
    }
}

if (!function_exists('getAllUserIds')) {
    function getAllUserIds()
    {       
        return User::where('id', '!=', Auth::user()->id)->whereNotIn('id', userFriends())->pluck('id');              
    }
}

if (!function_exists('getOnlineUsers')) {
    function getOnlineUsers()
    {       
        return User::select('id', 'name', 'profile_image')
            ->where('id', '!=', Auth::user()->id)
            ->whereIn('id', userFriends())
            ->where('last_seen', '!=', NULL)
            ->orderBy('last_seen', 'DESC')
            ->get();          
    }
}

if (!function_exists('showAllShop')) {
    function showAllShop()
    {       
        return BecomeSeller::select('id', 'shop_name', 'image')            
            ->orderBy('id', 'DESC')
            ->get();          
    }
}

if (!function_exists('getAllShopFollowers')) {
    function getAllShopFollowers($id = '')
    {       
        return ShopFollower::select('user_id')            
            ->where('store_id', $id)
            ->get();          
    }
}

if (!function_exists('checkFollowShopStatus')) {
    function checkFollowShopStatus($storeId = '')
    {       
        return ShopFollower::where('user_id', Auth::user()->id)->where('store_id', $storeId)->exists();          
    }
}

if (!function_exists('getShopMemberCount')) {
    function getShopMemberCount($storeId = '')
    {       
        return ShopFollower::where('store_id', $storeId)->count();          
    }
}

if (!function_exists('getShopMemberSection')) {
    function getShopMemberSection($shopId = '')
    {       
        $lastMember = ShopFollower::where('store_id', $shopId)
            ->orderBy('id', 'DESC')
            ->pluck('user_id')
            ->first();
        $membersCount = ShopFollower::where('store_id', $shopId)            
            ->count();

        $membersCount = $membersCount-1;

        return '<div class="flex items-center space-x-3 pt-2"> 
           <div class="flex items-center">
               <img src="'.get_user_image_by_id($lastMember).'" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900">
           </div>
           <div class="dark:text-gray-100">
             <strong>'.show_user_name($lastMember).'</strong> and '.$membersCount.' friend are members
           </div>
       </div>';         
    }
}

if (!function_exists('checkIfUserSubmitedReview')) {
    function checkIfUserSubmitedReview($id = '')
    {       
        return ProductReview::where('product_id', $id)->where('user_id', Auth::user()->id)->exists();
    }
}

if (!function_exists('getProductCollection')) {
    function getProductCollection($id = '')
    {       
        return ProductCollection::where('id', $id)->pluck('name')->first();
    }
}

if (!function_exists('productCartButton')) {
    function productCartButton($productId = '')
    {       
        $checkCartProduct = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->exists();
        if ($checkCartProduct == 1) {
            return '<div class="addToCartDiv'.$productId.'"><a href="'.route('cart').'" class="absolute right-2 top-2 p-0.5 px-1.5 text-red-500 cart-icon-main">Go To Cart</a></div>';
        } else {
            return '<div class="addToCartDiv'.$productId.'"><a href="javascript:void(0);" id="addToCart" data-product="'.$productId.'" class="absolute right-2 top-2 p-0.5 px-1.5 text-red-500 cart-icon-main">Add to Cart</a><input type="hidden" id="productQuantity'.$productId.'" value="1" name=""></div>';
        }
    }
}

if (!function_exists('cartCount')) {
    function cartCount($productId = '')
    {       
        return Cart::where('user_id', Auth::user()->id)->count();
    }
}

if (!function_exists('getLastMessage')) {
    function getLastMessage($userId = '')
    {       
        $last_message =  Message::select('chat')
            ->where('type',1)
            ->where('to_id',$userId )
            ->orWhere('from_id',$userId)
            ->where('type',1)
            ->orderBy('created_at', 'Desc')
            ->first();

        if(!empty($last_message))
        {
            return \Illuminate\Support\Str::limit(strip_tags($last_message->chat), 50, '...');
        }
        else
        {
            return '';
        }
    }
}



