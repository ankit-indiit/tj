@extends('layouts.appwithoutheader')

@section('content')

<div class="container-fluid px-4 py-5 mx-auto login-page">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-10">
                            <div class="row justify-content-center px-3 mb-3">
                                <img id="logo" src="{{ asset('images/log.png') }}">
                            </div>

                            <h6 class="msg-info">{{ __('Reset Password') }}</h6>

                            <div class="form-group">
                                <label class="form-control-label text-muted">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-muted">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-muted">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="row justify-content-center my-3 px-3">
                                <button type="submit" class="btn-block btn-color">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
                <div class="bottom text-center mb-5">
                    <p href="javascript:void(0);" class="sm-text mx-auto mb-3">Return to <a href="{{ url('login') }}" class="sign-in-txt">Login</a></p>
                </div>
            </div>
            <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5 right">
                    <h3 class="text-white">We are more than just a company</h3> <small class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</small>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection