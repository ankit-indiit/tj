$("#addShopImageForm").validate({
   rules: {     
     shopImageUpload: {
        required: true
     }
   },
   messages: {
     shopImageUpload: "Please choose category image"
   },
   submitHandler: function(forms, e) {
     e.preventDefault();
     var form = $('#addShopImageForm')[0];
     var serializedData = new FormData(form);
    
     $("#addShopImageBtn").attr("disabled", true);
     $('#addShopImageBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
     $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        enctype: 'multipart/form-data',
        url: _baseURL + "/add-shop-image",
        data: serializedData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
           $("#addShopImageBtn").attr("disabled", false);
   
           $('#addShopImageBtn').html('Post');
   
           if (data.erro == '101') {
              clearImage('shopImageUpload');
             
              UIkit.modal('#add-shop-image-modal').hide();
   
              swal("", data.message, "success", {
                 button: "close",
              });
   
              $("#addShopImageForm").trigger('reset');
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

$("#addShopCategoryForm").validate({
   rules: {
      name: {
         required: true
      },      
   },
   messages: {
      name: "Please enter shop category",         
   },
   submitHandler: function(form) {
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#addShopCategoryBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: _baseURL + "/add-shop-category",
         data: serializedData,
         dataType: 'json',
         success: function(data) {
            $('#addShopCategoryBtn').html('Save Changes');

            if (data.erro == '101') {
               swal("", data.message, "success", {
                  button: "close",
               });
               $("#addShopCategoryForm").trigger('reset');
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });
            }
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
         }
      });
      return false;
   }
});

$(document).on('click', '#editShopCategory', function(){
   var shopCatId = $(this).data('id');
   $.ajax({        
      type: 'get',
      url: _baseURL + "/edit-shop-category",
      data: { shopCatId: shopCatId },
      success: function (data) {
         $('.shop-category-id').val(data.id);
         $('.shop-category').val(data.name);
         UIkit.modal('#edit-shop-category-modal').show();
      }            
   });
});

$("#updateShopCategoryForm").validate({
   rules: {
      name: {
         required: true
      },     
   },
   messages: {
      name: "Please enter shop category",         
   },
   submitHandler: function(form) {
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#updateShopCategoryBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: _baseURL + "/update-shop-category ",
         data: serializedData,
         dataType: 'json',
         success: function(data) {
            $('#updateShopCategoryBtn').html('Save Changes');

            if (data.erro == '101') {
               swal("", data.message, "success", {
                  button: "close",
               });
               $("#updateShopCategoryForm").trigger('reset');
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });
            }
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
         }
      });
      return false;
   }
});

$("#addSellerSocialLink").validate({
   rules: {
      social_icon: {
         required: true
      },
      social_link: {
         required: true
      }        
   },
   messages: {
      social_icon: "Please choose social icon",         
      social_link: "Please enter a valid link"
   },
   submitHandler: function(form) {
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#addSocialLinkBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: _baseURL + "/add-seller-social-link",
         data: serializedData,
         dataType: 'json',
         success: function(data) {
            $('#addSocialLinkBtn').html('Save Changes');

            if (data.erro == '101') {
               swal("", data.message, "success", {
                  button: "close",
               });
               $("#updateProfileForm").trigger('reset');
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });
            }
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
         }
      });
      return false;
   }
});

$(document).on('click', '.editSocialLink', function(){
   var linkId = $(this).data('id');
   $.ajax({        
      type: 'get',
      url: _baseURL + "/edit-social-link",
      data: { linkId: linkId },
      success: function (data) {
         $('.link-id').val(data.id);
         $('.social-icon').val(data.social_icon);
         $('.social-link').val(data.social_link);
         UIkit.modal('#edit-social-link-modal').show();
      }            
   });
});

$("#updateSellerSocialLink").validate({
   rules: {
      social_icon: {
         required: true
      },
      social_link: {
         required: true
      }        
   },
   messages: {
      social_icon: "Please choose social icon",         
      social_link: "Please enter a valid link"
   },
   submitHandler: function(form) {
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#updateSocialLinkBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: _baseURL + "/update-seller-social-link",
         data: serializedData,
         dataType: 'json',
         success: function(data) {
            $('#updateSocialLinkBtn').html('Save Changes');

            if (data.erro == '101') {
               swal("", data.message, "success", {
                  button: "close",
               });
               $("#updateProfileForm").trigger('reset');
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });
            }
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
         }
      });
      return false;
   }
});

$("#addSellerWorkingHours").validate({
   rules: {
      day: {
         required: true
      },
      open_time: {
         required: true
      },
      close_time: {
         required: true
      }        
   },
   messages: {
      day: "Please choose working day",         
      open_time: "Please enter open time",
      close_time: "Please enter close time"
   },
   submitHandler: function(form) {
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#sellerWorkingHoursBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: _baseURL + "/add-seller-working-hour",
         data: serializedData,
         dataType: 'json',
         success: function(data) {
            $('#sellerWorkingHoursBtn').html('Save Changes');

            if (data.erro == '101') {
               swal("", data.message, "success", {
                  button: "close",
               });
               $("#addSellerWorkingHours").trigger('reset');
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });
            }
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
         }
      });
      return false;
   }
});

$(document).on('click', '.editWorkingHour', function(){
   var workingHourId = $(this).data('id');
   $.ajax({        
      type: 'get',
      url: _baseURL + "/edit-working-hour",
      data: { workingHourId: workingHourId },
      success: function (data) {
         $('.working-id').val(data.id);
         $('.working-day').val(data.day);
         $('.open-time').val(data.open_time);
         $('.close-time').val(data.close_time);
         UIkit.modal('#edit-working-hour-modal').show();
      }            
   });
});

$("#updateSellerWorkingHour").validate({
   rules: {
      day: {
         required: true
      },
      open_time: {
         required: true
      },
      close_time: {
         required: true
      }        
   },
   messages: {
      day: "Please choose working day",         
      open_time: "Please enter open time",
      close_time: "Please enter close time"
   },
   submitHandler: function(form) {
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#updateWorkingHourBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: _baseURL + "/update-seller-working-hour",
         data: serializedData,
         dataType: 'json',
         success: function(data) {
            $('#updateWorkingHourBtn').html('Save Changes');

            if (data.erro == '101') {
               swal("", data.message, "success", {
                  button: "close",
               });
               $("#updateSellerWorkingHour").trigger('reset');
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });
            }
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
         }
      });
      return false;
   }
});

$("#addSellerEstimatedDelivery").validate({
   rules: {
      day: {
         estimated_delivery: true
      }       
   },
   messages: {
      estimated_delivery: "Enter Estimated Delivery"        
   },
   submitHandler: function(form) {
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#addSellerEstimatedDeliveryBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: _baseURL + "/add-seller-estimated-delivery",
         data: serializedData,
         dataType: 'json',
         success: function(data) {
            $('#addSellerEstimatedDeliveryBtn').html('Save Changes');

            if (data.erro == '101') {
               swal("", data.message, "success", {
                  button: "close",
               });
               $("#addSellerEstimatedDelivery").trigger('reset');
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });
            }
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
         }
      });
      return false;
   }
});

$(document).on('click', '.editEstimateDelevery', function(){
   var estimateDeleveryId = $(this).data('id');
   $.ajax({        
      type: 'get',
      url: _baseURL + "/edit-estimate-delevery",
      data: { estimateDeleveryId: estimateDeleveryId },
      success: function (data) {
         console.log(data);
         $('.estimate-day-to').val(data.from);            
         $('.estimated-day').val(data.till);            
         UIkit.modal('#edit-estimated-delivery').show();
      }            
   });
});

$("#editSellerEstimatedDelivery").validate({
   rules: {
      estimated_delivery: {
         required: true
      }      
   },
   messages: {
      day: "Enter Estimated Delivery"         
   },
   submitHandler: function(form) {
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#addSellerEstimatedDeliveryBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: _baseURL + "/update-seller-estimated-delivery",
         data: serializedData,
         dataType: 'json',
         success: function(data) {
            $('#addSellerEstimatedDeliveryBtn').html('Save Changes');

            if (data.erro == '101') {
               swal("", data.message, "success", {
                  button: "close",
               });
               $("#addSellerEstimatedDelivery").trigger('reset');
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });
            }
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
         }
      });
      return false;
   }
});

$("#addDiscountCoupon").validate({
   rules: {
      title: {
         required: true
      },
      description: {
         required: true
      },
      type: {
         required: true
      },
      expired_on: {
         required: true
      },
      discounted_value: {
         required: true
      }        
   },
   messages: {
      title: "Please enter title",         
      description: "Please enter description",
      type: "Please enter type",
      expired_on: "Please enter expired on",
      discounted_value: "Please enter discounted value"
   },
   submitHandler: function(form) {
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#addDiscountCouponBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: _baseURL + "/add-discount-coupon",
         data: serializedData,
         dataType: 'json',
         success: function(data) {
            $('#addDiscountCouponBtn').html('Save Changes');

            if (data.erro == '101') {
               swal("", data.message, "success", {
                  button: "close",
               });
               $("#addDiscountCoupon").trigger('reset');
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });
            }
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
         }
      });
      return false;
   }
});

$(document).on('click', '.editDiscountCoupon', function(){
   var editedCouponId = $(this).data('id');
   $.ajax({        
      type: 'get',
      url: _baseURL + "/edit-discount-coupon",
      data: { editedCouponId: editedCouponId },
      success: function (data) {
         $('.coupon-id').val(data.id);            
         $('.coupon-title').val(data.title);            
         $('.coupon-name').val(data.coupon_name);            
         $('.coupon-description').val(data.description);            
         $('.coupon-type').val(data.type);            
         $('.coupon-expired-on').val(data.expired_on);            
         $('.coupon-discounted-value').val(data.discounted_value);            
         UIkit.modal('#edit-discount-coupon-modal').show();
      }            
   });
});

$("#updateDiscountCoupon").validate({
   rules: {
      title: {
         required: true
      },
      description: {
         required: true
      },
      type: {
         required: true
      },
      expired_on: {
         required: true
      },
      discounted_value: {
         required: true
      }        
   },
   messages: {
      title: "Please enter title",         
      description: "Please enter description",
      type: "Please enter type",
      expired_on: "Please enter expired on",
      discounted_value: "Please enter discounted value"
   },
   submitHandler: function(form) {
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#updateDiscountCouponBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
      $.ajax({
         headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
         },
         type: 'post',
         url: _baseURL + "/update-discount-coupon",
         data: serializedData,
         dataType: 'json',
         success: function(data) {
            $('#updateDiscountCouponBtn').html('Save Changes');

            if (data.erro == '101') {
               swal("", data.message, "success", {
                  button: "close",
               });
               $("#updateDiscountCoupon").trigger('reset');
            } else {
               swal("", data.message, "error", {
                  button: "close",
               });
            }
            $('.swal-button--confirm').on('click', function(){
               window.location.reload();
            });
         }
      });
      return false;
   }
});