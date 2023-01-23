$(document).on('click', '#addToCart', function(){
	var productId = $(this).data('product');
	var productQty = $('#productQuantity'+productId+'').val();
	 $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: _baseURL + "/add-to-cart",
        data: { 
            productId: productId,
            productQty: productQty,
        },
        dataType: 'json',
        success: function (data) {
          console.log(data);
          if (data.erro == '101') {
              $('.addToCartDiv'+productId+'').html(data.html);            
              $('.cart-product-list'+productId+'').addClass('d-none');            
              swal("", data.message, "success", {
                button: "close",
              });              
            } else {
              swal("", data.message, "error", {
                button: "close",
              });              
          }
        }
    });
});

$(document).ready(function () {

    $('.increseCartQty').click(function (e) {
        $('#updateCartBtn').removeClass('d-none');
        e.preventDefault();
        var incre_value = $(this).parents('.quantity').find('.cartQty').val();
        var act_qty = $(this).parents('.quantity').find('.proQty').val();
        var value = parseInt(incre_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value<act_qty){
            value++;
            price = value*$(this).data('price');
            $('.productPrice'+$(this).data('id')).html('$'+price);
            $(this).parents('.quantity').find('.cartQty').val(value);
        }

    });

    $('.dicreseCartQty').click(function (e) {
      $('#updateCartBtn').removeClass('d-none');
        e.preventDefault();
        var decre_value = $(this).parents('.quantity').find('.cartQty').val();
        var value = parseInt(decre_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value>1){
            value--;
            price = value*$(this).data('price');
            $('.productPrice'+$(this).data('id')).html('$'+price);
            $(this).parents('.quantity').find('.cartQty').val(value);
        }
    });

    $('.increseProductQty').click(function (e) {
        e.preventDefault();
        var incre_value = $(this).parents('.quantity').find('.productQty').val();
        var act_qty = $(this).parents('.quantity').find('.proQty').val();
        var value = parseInt(incre_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value<act_qty){
            value++;
            $(this).parents('.quantity').find('.productQty').val(value);
        }

    });

    $('.dicreseProductQty').click(function (e) {
        e.preventDefault();
        var decre_value = $(this).parents('.quantity').find('.productQty').val();
        var value = parseInt(decre_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value>1){
            value--;
            $(this).parents('.quantity').find('.productQty').val(value);
        }
    });

});

$("#updateCartForm").validate({
  rules: {
          
  },
  messages: {
            
  },
  submitHandler: function(form) {
    var serializedData = $(form).serialize();
    $("#err_mess").html('');
    $('#updateCartBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
      headers: {
         'X-CSRF-Token': $('input[name="_token"]').val()
      },
      type: 'post',
      url: _baseURL + "/update-cart",
      data: serializedData,
      dataType: 'json',
      success: function(data) {
        $('#updateCartBtn').html('Save Changes');
        if (data.erro == '101') {
          swal("", data.message, "success", {
            button: "close",
          });
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

$(document).on('click', '#moveToWishlist', function(){
  var id = $(this).data('id');
  var productId = $(this).data('product');
  $.ajax({
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'post',
      url: _baseURL + "/move-to-wihlist",
      data: { 
        id: id,
        productId: productId,
      },
      dataType: 'json',
      success: function (data) {
        if (data.erro == '101') {
          $('.cart-product-list'+id+'').addClass('d-none');            
          swal("", data.message, "success", {
            button: "close",
          });              
        } else {
          swal("", data.message, "error", {
              button: "close",
          });              
        }
      }
  });
});

$(document).on('click', '#removeToCart', function(){
  var id = $(this).data('id');
  $.ajax({
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'post',
      url: _baseURL + "/remove-to-cart",
      data: { 
        id: id,
      },
      dataType: 'json',
      success: function (data) {
        if (data.erro == '101') {
            $('.cart-product-list'+id+'').addClass('d-none');            
            swal("", data.message, "success", {
              button: "close",
            });              
          } else {
            swal("", data.message, "error", {
              button: "close",
            });              
        }
      }
  });
});

$(document).on('click', '#applyCoupon', function(){
  var couponName = $('#couponName').val();
  var productIds = $('#product_ids').val();
  $.ajax({
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'post',
      url: _baseURL + "/apply-coupon",
      data: { 
        couponName: couponName,
        productIds: productIds,
      },
      dataType: 'json',
      success: function (data) {
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