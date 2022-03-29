@extends('layouts.appwithoutheader')

@section('content')
<div class="container-fluid px-4 py-5 mx-auto login-page">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-10">
                        <h6 class="msg-info">Please login to your account</h6>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                            {{ Session::get('message') }}
                                @php
                                    Session::forget('message');
                                @endphp
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group"> 
                                <label class="form-control-label text-muted">Username</label> 
                                <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Phone no or email id" class="form-control @error('email') is-invalid @enderror" required autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group"> 
                                <label class="form-control-label text-muted">Password</label> 
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row justify-content-center my-3 px-3"> 
                                <button type="submit" class="btn-block btn-color">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="row justify-content-center my-2"> 
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                       <small class="text-muted"> {{ __('Forgot Password?') }}</small>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bottom text-center mb-5">
                    <p href="#" class="sm-text mx-auto mb-3">Don't have an account? <a href="{{ url('register') }}" class="sign-in-txt">Signup</a></p>
                </div>
            </div>
            <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5 right"><img class="bg-logo" src="{{ asset('images/light.png') }}">
				 <div class="row justify-content-center px-3 mb-3"> <img id="logo" src="{{ asset('images/log.png') }}"> </div>
                    <h3 class="text-white">Welcome Back</h3> <small class="text-white">Sign in to continue access pages</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
