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
                <h4 ><a href="{{route('users.show' , $user->id) }}" style="text-decoration: none; color: #000;" onclick="return confirm('Bạn có muốn thoát khỏi trang này không ? ');">{{ $user->username }}</a></h4>
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
                <h2> Cập nhật thông tin</h2>


                <div class="infor" style="border: 2px solid #6c757d ; border-radius: 20px; padding: 30px;">
                    <form action="{{route('users.update', $user->id , $user->id)}}" method="POST">

                        <!-- chống tấn công -->
                        @csrf
                        <!--Update toan bo  -->

                        @method('PUT')

                        <div class="mb-3">
                            <label for="username" class="form-label">username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}">
                        </div>
                        @error('username')
                            <div class="alert alert-danger">{{ 'vui lòng nhập đúng dữ liệu' }}</div>
                            @enderror
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}"readonly>
                        </div>
                       
                        <div class="mb-3">
                            <label for="sdt" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="sdt" name="sdt" value="{{$user->sdt}}" >
                            @error('sdt')
                                <div class="alert alert-danger">{{ 'vui lòng nhập đủ 10 số ' }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="hoten" class="form-label">họ và tên</label>
                            <input type="text" class="form-control" id="hoten" name="hoten" value="{{$user->hoten}}">
                            @error('hoten')
                                <div class="alert alert-danger">{{ 'Nhập vào không quá 50 kí tự' }}</div>
                                @enderror
                        </div>

                        <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn có thật sự muốn chỉnh sửa thông tin này  ? ');">Edit</button>
                    </form>
                </div>

            </div>
        </div>


    </div>
    @endsection