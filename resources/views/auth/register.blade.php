@extends('layouts.appwithoutheader')
@section('content')
<style>
.login-page .card1 {
    height: 100%;
}
</style>
<div class="container-fluid px-4 py-5 mx-auto login-page signup-page">
    <div class="card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-12 col-12">
                        <div class="row justify-content-center px-3 mb-3"> 
                            <img id="logo" src="{{ asset('images/log.png') }}"> 
                        </div>
                        
                        <form method="POST" action="{{ route('register') }}" id="signupForm">
                            @csrf
                            <h6 class="msg-info">Please Signup to your account</h6>
                            <div class="form-group"> 
                                <label class="form-control-label text-muted">Full Name</label> 
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
    						
    						<div class="form-group"> 
    						    <label class="form-control-label text-muted">Select your Timezone</label> 
    					        <select class="form-control" id="timezone" name="timezone">
                                    @foreach($timezones as $timezone)
                                    <option value="{{ $timezone->id }}" {{ old("timezone") == $timezone->id ? "selected":"" }} >{{ $timezone->name }} ({{ $timezone->offset }})</option>
                                    @endforeach
                                </select> 
                            </div>
    					    <div class="form-group"> 
    						    <label class="form-control-label text-muted">Phone Number</label> 
                                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" style="padding-left: 52px  !important;">
                                
                                <input type="hidden" id="country_code" name="country_code"/>
    					    </div>
    					    <div class="form-group"> 
    					        <label class="form-control-label text-muted">Email</label> 
    					        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    					    </div>
    					    <div class="form-group main-pwd"> 
    					        <label class="form-control-label text-muted">Password</label> 
    					        <input id="password" type="password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    						    <span class="eye-col"><i class="fa fa-eye" aria-hidden="true" id="togglePassword"></i></span>
                                <div class="main-data">
                                    <p>Password must include:</p>
                                    <ul>
                                        <li><i class="fa fa-check-square-o" aria-hidden="true"></i>Min. 8 Characters</li>
                                        <li><i class="fa fa-check-square-o" aria-hidden="true"></i>At least one capital letter</li>
                                        <li><i class="fa fa-check-square-o" aria-hidden="true"></i>At least one small letter</li>
                                        <li><i class="fa fa-check-square-o" aria-hidden="true"></i>At least special Character</li>
                                    </ul>
                                </div>
    					    </div>
    						
                            <div class="form-group " style="position: relative;"> 
                                <label class="form-control-label text-muted">Confirm Password</label> 
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span class="eye-col" ><i class="fa fa-eye" aria-hidden="true"  id="toggleConfirmPassword" ></i></span> 
                            </div>
    						<p href="#" class="sm-text mx-auto text-center mb-3" style="margin-top: 31px; position: relative;">
                            <input type="checkbox" id="agree" name="agree" value="1" style="display: inline-block;height: auto;position: absolute;left: -4px;top: 7px;width: auto;">
                            <label for="vehicle1" class="privacyPolicy">By creating an account, you agree to <a href="{{ url('terms-conditions') }}" class="sign-in-txt">Terms & Conditions </a> and <a href="{{ url('privacy-policy') }}" class="sign-in-txt">Privacy Policy.</a></label>
                            </p>
                            <div class="row justify-content-center my-3 px-3 registerBtnSec"> 
                                <button type="submit" class="btn-block col-sm-7 btn-color">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            
                            </form>
                        
                    </div>
                </div>
                <div class="bottom text-center mb-5">
                    <p  class="sm-text mx-auto mb-3">Already have an account?  <a href="{{ url('login') }}" class="sign-in-txt">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}" ></script>
<script>
    $().ready(function() {
		
		// validate signup form on keyup and submit
		$("#signupForm").validate({
			rules: {
				name: {
					required: true,
					minlength: 2
				},
				timezone: {
					required: true
				},
				phone: {
					required: "#newsletter:checked",
					number: true
				},
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
					strong_password: true,
				},
				password_confirmation: {
					required: true,
					strong_password: true,
					equalTo: "#password"
				},
				agree: "required"
			},
			messages: {
				name: "Please enter your name",
				timezone: "Please select timezone",
				phone: {
					required: "Please provide your phone number",
					number: "only numeric values are allowed"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 8 characters long"
				},
				password_confirmation: {
					required: "Please provide a password",
					minlength: "Your password must be at least 8 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: "Please enter a valid email address",
				agree: "Please accept our policy"
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

    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    
    var country = $('#country_code');
    var input = $('#phone');
    var iti = intlTelInput(input.get(0))
    
    // listen to the telephone input for changes
    input.on('countrychange', function(e) {
      // change the hidden input value to the selected country code
      country.val(iti.getSelectedCountryData().iso2);
    });
    
    
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const confirmPassword = document.querySelector('#password_confirmation');
     
    toggleConfirmPassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
    
    
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
     
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>


@endsection
