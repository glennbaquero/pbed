@extends('admin.auth-master')

@section('meta:title', 'Change Password')

@section('content')
<div class="frm-login-cntnr frm-login--admin">
    <div class="page-bg page-bg--cover bring-back" style="background: #762B1C"></div>
    <div class="row no-gutters frm-login">
        <div class="align-self-center width--100">
            <div class="d-flex align-items-center justify-content-center l-margin-b">
                <img src="/images/cis-logo.png" style="height: 42px" class="">
            </div>
            <div class="card">
                <form method="POST" action="{{ route('admin.password.change') }}">
                    @csrf
                    <p class="align-c l-margin-b">Please enter your new password</p>
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                    @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif

                    <div class="frm--input m-margin-b has-feedback">
                        <label class="frm--label with-icon">
                            <input id="password" type="password" class="frm--text prepend{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="new password" required>
                            <i class="fa fa-lock"></i>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </label>
                    </div>

                    <div class="frm--input m-margin-b has-feedback">
                        <label class="frm--label with-icon">
                            <input id="password" type="password" class="frm--text prepend" name="password_confirmation" placeholder="confirm new password" required>
                            <i class="fa fa-lock"></i>
                        </label>
                    </div>

                    <div class="d-flex align-items-center flex-wrap">
                        <div class="col-12 mb-2 px-5">
                            <button type="submit" class="btn type-1 btn-block">CHANGE PASSWORD</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
