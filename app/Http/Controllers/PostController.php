<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Config;
use DB;
use Mail;
use Redirect;
use Hash;
use DateTime;
use App\User;
use App\Countries;
use App\UserAddress;
use App\Posts;
use App\PostsLike;
use App\PostsPoll;
use App\PostsComments;
use App\CommentLike;
use App\BecomeSeller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

class PostController extends Controller
{
    /**
     * @param Request $request
     * Saves a new blog post.
     * 1 for simple,2 for polls,3 for product, 4 for suggestion
     * @return JsonResponse
     */

    public function store(Request $request)
    {
        if ($request->hasFile('post_video_upload')) {
            $rules = [
                'post_video_upload' => 'max:5120'
            ];    
            $messages = [
                'post_video_upload.max' => 'Video duration is too large (maximun size 5 mb)'
            ];
            $validator = Validator::make( $request->all(), $rules, $messages );                      
        }

        if ($request->hasFile('product_video_upload')) {
            $rules = [
                'product_video_upload' => 'max:5120'
            ];    
            $messages = [
                'product_video_upload.max' => 'Video duration is too large (maximun size 5 mb)'
            ];
            $validator = Validator::make( $request->all(), $rules, $messages );            
        }

        if (isset($validator) && $validator->fails()) {
            $messags['message'] = $validator->errors()->first();
            $messags['erro'] = 202;
            return response()->json($messags, 200);
        }

        if (Auth::user()->switch_as == 'seller') {
            $request['store_id'] = BecomeSeller::where('user_id', Auth::user()->id)->pluck('id')->first();
        }
        $image = '';
        switch ($request->postType) {
            case 1:

                if ($request->hasFile('post_image_upload')) {
                    $file = $request->file('post_image_upload');
                    $imageName = time() . '_' . Auth::user()->id . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('/posts/images');
                    $file->move($destinationPath, $imageName);
                    $type = 'image';
                } else {
                    $imageName = '';
                }

                if ($request->hasFile('post_video_upload')) {
                    $file = $request->file('post_video_upload');
                    $videoName = time() . '_' . Auth::user()->id . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('/posts/images');
                    $file->move($destinationPath, $videoName);
                    $type = 'video';
                } else {
                    $videoName = '';
                }
                
                if ($request->hasFile('post_image_upload') && $request->hasFile('post_video_upload')) {
                    $type = 'both';
                }

                $store = [
                    'user_id' => Auth::user()->id,
                    'content' => $request->post_content,
                    'post_type' => $request->postType,
                    'image' => $imageName,
                    'video' => $videoName,
                    'store_id' => $request->store_id,
                    'file_type' => $type
                ];

                break;
            case 2:

                if ($request->hasFile('poll_image_upload')) {
                    $image = $request->file('poll_image_upload');
                    $imagename = time() . '_' . Auth::user()->id . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/posts/images');
                    $image->move($destinationPath, $imagename);
                    $image = $imagename;
                    $type = 'image';
                }

                $store = [
                    'user_id' => Auth::user()->id,
                    'content' => $request->poll_post_content,
                    'post_type' => $request->postType,
                    'button1' => $request->pollButton1,
                    'button2' => $request->pollButton2,
                    'image' => $image,
                    'store_id' => $request->store_id,
                    'file_type' => $type
                ];
                break;
            case 3:

                if ($request->hasFile('product_image_upload')) {
                    $file = $request->file('product_image_upload');
                    $imageName = time() . '_' . Auth::user()->id . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('/posts/images');
                    $file->move($destinationPath, $imageName);
                    $type = 'image';
                } else {
                    $imageName = '';
                }

                if ($request->hasFile('product_video_upload')) {
                    $file = $request->file('product_video_upload');
                    $videoName = time() . '_' . Auth::user()->id . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('/posts/images');
                    $file->move($destinationPath, $videoName);
                    $type = 'video';
                } else {
                    $videoName = '';
                }

                if ($request->hasFile('product_image_upload') && $request->hasFile('product_video_upload')) {
                    $type = 'both';
                }

                $store = [
                    'content' => $request->product_post_content,
                    'user_id' => Auth::user()->id,
                    'post_type' => $request->postType,
                    'product_name' => $request->product_post_content,
                    'price' => $request->product_price,
                    'image' => $imageName,
                    'video' => $videoName,
                    'file_type' => $type
                ];
                break;
            case 4:
                if ($request->hasFile('suggestion_image_upload')) {
                    $image = $request->file('suggestion_image_upload');
                    $imagename = time() . '_' . Auth::user()->id . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/posts/images');
                    $image->move($destinationPath, $imagename);
                    $image = $imagename;
                    $type = 'image';
                }

                $store = [
                    'user_id' => Auth::user()->id,
                    'content' => $request->suggestion_post_content,
                    'post_type' => $request->postType,
                    'image' => $image,
                    'file_type' => $type
                ];
                break;

            default:
                $store = [
                    'user_id' => Auth::user()->id,
                    'content' => $request->content,
                    'post_type' => $request->postType,
                    'product_name' => $request->product_name,
                    'price' => $request->price,
                    'button1' => $request->button1,
                    'button2' => $request->button2,
                ];
        }

        if (Posts::create($store)) {
            $messags['message'] = "Post added successfully.";
            $messags['erro'] = 101;
            return response()->json($messags, 200);
        } else {
            $messags['message'] = "Error while added Post. Please try again later.";
            $messags['erro'] = 202;
            return response()->json($messags, 200);
        }
    }

    public function edit(Request $request)
    {       
        $editPost = Posts::where('id', $request->id)->first();
        return $editPost;
    }

    public function update(Request $request)
    {
        $post = Posts::where('id', $request->postId)->first();
        if ($request->file('post_video_update')) {
            $video = $request->file('post_video_update');
            $videoName = time() . '_' . Auth::user()->id . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('/posts/images');
            $video->move($destinationPath, $videoName);
            $type = 'video';           
        } else {
            $videoName = $post->video;
            $type = 'video';
        }
        
        if ($request->file('post_image_update')) {
            $image = $request->file('post_image_update');
            $imageName = time() . '_' . Auth::user()->id . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/posts/images');
            $image->move($destinationPath, $imageName);
            $type = 'image';    
        } else {
            $imageName = $post->image;
            $type = 'image';
        }

        if (isset($videoName) && isset($imageName)) {
            $type = 'both';
        }

        $updatePost = Posts::where('id', $request->postId)->update([
            'content' => $request->post_content,
            'image' => $imageName,
            'video' => $videoName,
            'file_type' => $type,
        ]);
        
        if ($updatePost) {
            $messags['message'] = "Post updated successfully.";
            $messags['erro'] = 101;
            return response()->json($messags, 200);
        }
    }

    function delete(Request $request)
    {
        DB::beginTransaction();

        try {

            $post = Posts::select('image', 'video')
                ->where('id', $request->id)
                ->first();
            File::delete(public_path("/posts/images/$post->image"));
            File::delete(public_path("/posts/images/$post->video"));
            Posts::where('id', $request->id)->delete();
            PostsComments::where('post_id', $request->id)->delete();
            PostsLike::where('post_id', $request->id)->delete();
            $messags['message'] = "Post has been deleted.";
            $messags['erro'] = 101;
            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();
            $messags['message'] = "Something went wrong please try again!";
            $messags['erro'] = 101;
            
        }
        return response()->json($messags, 200);
    }

    function likeComment(Request $request)
    {
        $request['comment_id'] = $request->commentId;
        $request['user_id'] = Auth::user()->id;
        if (CommentLike::where('comment_id', $request->commentId)->where('user_id', Auth::user()->id)->exists()) {
            $likeComment = CommentLike::where('comment_id', $request->commentId)->where('user_id', Auth::user()->id)->delete();
            $comment = 'unLiked';
        } else {
            $likeComment = CommentLike::create($request->all());
            $comment = 'liked';
        }
        
        if ($likeComment) {
            $messags['message'] = "Comments liked successfully.";
            $messags['erro'] = 101;
            $messags['commentStatus'] = $comment;
            return response()->json($messags, 200);
        }

    }

    public function disableComment(Request $request)
    {        
        $disableComment = PostsComments::where('post_id', $request->id)->update([
            'hide_comment' => 1,
        ]);
        Posts::where('id', $request->id)->update([
            'hide_comment' => 1,
        ]);
        if ($disableComment) {
            $messags['message'] = "Post comments has been disabled.";
            $messags['erro'] = 101;
            return response()->json($messags, 200);
        }
    }

    public function enableComment(Request $request)
    {        
        $enableComment = PostsComments::where('post_id', $request->id)->update([
            'hide_comment' => NULL,
        ]);
        Posts::where('id', $request->id)->update([
            'hide_comment' => NULL,
        ]);
        if ($enableComment) {
            $messags['message'] = "Post comments has been enabled.";
            $messags['erro'] = 101;
            return response()->json($messags, 200);
        }
    }

    public function likePost(Request $request)
    {
        $postId = $request->postid;
        $userId = Auth::user()->id;

        if (PostsLike::create(['post_id' => $postId, 'user_id' => $userId])) {
            $messags['message'] = "Liked successfully.";
            $messags['erro'] = 101;
            return response()->json($messags, 200);
        } else {
            $messags['message'] = "Error while like Post. Please try again later.";
            $messags['erro'] = 202;
            return response()->json($messags, 200);
        }
    }

    public function unLikePost(Request $request)
    {
        $postId = $request->postid;
        $userId = Auth::user()->id;
        if (PostsLike::where('post_id', $postId)->where('user_id', $userId)->exists()) {
            if (PostsLike::where('post_id', $postId)->where('user_id', $userId)->delete()) {
                $messags['message'] = "Unliked successfully.";
                $messags['erro'] = 101;
                return response()->json($messags, 200);
            } else {
                $messags['message'] = "Error while unlike Post. Please try again later.";
                $messags['erro'] = 202;
                return response()->json($messags, 200);
            }
        }
    }

    public function updatePoll(Request $request)
    {
        $postId = $request->postid;
        $userId = Auth::user()->id;
        $pollReply = $request->postreply;

        if (PostsPoll::where('post_id', $postId)->where('user_id', $userId)->exists()) {

            PostsPoll::where('post_id', $postId)->where('user_id', $userId)->update(['poll_reply' => $pollReply]);
            $postPollData = pollPostData($postId);

            $messags['message'] = "updated Successfully.";
            $messags['erro'] = 101;
            $messags['option1Percentage'] = $postPollData->option1Percentage;
            $messags['option2Percentage'] = $postPollData->option2Percentage;
            return response()->json($messags, 200);
        } else {
            PostsPoll::create(['post_id' => $postId, 'user_id' => $userId, 'poll_reply' => $pollReply]);
            $postPollData = pollPostData($postId);

            $messags['message'] = "Inserted Successfully.";
            $messags['erro'] = 101;
            $messags['option1Percentage'] = $postPollData->option1Percentage;
            $messags['option2Percentage'] = $postPollData->option2Percentage;
            return response()->json($messags, 200);
        }
    }

    public function postComment(Request $request)
    {
        $postId = $request->postid;
        $userId = Auth::user()->id;
        $post_comment = $request->postcomment;

        if (PostsComments::create(['post_id' => $postId, 'user_id' => $userId, 'post_comment' => $post_comment])) {
            $messags['comments'] = showPostComments($postId);
            $messags['message'] = "commented successfully.";
            $messags['erro'] = 101;
        } else {
            $messags['comments'] = showPostComments($postId);
            $messags['message'] = "Error while comment on Post. Please try again later.";
            $messags['erro'] = 202;
        }

        return response()->json($messags, 200);
    }
}
