$(document).on('change', '#userCheckoutForm', function(){
	var type = $(this).data('type');
	var id = $(this).val();
  // if (id == 'user_'+type+'_address') {
  //   $('.add'+type+'AddressForm').removeClass('d-none');
  // } else {
    // $('.add'+type+'AddressForm').addClass('d-none');
  	$.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: _baseURL + "/user-address-form",
        data: { 
            type: type,
            id: id,
        },
        dataType: 'json',
        success: function (data) {
          if (data.type == 'billing') {
          	$('#billingAddressForm').html(data.data);
          } else {
          	$('#shippingAddressForm').html(data.data);
          }          
        }
    });    
  // }
})

$("#checkoutForm").validate({    
    rules: {
        billing_first_name: {
           required: true,
        },
        shipping_first_name: {
           required: true,
        },
        billing_last_name: {
           required: true,
        },
        shipping_last_name: {
           required: true,
        },
        billing_phone_no: {
           required: true,
        },
        shipping_phone_no: {
           required: true,
        },
        billing_zip_code: {
           required: true,
        },
        shipping_zip_code: {
           required: true,
        },
        billing_country: {
           required: true,
        },
        shipping_country: {
           required: true,
        },
        billing_city: {
           required: true,
        },
        shipping_city: {
           required: true,
        },
        billing_address: {
           required: true,
        },
        shipping_address: {
           required: true,
        },
        save_billing_address: {
           required: true,
        },
        save_shipping_address: {
           required: true,
        }
     },
     messages: {
        billing_first_name: "Please enter your first name",
        shipping_first_name: "Please enter your Last name",
        billing_last_name: "Please enter your first name",
        shipping_last_name: "Please enter your last name",
        billing_phone_no: "Please enter your phone no",
        shipping_phone_no: "Please enter your phone no",
        billing_zip_code: "Please enter your zip code",
        shipping_zip_code: "Please enter your zip code",
        billing_country: "Please choose your country",
        shipping_country: "Please choose your country",
        billing_city: "Please choose your city",
        shipping_city: "Please choose your city",
        billing_address: "Please enter your address",
        shipping_address: "Please enter your address",
        save_billing_address: "Please mark check the save billing address",
        save_shipping_address: "Please mark check the save shipping address",
     },
    submitHandler: function(form) {
      var paymentRoute = $('#paymentRoute').val();
      // alert(paymentRoute);
      var serializedData = $(form).serialize();
      $("#err_mess").html('');
      $('#checkoutFormBtn').attr('disabled');
      $('#checkoutFormBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');      
      $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        url: _baseURL + "/" + paymentRoute,
        data: serializedData,
        dataType: 'json',
        success: function(data) {
           $('#checkoutFormBtn').html('Save Changes');

           if (data.erro == '201') {
              window.location.href = _baseURL+'/handle-payment';
           }
           if (data.erro == '101') {
              swal("", data.message, "success", {
                 button: "close",
              });
              $('.swal-button--confirm').on('click', function(){
                window.location.href = _baseURL+'/buyer-order';
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

$(document).on('change', '#paypal', function(){
  if ($(this).is(':checked')) {
    $('#checkoutFormBtn').html('Make Payment');
    $('#paymentRoute').val('/payment');
  }  
});

$(document).on('change', '#cod', function(){
  if ($(this).is(':checked')) {
    $('#checkoutFormBtn').html('Place Order');
    $('#paymentRoute').val('/place-order');
  } 
});