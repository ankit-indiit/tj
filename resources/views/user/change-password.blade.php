@extends('layouts.app')

@section('content')
<!-- Main Contents -->
<div class="main_content">
   <div class="mcontainer">
      <div class="profile user-profile bg-white rounded-2xl -mt-4">
         <div class="profiles_banner">
            <img src="{{ url('public/profile/cover/') }}/{{ Auth::user()->cover_image }}" alt="" />
            <div class="profile_action absolute bottom-0 right-0 space-x-1.5 p-3 text-sm z-50 hidden lg:flex"></div>
         </div>
         <div class="profiles_content">
            <div class="profile_avatar">
               <div class="profile_avatar_holder">
                  <img src="{{ show_user_image() }}" alt="" />
               </div>
               <div class="user_status status_online"></div>
               <div class="icon_change_photo" hidden=""><ion-icon name="camera" class="text-xl md hydrated" role="img" aria-label="camera"></ion-icon></div>
            </div>

            <div class="profile_info">
               <h1>{{ Auth::user()->name }}</h1>
            </div>
         </div>
      </div>

      <div class="tab-pane" id="pwd" role="tabpanel" aria-labelledby="pwd-tab">
         <div class="row mt-4">
            <div class="col-lg-8 col-sm-12">
               <h4 class="text-xl mb-3 font-semibold">Change Password</h4>
                <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
			    <span id="succes_mess" style="color: green;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
                <form method="POST" action="{{ url('update-password') }}" id="changePasswordForm">
                @csrf
               <div class="row">
                  <div class="col-sm-12">
                     <div class="profile-inp">
                        <input type="password" name="current_password" class="form-control" id="current_password" aria-describedby="emailHelp" placeholder="Old Password" />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="profile-inp">
                        <input id="new_password" type="password"  class="form-control @error('new_password') is-invalid @enderror" name="new_password" required placeholder="New Password">
                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="profile-inp">
                        <input id="confirm_password" type="password" class="form-control" name="confirm_password" required  placeholder="Confirm New Password" >
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                        <button type="submit" id="upd_password_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                            {{ __('Save Changes') }}
                        </button>
                     
                        <a href="{{ url('my-profile') }}?tab=feed" class="flex text-center items-center justify-center gray-bg w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                            Cancel
                        </a>
                  </div>
               </div>
               </form>
               
               
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@section('customModals')

@endsection

@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}" ></script>
<script>
    $().ready(function() {
		
		// validate signup form on keyup and submit
		$("#changePasswordForm").validate({
			rules: {
				current_password: {
					required: true
				},
				new_password: {
					required: true,
					strong_password: true,
				},
				confirm_password: {
					required: true,
					strong_password: true,
					equalTo: "#new_password"
				},
				agree: "required"
			},
			messages: {
				current_password: {
					required: "Please enter your old password"
				},
				new_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 8 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 8 characters long",
					equalTo: "Please enter the same password as above"
				}
			
			},
			
	        submitHandler: function(form) {
	            
	            var serializedData = $(form).serialize();
	            $("#err_mess").html('');
	            $('#upd_password_btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
	            $.ajax({
	                headers: {
	                  'X-CSRF-Token': $('input[name="_token"]').val()
	                },
	                type: 'post',
	                url: "{{ url('update-password') }}",
	                data: serializedData,
	                dataType:'json',
	                success: function(data) {
	                    $('#upd_password_btn').html('Save Changes');
	                    
	                    if(data.erro == '101')
	                    {
	                        $("#succes_mess").html(data.message);
	                        $('#logout-form').submit();
	                    }
	                    else
	                    {
	                        $("#err_mess").html(data.message);
	                    }
	                    
	                    setTimeout(function () {
	                        $('#succes_mess').html("");
	                        $('#err_mess').html("");
	                    }, 5000);
	                    
	                }
	            });
	            return false;
	          
	        }
		});
		
	}); 
	
	$.validator.addMethod("strong_password", function (value, element) {
        let password = value;
        if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{8,20}$)/.test(password))) {
            return false;
        }
        return true;
    }, function (value, element) {
        let password = $(element).val();
        if (!(/^(.{8,20}$)/.test(password))) {
            return 'Password must be between 8 to 20 characters long.';
        }
        else if (!(/^(?=.*[A-Z])/.test(password))) {
            return 'Password must contain at least one uppercase.';
        }
        else if (!(/^(?=.*[a-z])/.test(password))) {
            return 'Password must contain at least one lowercase.';
        }
        else if (!(/^(?=.*[0-9])/.test(password))) {
            return 'Password must contain at least one digit.';
        }
        else if (!(/^(?=.*[@#$%&])/.test(password))) {
            return "Password must contain special characters from @#$%&.";
        }
        return false;
    });

   
    
</script>
@endsection