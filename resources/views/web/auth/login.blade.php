@extends('web.auth-master')

@section('meta:title', 'Login')

@section('content')

<div class="frm-login-cntnr">
    <div class="page-bg page-bg--cover bring-back frm-login__bg" style="background-image: url(/images/login-bg.jpg);"></div>
    <div class="row no-gutters frm-login">
        <div class="page-bg page-bg--cover bring-back" style="background: #fff"></div>
        <div class="align-self-center width--100">
            <div class="card">
                <div class="d-flex align-items-center justify-content-center l-margin-b">                    
                    <h2 class="font-1 fntwght--bold mr-2">Welcome to</h2>
                    <img src="/images/pbed-logo-colored.svg" class="">
                </div>
                <form action="{{ route('web.login') }}" method="POST">
                    @csrf
                    <p class="m-margin-b">Login your account</p>
                    <div class="frm--input m-margin-b has-feedback">
                        <label class="frm--label with-icon">
                            <input id="email" type="text" class="frm--text prepend{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="identity" value="{{ old('username') ?: old('email') }}" placeholder="enter you email" required autofocus>
                            <i class="fa fa-user"></i>

                            @if ($errors->has('username') || $errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </label>
                    </div>

                    <div class="frm--input m-margin-b has-feedback">
                        <label class="frm--label with-icon show_hide_password">
                            <input id="password" type="password" class="frm--text prepend append{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="enter your password" required>
                            <i class="fa fa-lock"></i>
                            <i class="fa fa-eye-slash showPass"></i>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </label>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="col-6 pl-0">
                            <button type="submit" class="frm-btn btn type-1 px-4">LOGIN</button>
                        </div>
                        <div class="col-6 pr-0 align-r">                            
                            <a class="forgot-pw" href="{{ route('web.password.request') }}">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection