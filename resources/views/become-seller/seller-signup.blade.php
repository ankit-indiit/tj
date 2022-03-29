<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Signup</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="assets/scss/icons.html">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.1/esm/ionicons.min.js">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
      <link rel="preconnect" href="https://fonts.gstatic.com/">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
      <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
         />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
   </head>
   <body>
      <div class="container-fluid px-4 py-5 mx-auto login-page signup-page">
         <div class="card0">
            <div class="d-flex flex-lg-row flex-column-reverse">
               <div class="card card1">
                  <div class="row justify-content-center my-auto">
                     <div class="col-md-12 col-12">
                        <div class="row justify-content-center px-3 mb-3"> <img id="logo" src="{{ asset('images/log.png') }}"> </div>
                        <h6 class="msg-info">Please Enter Business Details</h6>
                        {{ Form::open(['url' => route('seller.signup'), 'id' => 'becomeSellerForm']) }}
                           <div class="form-group">
                              {{ Form::label('shop_name', 'Shop Name', ['class' => 'form-control-label text-muted']) }}
                              {{ Form::text('shop_name', '', ['class' => 'form-control', 'id' => 'shop_name', 'placeholder' => '']) }}
                           </div>
                           <div class="form-group">
                              {{ Form::label('store_number', 'Store Number', ['class' => 'form-control-label text-muted']) }}
                              {{ Form::tel('store_number', '', ['class' => '', 'id' => 'store_number', 'placeholder' => '(201) 555-0123', 'style' => 'padding-left: 52px  !important;']) }}
                           </div>
                           <div class="form-group">
                              {{ Form::label('location', 'Location/Address', ['class' => 'form-control-label text-muted']) }}
                              {{ Form::text('location', '', ['class' => 'form-control', 'id' => 'location', 'placeholder' => '']) }}
                           </div>
                           <div class="form-group">
                              {{ Form::label('country', 'Country', ['class' => 'form-control-label text-muted']) }}
                              {{ Form::text('country', '', ['class' => 'form-control', 'id' => 'country', 'placeholder' => '']) }}
                           </div>
                           <div class="form-group">
                              {{ Form::label('state', 'State', ['class' => 'form-control-label text-muted']) }}
                              {{ Form::text('state', '', ['class' => 'form-control', 'id' => 'state', 'placeholder' => '']) }}
                           <div class="form-group">
                              {{ Form::label('city', 'City', ['class' => 'form-control-label text-muted']) }}
                              {{ Form::text('city', '', ['class' => 'form-control', 'id' => 'city', 'placeholder' => '']) }}
                           </div>
                           <div class="form-group">
                              {{ Form::label('postal_code', 'Postal', ['class' => 'form-control-label text-muted']) }}
                              {{ Form::text('postal_code', '', ['class' => 'form-control', 'id' => 'postal_code', 'placeholder' => '']) }}
                           </div>
                           <p href="#" class="sm-text mx-auto text-center mb-3" style="
                              margin-top: 31px; position: relative;
                              ">
                              <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="
                                 display: inline-block;
                                 height: auto;
                                 position: absolute;
                                 left: -4px;
                                 right: 4px;
                                 top: 7px;
                                 width: auto;
                                 ">
                              <label for="vehicle1">By creating an account, you agree to 
                                 <a href="#" class="sign-in-txt">Terms & Conditions </a> and 
                                 <a href="Privacy-policy.html" class="sign-in-txt">Privacy Policy .</a>
                              </label>
                           </p>
                           <div class="row justify-content-center my-3 px-3">
                              {{ Form::submit('Continue as Seller', ['class' => 'btn-block col-sm-7 btn-color']) }}
                           </div>
                        {{ Form::close() }}
                     </div>
                  </div>
                  <div class="bottom text-center mb-5">
                     <p href="#" class="sm-text mx-auto mb-3">Go Back to <a href="feed.html" class="sign-in-txt">Website</a></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         const phoneInputField = document.querySelector("#phone");
         const phoneInput = window.intlTelInput(phoneInputField, {
           utilsScript:
             "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
         });
      </script>
      <!-- Javascript
         ================================================== -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
      <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="{{ asset('js/uikit.js') }}"></script>
      <script src="{{ asset('js/simplebar.js') }}"></script>
      <script src="{{ asset('js/custom.js') }}"></script>
      <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
      <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
      <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
      <script src="{{ asset('js/jquery.validate.min.js') }}" ></script>
<script>
    $().ready(function() {
		
		// validate signup form on keyup and submit
		$("#becomeSellerForm").validate({
			rules: {
				shop_name: {
					required: true,
				},
				store_number: {
					required: true
				},
				location: {
					required: true,
				},
				country: {
					required: true,
				},
				state: {
					required: true,
				},
				city: {
					required: true,
				},
            postal_code: {
					required: true,
               number: true
				},
            vehicle1: {
					required: true,
				},
			},
			messages: {
				shop_name: {
					required: "Please enter your shop name",
				},
            store_number: {
					required: "Please enter store number",
				},            
            location: {
					required: "Please provide your location number",
				},
            country: {
					required: "Please enter a valid country addres",
				},
				state: {
					required: "Please enter your state",
				},
				city: {
					required: "Please enter your city",
				},
            postal_code: {
					required: "Please enter your postal code",
               number: "only numeric values are allowed"
				},
            vehicle1: {
					required: "Please accept trems & conditions",
				},
			}
		});
		
	}); 
   </script>
      <style>
         .login-page .card1 {
         height: 100%;
         }
      </style>
   </body>
</html>