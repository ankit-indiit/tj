@extends('layouts.app')
@section('content')

    <div class="no-login-image"><img src="{{ asset('images/banner-no-login.jpg') }}"></div>
        <div class="main_content no-right-margin no-login pt-0">
            <div class="mcontainer">
                
                <div  class="row">
			        <div class="col-sm-6">
			            <h2 class="text-xl mb-3 font-semibold">Explore the latest trends in the shopping world</h2>
			            <div class="flex cover-div">
			                <div class="left-image">
			                    <img src="{{ asset('images/land.jpg') }}">
			                </div>
			                <div class="righ-info">Browse thousands of products from shops all around the world</div>
			            </div>
			            <a href="{{ url('login') }}" class="is_link become-sel"> Go to Shop</a>
			        </div>
		
			        <div class="col-sm-6"><h2 class="text-xl mb-3 font-semibold"> 	Connect, influence and inspire</h2>
			            <div class="flex cover-div">
			                <div class="left-image">
			                    <img src="{{ asset('images/land.jpg') }}">
		                    </div>
			                <div class="righ-info">Connect to with ybur friends and followers and stay up to date with the latest trend, frienids updates and new items</div>
		                </div>
                        <a href="{{ url('register') }}" class="is_link become-sel"> Sign Up</a>
			        </div>
                </div>
            </div>
        </div>
    </div>

@endsection