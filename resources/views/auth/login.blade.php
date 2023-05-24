@extends('dashboard')
@section('content')
@if ($success = Session::get('success'))
<div class="alert alert-success text-center" role="alert">
    {{ $success }}
</div>
@endif
    <div class="wrapper login-wrapper">
        <div class="form-box login">
            <h2>Đăng nhập</h2>
            <form action="{{ route('handleLogin.custom') }}" method="post">
                @csrf
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-outline"></ion-icon>
                    </span>
                    <input type="email" name="email" required autofocus>
                    <label>Email or Username</label>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password"name="password" required>
                    <label>Mật khẩu</label>
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox">Remember me
                    </label>
                    <a href="{{ route('customer.showChangePassword') }}">Thay đổi mật khẩu</a>
                </div>
                <button type="submit" class="btn-submit">Đăng Nhập</button>
                <div class="login-register">
                    <p>Bạn chưa có tài khoản?<a href="{{ route('showRegister')}}" class="register-link"> Đăng ký</a></p>
                </div>
            </form>
        </div>
    </div>
    @endsection