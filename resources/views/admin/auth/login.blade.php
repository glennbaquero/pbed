@extends('admin.auth-master')

@section('meta:title', 'Login')

@section('content')

<div class="frm-login-cntnr frm-login--admin">
    <div class="page-bg page-bg--cover bring-back" style="background: #762B1C"></div>
    <div class="row no-gutters frm-login">
        <div class="align-self-center width--100">
            <div class="d-flex align-items-center justify-content-center l-margin-b">
                <img src="/images/PBEd_horizontal.png" style="height: 42px" class="">
            </div>
            <div class="card">
                <form action="{{route('admin.login')}}" method="POST">
                    @csrf
                    <p class="align-c l-margin-b">Sign in to start your session</p>
                    <div class="frm--input m-margin-b has-feedback">
                        <label class="frm--label with-icon">
                            <input id="email" type="email" class="frm--text prepend{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="enter your email" required autofocus>
                            <i class="fa fa-user"></i>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
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
                            <button type="submit" class="btn frm-btn type-1">LOGIN</button>
                        </div>
                        <div class="col-6 pr-0 align-r">
                            <a class="forgot-pw" href="{{ route('admin.password.request') }}">Forgot Password?</a><br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection