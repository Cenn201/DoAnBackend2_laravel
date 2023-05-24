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
                    <h4 ><a href="" style="text-decoration: none; color: #000;">{{ $user->username }}</a></h4>
                    <p>{{ $user->sdt }}</p>

                </div>

                <div class="item ">
                    <a href=" {{route('donhang.index' )}}" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-regular fa-rectangle-list" style="padding-right: 20px;"></i> Đơn hàng của tôi</a>
                </div>
                <div class="item ">
                    <a href="{{ route('user.address',$user->id)}} " style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-solid fa-location-dot" style="padding-right: 20px;"></i> Địa chỉ nhận hàng</a>
                </div>
                <div class="item ">
                    <a href="" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-regular fa-bell" style="padding-right: 20px;"></i> Thông báo</a>
                </div>
                <div class="item ">
                    <a href="" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-solid fa-eye" style="padding-right: 20px;"></i> Sản phẩm mới xem</a>
                </div>
            </div>
            <div class="col-md-8">
                <h1>Information</h1>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                <div class="infor" style="border: 2px solid #6c757d ; border-radius: 20px; padding: 30px;">
                <p> <b>Name : </b> {{ $user->username }}</p>
                <p><b>Email : </b>{{ $user->email }}</p>
               <p> <b>Số điện thoại : </b>{{ $user->sdt }}</p>
               <p> <b>Họ và tên : </b>{{ $user->hoten }}</p>
              <a href="{{ route('users.edit', $user->id)}}" class="btn btn-primary">Chỉnh sửa thông tin</a>
                </div>

            </div>
        </div>


    </div>
    @endsection