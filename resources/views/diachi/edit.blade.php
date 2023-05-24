<style>
    .item {
        text-decoration: none;
        color: #000;
        padding-top: 30px;
    }
</style>
@extends('dashboard')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <div class="" style=" text-align: center; margin-top: 10px;">
                <h4 ><a href="{{route('users.show' , $user->id) }}" style="text-decoration: none; color: #000;" onclick="return confirm('Bạn có muốn thoát khỏi trang và không chỉnh sửa thông tin không ? ');">{{ $user->username }}</a></h4>
                    <p>{{ $user->sdt }}</p>

                </div>

                <div class="item ">
                    <a href="" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-regular fa-rectangle-list" style="padding-right: 20px;"></i> Đơn hàng của tôi</a>
                </div>
                <div class="item ">
                    <a href=" {{ route('user.address',$user->id)}}" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-solid fa-location-dot" style="padding-right: 20px;"></i> Địa chỉ nhận hàng</a>
                </div>
                <div class="item ">
                    <a href="" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-regular fa-bell" style="padding-right: 20px;"></i> Thông báo</a>
                </div>
                <div class="item ">
                    <a href="" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-solid fa-eye" style="padding-right: 20px;"></i> Sản phẩm mới xem</a>
                </div>
            </div>
            <div class="col-md-8">
                <h3> Cập nhật địa chỉ</h3>


                <div class="infor" style="border: 2px solid #6c757d ; border-radius: 20px; padding: 30px;">
                    <form action="{{route('diachi.update', $diachi->id)}}" method="POST">

                        <!-- chống tấn công -->
                        @csrf
                        <!--Update toan bo  -->
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tinh" class="form-label">tỉnh/Thành phố</label>
                            <input type="text" class="form-control" id="tinh" name="tinh" value="{{$diachi->tinh}}">
                        </div>
                        @error('tinh')
                            <div class="alert alert-danger">{{ 'Nhập vào không quá 30 kí tự' }}</div>
                            @enderror
                        <div class="mb-3">
                            <label for="huyen" class="form-label">Quận / Huyện</label>
                            <input type="text" class="form-control" id="huyen" name="huyen" value="{{$diachi->huyen}}">
                        </div>
                        @error('huyen')
                            <div class="alert alert-danger">{{ 'Nhập vào không quá 30 kí tự' }}</div>
                            @enderror
                        <div class="mb-3">
                            <label for="xa" class="form-label">phường / xã</label>
                            <input type="text" class="form-control" id="xa" name="xa" value="{{$diachi->xa}}">
                        </div>
                        @error('xa')
                            <div class="alert alert-danger">{{ 'Nhập vào không quá 30 kí tự' }}</div>
                            @enderror
                        <div class="mb-3">
                            <label for="cuThe" class="form-label">Địa chỉ cụ thể</label>
                            <input type="text" class="form-control" id="cuThe" name="cuThe" value="{{$diachi->cuThe}}">
                        </div>
                        @error('cuThe')
                            <div class="alert alert-danger">{{ 'Nhập vào không quá 70 kí tự' }}</div>
                            @enderror

                        <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn có thật sự muốn chỉnh sửa thông tin này  ? ');">Cập nhập địa chỉ</button>
                    </form>
                </div>

            </div>
        </div>


    </div>
    @endsection