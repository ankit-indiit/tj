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

function clearVideo(videoId)
{
    $('#'+videoId).removeAttr('src');
    $('#'+videoId).removeAttr('style');
    $("#"+videoId).css("height", 0);
}

function hideCurrentOpenModal(modalId, imageId, videoId) {
    clearImage(imageId);
    clearVideo(videoId);
    UIkit.modal('#' + modalId).hide();
}

function updatePost(id)
{
    $.ajax({        
        type: 'get',
        url: _baseURL + "/edit-simple-post",
        data: { id: id },
        success: function (data) {
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
            $('#update_simple_post_image').attr('src', _baseURL+'/public/posts/images/'+data.image);
            $('#update_simple_post_video').attr('src', _baseURL+'/public/posts/images/'+data.video);
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

var url = document.location.toString();
if (url.match('#')) {
    if (url.split('#')[1] == 'collection') {
        $('#home-tab').removeClass('active');
        $('#home').removeClass('active');
        $('#collectionTab').addClass('active');
        $('#collection-tab').addClass('active');
    }
//$('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
       // $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').trigger('click');
       // $(".conf-fisrt").hide();
} 

$(document).on('click', '#followForFriendship', function(){
    var friendId = $(this).data('id');
    $('#addToFriendList').html('Processing <i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },    
        type: 'post',
        url: _baseURL + "/add-to-friend-list",
        data: { 
            friendId: friendId,
        },
        success: function (data) {   
           if (data.erro == '101') {            
                swal("", data.message, "success", {
                    button: "close",
                });

                let addedData = '<a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="'+friendId+'" data-status="pending" class="btn btn-primary btn-sm">Requested</a>';

                $('.userFriendshipBtnSection'+friendId+'').html(addedData);
                $('.suggestion-list-'+friendId+'').addClass('d-none');
           }
        }            
      });
});

$(document).on('click', '#cancelOrunFollowFriend', function(){
    var friendId = $(this).data('id');
    var friendShipStatus = $(this).data('status');
    $('#addToFriendList').html('Processing <i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },    
        type: 'post',
        url: _baseURL + "/cancel-or-follow-request",
        data: { 
            friendId: friendId,
            friendShipStatus: friendShipStatus,
        },
        success: function (data) {   
           if (data.erro == '101') {
                // $('#addToFriendList').html('Follow');
                swal("", data.message, "success", {
                    button: "close",
                });

                let addedData = '<a href="javascript:void(0);" id="followForFriendship" data-id="'+friendId+'" data-status="'+friendShipStatus+'" class="btn btn-primary btn-sm">Follow</a>';

                $('.userFriendshipBtnSection'+friendId+'').html(addedData);
                $('#followingUser').addClass('d-none');
           }
        }            
      });
});

$(document).on('click', '#blockFriend', function(){
    var friendId = $(this).data('id');
    $('#addToFriendList').html('Processing <i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },    
        type: 'post',
        url: _baseURL + "/block-friend",
        data: { 
            friendId: friendId,
        },
        success: function (data) {   
           if (data.erro == '101') {
                swal("", data.message, "success", {
                    button: "close",
                });

                let addedData = '<a href="javascript:void(0);" id="unBlockFriend" data-id="'+friendId+'" class="btn btn-secondary btn-sm">Blocked</a>';

                $('.userFriendshipBtnSection'+friendId+'').html(addedData);
           }
        }            
      });
});

$(document).on('click', '#unBlockFriend', function(){
    var friendId = $(this).data('id');
    $('#addToFriendList').html('Processing <i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },    
        type: 'post',
        url: _baseURL + "/un-block-friend",
        data: { 
            friendId: friendId,
        },
        success: function (data) {   
           if (data.erro == '101') {
                swal("", data.message, "success", {
                    button: "close",
                });

                let addedData = '<a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="'+friendId+'" data-status="confirmed" class="btn btn-primary btn-sm">Friend</a><a href="javascript:void(0);" id="blockFriend" data-id="'+friendId+'" data-status="blocked" class="btn btn-danger btn-sm ml-2">Block</a>';

                $('.userFriendshipBtnSection'+friendId+'').html(addedData);
           }
        }            
      });
});

$(document).on('click', '#followBack', function(){
    var friendshipId = $(this).data('id');
    var userId = $(this).data('user-id');
    var notificationId = $(this).data('notification-id');
    // alert(userId);
    $(this).html('Processing <i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },    
        type: 'post',
        url: _baseURL + "/follow-back",
        data: { 
            friendshipId: friendshipId,
            userId: userId,
            notificationId: notificationId,
        },
        success: function (data) {   
           if (data.erro == '101') {
                swal("", data.message, "success", {
                    button: "close",
                });

                $('.followBackBtnSec').html('');
                let addedData = '<a href="javascript:void(0);" id="cancelOrunFollowFriend" data-id="'+userId+'" data-status="confirmed" class="btn btn-primary btn-sm">Friend</a><a href="javascript:void(0);" id="blockFriend" data-id="'+userId+'" data-status="blocked" class="btn btn-danger btn-sm ml-2">Block</a>';

                $('.userFriendshipBtnSection'+userId+'').html(addedData);
           }           
        }            
      });
});

$(document).on('click', '#deleteSenderRequest', function(){
    var friendshipId = $(this).data('id');
    var notoficationId = $(this).data('notification-id');
    // alert(userId);
    $(this).html('Processing <i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },    
        type: 'post',
        url: _baseURL + "/delete-follow-request",
        data: { 
            friendshipId: friendshipId,
            notoficationId: notoficationId,
        },
        success: function (data) {   
           if (data.erro == '101') {
                swal("", data.message, "success", {
                    button: "close",
                });
                $('.followBackBtnSec').html('');
           }           
        }            
      });
});

$(document).on('click', '#followShop', function(){
    var shopId = $(this).data('id');
    $('#followShop').html('Processing <i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },    
        type: 'post',
        url: _baseURL + "/follow-shop",
        data: { 
            shopId: shopId,
        },
        success: function (data) {   
           if (data.erro == '101') {            
                swal("", data.message, "success", {
                    button: "close",
                });

                let addedData = '<a href="#" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold" id="unFollowShop" data-id="shopId"> Unfollow </a>';
                $('.followShopBtnSection'+shopId+'').html(addedData);
                $('.followShopList'+shopId+'').addClass('d-none');
                $('.followShop'+shopId+'').html('Joined');
           }
        }            
    });
});

$(document).on('click', '#unFollowShop', function(){
    var shopId = $(this).data('id');
    $('#unFollowShop').html('Processing <i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },    
        type: 'post',
        url: _baseURL + "/un-follow-shop",
        data: { 
            shopId: shopId,
        },
        success: function (data) {   
           if (data.erro == '101') {            
                swal("", data.message, "success", {
                    button: "close",
                });
                let addedData = '<a href="javascript:void(0);" class="bg-blue-600 flex flex-1 h-8 items-center justify-center rounded-md text-white capitalize followShop'+shopId+'" id="followShop" data-id="'+shopId+'">Join</a><a href="shop-profile/'+shopId+'" class="bg-gray-200 flex flex-1 h-8 items-center justify-center rounded-md capitalize">View</a>';
                $('.shopJoinUnjoinSection'+shopId+'').html(addedData);
           }
        }            
    });
});

var productIds = [];

$(function(){
  $('.addFeatureProduct').click(function(){
    if (($('.addFeatureProduct:checkbox:checked').length) > 0) {
        $('.addFeatureProductBtn').removeClass('d-none');
           } else {
        $('.addFeatureProductBtn').addClass('d-none');
    }
  });

  $('#addFeatureProductBtn').click(function(){
        var values = $('.addFeatureProduct:checkbox:checked').map(function () {
          return this.value;
        }).get();

        $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },    
            type: 'post',
            url: _baseURL + "/add-feature-product",
            data: { 
                productIds: values,
            },
            success: function (data) {   
               if (data.erro == '101') {            
                    swal("", data.message, "success", {
                        button: "close",
                    });
                    $('.swal-button--confirm').on('click', function(){
                        window.location.reload();
                    });                  
               }
            }            
        });
    });
});

$(document).on('click', '#removeFeatureProduct', function(){
    var productId = $(this).data('id');
    $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },    
        type: 'post',
        url: _baseURL + "/remove-feature-product",
        data: { 
            productId: productId,
        },
        success: function (data) {   
           if (data.erro == '101') {            
                swal("", data.message, "success", {
                    button: "close",
                });
                $('.swal-button--confirm').on('click', function(){
                    window.location.reload();
                });                    
           }
        }            
    });
});

$(document).on('click', '#addProductToWishlist', function(){
    var productId = $(this).data('id');
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: _baseURL + "/add-to-wishlist",
        data: { productId: productId },
        dataType: 'json',
        success: function (data) {
          console.log(data);
          if (data.erro == '101') {
              swal("", data.message, "success", {
                 button: "close",
              });
              $('.product-wishlist-btn-section'+productId+'').html(data.html);              
              // $('.swal-button--confirm').on('click', function(){
              //    window.location.reload();
              // });
           } else {
              swal("", data.message, "error", {
                 button: "close",
              });              
           }
        }
    });
  });

$(document).on('click', '#assignCollection', function(){
    var collectionId = $(this).data('id');
    var productId = $(this).data('product');
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: _baseURL + "/assign-collection-to-product",
        data: { 
            collectionId: collectionId,
            productId: productId,
        },
        dataType: 'json',
        success: function (data) {
          console.log(data);
          if (data.erro == '101') {
              swal("", data.message, "success", {
                 button: "close",
              });              
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
});

$(document).on('click', '#deleteSellerProductBtn', function(){
    $(this).html('Processing <i class="fa fa-spinner fa-spin"></i>');
    var id = $(this).data('id');
    $.ajax({
        headers: {
           'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'DELETE',
        enctype: 'multipart/form-data',        
        url: _baseURL + "/product/"+id,
        data: { id: id },        
        success: function(data) {
           if (data.erro == '101') {
              swal("", data.message, "success", {
                 button: "close",
              });

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
});

// $("#deleteSellerProduct").validate({
//   rules: {
     
//   },
//   messages: {
      
//   },
//   submitHandler: function(forms, e) {
//     // e.preventDefault();
//     var id = $('#id').val();
//     alert(id);
//     var form = $('#deleteSellerProduct')[0];
//     var serializedData = new FormData(form);
//     // serializedData.append('product_images', JSON.stringify(all_uploaded_files));
//     // console.log(serializedData);
    
//      $("#deleteSellerProductBtn").attr("disabled", true);
//      $('#deleteSellerProductBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
     
//      return false;
//   }
// });

$(document).on('click', '.profileTab', function(){
    var searchParams = new URLSearchParams(window.location.search)
    searchParams.set("tab", $(this).data('tab'));
    var newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
    history.pushState(null, '', newRelativePathQuery);
}) 

$(document).on('keyup', '#searchUser', function(){
  var user = $(this).val();
  var searchFor = $(this).data('status');      
     $.ajax({
          headers: {
             'X-CSRF-Token': $('input[name="_token"]').val()
          },    
          type: 'get',
          url: _baseURL + "/search-user",
          data: { 
              user: user,
              searchFor: searchFor,
          },
          success: function (data) {
              var userData = '';
              if (user.length > 0) {
                 $('.filteredUserData').html(data);
              }            
          }            
      });     
});

$("#addProductCollectionForm").validate({      
  rules: {
     name: {
        required: true
     },
     product_collection_image: {
        required: true
     }
  },
  messages: {
     name: "Please enter category name",
     product_collection_image: "Please choose category image"
  },
  submitHandler: function(forms, e) {
     e.preventDefault();
     var form = $('#addProductCollectionForm')[0];
     var serializedData = new FormData(form);

     $("#addProductCollectionBtn").attr("disabled", true);
     $('#addProductCollectionBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
     $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        enctype: 'multipart/form-data',
        url: _baseURL + "/collection",
        data: serializedData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
           $("#addProductCollectionBtn").attr("disabled", false);

           $('#addProductCollectionBtn').html('Post');

           if (data.erro == '101') {
              clearImage('output_simple_post_image');
             
              UIkit.modal('#addProductCollection').hide();

              swal("", data.message, "success", {
                 button: "close",
              });

              $("#addProductCollectionForm").trigger('reset');
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