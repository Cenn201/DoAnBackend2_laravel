@extends('dashboard')
@section('content')
    <div class="container">
        <h1 class="text-center">THÊM ĐỊA CHỈ MỚI</h1>

        <form action="{{route('diachi.store')}} " method="POST">
            <!-- chống tấn công -->
            @csrf
            <!--  -->
            <div class="mb-3">
                <label for="tinh" class="form-label">Tỉnh / Thành phố</label>
                <input type="text" class="form-control" id="tinh" name="tinh">
            </div>
            @error('tinh')
            <div class="alert alert-danger">{{ 'Nhập vào không quá 30 kí tự' }}</div>
            @enderror
            <div class="mb-3">
                <label for="huyen" class="form-label">Quận / Huyện</label>
                <input type="text" class="form-control" id="huyen" name="huyen">
            </div>
            @error('huyen')
            <div class="alert alert-danger">{{ 'Nhập vào không quá 30 kí tự' }}</div>
            @enderror
            <div class="mb-3">
                <label for="xa" class="form-label">Xã / Phường</label>
                <input type="text" class="form-control" id="xa" name="xa">
            </div>
            @error('xa')
            <div class="alert alert-danger">{{ 'Nhập vào không quá 30 kí tự' }}</div>
            @enderror
            <div class="mb-3">
                <label for="cuThe" class="form-label">Địa chỉ cụ thể</label>
                <input type="text" class="form-control" id="cuThe" name="cuThe">
            </div>
            @error('cuThe')
            <div class="alert alert-danger">{{ 'Nhập vào không quá 30 kí tự' }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Thêm địa chỉ</button>
        </form>
    </div>
    @endsection