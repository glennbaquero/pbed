@extends('web.auth-master')

@section('meta:title', 'Forgot Password')

@section('content')

<div class="frm-login-cntnr">
    <div class="page-bg page-bg--cover bring-back" style="background: #c4c4c4"></div>
    <div class="row no-gutters frm-login">
        <div class="page-bg page-bg--cover bring-back" style="background: #fff"></div>
        <div class="align-self-center width--100">
            <div class="card">
                <div class="d-flex align-items-center justify-content-center l-margin-b">                    
                    {{-- <h2 class="font-1 fntwght--bold mr-2">Welcome to</h2> --}}
                    <img src="/images/pbed-logo-colored.svg" class="">
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('web.password.email') }}">
                    @csrf
                    <p class="m-margin-b align-c">Reset Password</p>
                    <div class="frm--input m-margin-b has-feedback">
                        <label class="frm--label with-icon">
                            <input id="email" type="email" class="frm--text prepend{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="enter your email address" required autofocus>
                            <i class="fa fa-user"></i>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </label>
                    </div>

                    <div class="d-flex align-items-center flex-wrap">
                        <div class="col-12 mb-2 px-5">
                            <button type="submit" class="btn frm-btn type-1 btn-block">SEND PASSWORD RESET LINK</button>
                        </div>
                        <div class="col-12 px-5">
                            <a href="{{ route('web.login') }}" class="btn btn-light border btn-block">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <div class="login-box-msg">
    <h5>{{ __('Reset Password') }}</h5>
</div>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
 --}}


@endsection
