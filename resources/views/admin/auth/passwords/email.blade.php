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
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.password.email') }}">
                    @csrf
                    <div class="frm--input m-margin-b has-feedback">
                        <label class="frm--label with-icon">

                            <input id="email" type="email" class="frm--text prepend{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="enter your email address" required autofocus>
                            <i class="fa fa-envelope"></i>

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
                            <a href="{{ route('admin.login') }}" class="btn frm-btn btn-light border btn-block">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection