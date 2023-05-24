@extends('dashboard')
@section('content')
@if ($success = Session::get('success'))
<div class="alert alert-success text-center" role="alert">
    {{ $success }}
</div>
@endif
<div class="wrapper">
    <div class="form-box login">
        <h2>Thay Đổi Mật Khẩu</h2>
        <form action="{{ route('customer.changepassword') }}" method="post">
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
                <input type="password" name="oldpassword" required autofocus>
                <label>Nhập mật khẩu cũ</label>
                @if ($errors->has('oldpassword'))
                <span class="text-danger">{{ $errors->first('oldpassword') }}</span>
                @endif
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                </span>
                <input type="password" name="newpassword" required autofocus>
                <label>Nhập mật khẩu mới</label>
                @if ($errors->has('newpassword'))
                <span class="text-danger">{{ $errors->first('newpassword') }}</span>
                @endif
            </div>
            <div class="remember-forgot">
                <label>
                    <input type="checkbox">Remember me
                </label>
            </div>
            <button type="submit" class="btn-submit">Thay đổi</button>
            <div class="login-register">
                <p>Bạn có tài khoản chưa?<a href="{{ route('showLogin')}}" class="register-link"> Đăng nhập/</a><a href="{{ route('showRegister')}}" class="register-link">Đăng ký</a></p>
            </div>
        </form>
    </div>
</div>
@endsection