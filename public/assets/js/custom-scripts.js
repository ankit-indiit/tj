/* custom scripts function */

function likePost(postId) {
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: _baseURL + "/like-post",
        data: { postid: postId },
        dataType: 'json',
        success: function (data) {
            if (data.erro == '101') {
                const htmlContent = '<a href="javascript:void(0);" onclick="unLikePost(' + postId + ')" class="flex items-center space-x-2"><div class="p-2 rounded-full text-blue lg:bg-gray-100" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path></svg></div><div class="text-blue">Like</div></a>';
                $('#like__' + postId).html(htmlContent);
                // window.location.reload();
            }
        }
    });
}

function unLikePost(postId) {
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: _baseURL + "/unlike-post",
        data: { postid: postId },
        dataType: 'json',
        success: function (data) {
            if (data.erro == '101') {
                const htmlContent = '<a href="javascript:void(0);" onclick="likePost(' + postId + ')" class="flex items-center space-x-2"><div class="p-2 rounded-full text-black lg:bg-gray-100"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path></svg></div><div class="text-black">Like</div></a>';
                $('#like__' + postId).html(htmlContent);
                // window.location.reload();
            }
        }
    });
}

function pollPost(postId, postReply) {
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: _baseURL + "/update-poll",
        data: { postid: postId, postreply: postReply },
        dataType: 'json',
        success: function (data) {
            if (data.erro == '101') {
                $('#btn1__' + postId).html(data.option1Percentage);
                $('#btn2__' + postId).html(data.option2Percentage);
            }
            console.log(data)
        }
    });
}

function showHideComment(postId) {
    if ($('.commentBox__' + postId).css('display') == 'none') {
        $('.commentBox__' + postId).show();
    }
    else {
        $('.commentBox__' + postId).hide();
    }
}

$(document).ready(function () {

    $(".emoji-wysiwyg-editor").keydown(function (e) {
        if (e.keyCode == 13) {
            let string = $(this).html();
            let editorId = $(this).attr('data-id');
            let postId = $('input[data-id="' + editorId + '"]').attr('data-postId');

            if (string != '') {
                $(this).html('');

                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: _baseURL + "/post-comment",
                    data: { postid: postId, postcomment: string },
                    dataType: 'json',
                    success: function (data) {
                        if (data.erro == '101') {
                            $('.commentBox__' + postId).hide();
                            $('#commentsection__' + postId).html(data.comments);

                        }
                        console.log(data)
                    }
                });
            }
        }
    });
});

function clearImage(imageId)
{
  $('#'+imageId).removeAttr('src');
  $('#'+imageId).removeAttr('style');
  $("#"+imageId).css("height", 0);
}

function hideCurrentOpenModal(modalId) {
  UIkit.modal('#' + modalId).hide();
}

function updatePost(id)
{
    $.ajax({        
        type: 'get',
        url: _baseURL + "/edit-simple-post",
        data: { id: id },
        success: function (data) {
            console.log(id);
            if (data.post_type == 1) {
                $('#postTitle').html('Simple Post');
            } else if (data.post_type == 2) {
                $('#postTitle').html('Poll Post');
            } else if (data.post_type == 3) {
                $('#postTitle').html('Product Post');
            } else if (data.post_type == 4) {
                $('#postTitle').html('Suggestion Post');
            }
            $("#edited_post_content").html(data.content);
            $('#update_preview_simple_post_image').attr('src', _baseURL+'/public/posts/images/'+data.image);
            $("#editedPostId").val(id);
            var modal = UIkit.modal("#update-post-modal");
            modal.show();             
        }
    });
}

function disableComment(id)
{
    $('#disablePostComment').on('click', function(){
        $.ajax({        
            type: 'get',
            url: _baseURL + "/disable-post-comment",
            data: { id: id },
            success: function (data) {
                if (data.erro == '101') {
                    window.location.reload();
                }
            }
        });
    });
}

function enableComment(id)
{
    $('#enablePostComment').on('click', function(){
        $.ajax({        
            type: 'get',
            url: _baseURL + "/enable-post-comment",
            data: { id: id },
            success: function (data) {
                if (data.erro == '101') {
                    window.location.reload();
                }
            }
        });
    });
}

function deletePost(id)
{
    $('#delete-post').on('click', function(){
        $.ajax({        
            type: 'get',
            url: _baseURL + "/delete-post",
            data: { id: id },
            success: function (data) {
                console.log(data);
                if (data.erro == '101') {
                    window.location.reload();
                }
            }
        });
    });
}

$(document).on('click', '#likeUnlikeComment', function(){
    var commentId = $(this).data('id');
    $.ajax({        
        type: 'get',
        url: _baseURL + "/like-comment",
        data: { commentId: commentId },
        success: function (data) {
            console.log(data.commentStatus);
            if (data.commentStatus == 'liked') {
                    $('#likeUnlikeComment').addClass('text-primary-600 font-weight-bold');
                    $('#likeUnlikeComment').removeClass('text-red-600');
                } else {
                    $('#likeUnlikeComment').addClass('text-red-600');
                    $('#likeUnlikeComment').removeClass('text-primary-600 font-weight-bold');
                }
                // window.location.reload();
            }
    });
});

function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

function eraseCookie(key) {
    var keyValue = getCookie(key);
    setCookie(key, keyValue, '-1');
}

$(document).ready(function(){
    $('.chosen-container').addClass('w-100');
    if (getCookie("becomeSellerNotification") == 'closed') {
        $('.become-a-seller').addClass('d-none');
    }
});

$(document).on('click', '#closeBecomeSeller', function(){
    setCookie("becomeSellerNotification", "closed");
});