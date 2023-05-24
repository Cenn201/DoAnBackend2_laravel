@extends('dashboard')
@section('content')
@if ($success = Session::get('success'))
<div class="alert alert-success text-center" role="alert">
    {{ $success }}
</div>
@endif
    <div class="wrapper">
        <div class="form-box login">
            <h2>Đăng Ký</h2>
            <form action="{{ route('handleRegister.custom') }}" method="post">
                @csrf
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </span>
                    <input type="text" name="username" required autofocus>
                    <label>Username</label>
                    @if ($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-outline"></ion-icon>
                    </span>
                    <input type="email" name="email" required autofocus>
                    <label>Email</label>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password"name="password" required>
                    <label>Nhập mật khẩu </label>
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password" name="passwordagain" required>
                    <label>Nhập lại mật khẩu</label>
                    @if ($errors->has('passwordagain'))
                    <span class="text-danger">{{ $errors->first('passwordagain') }}</span>
                    @endif
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox">Remember me
                    </label>
                </div>
                <button type="submit" class="btn-submit">Đăng ký</button>
                <div class="login-register">
                    <p>Bạn có tài khoản?<a href="{{ route('showLogin')}}" class="register-link"> Đăng Nhập</a></p>
                </div>
            </form>
        </div>

    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="./public/js/app.js">

    </script>
  @endsection