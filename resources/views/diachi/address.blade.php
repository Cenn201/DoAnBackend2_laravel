<style>
    .item {
        text-decoration: none;
        color: #000;
        padding-top: 30px;

    }

    .title {

        margin-top: 50px;
    }
</style>
@extends('dashboard')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <div class="" style=" text-align: center; margin-top: 50px;">

                <h4 ><a href="{{route('users.show' , $user->id) }}" style="text-decoration: none; color: #000;">{{ $user->username }}</a></h4>
                    <p>{{ $user->sdt }}</p>


                </div>

                <div class="item ">
                    <a href="" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-regular fa-rectangle-list" style="padding-right: 20px;"></i> Đơn hàng của tôi</a>
                </div>
                <div class="item ">
                    <a href="{{ route('user.address',$user->id)}}" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-solid fa-location-dot" style="padding-right: 20px;"></i> Địa chỉ nhận hàng</a>
                </div>
                <div class="item ">
                    <a href="" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-regular fa-bell" style="padding-right: 20px;"></i> Thông báo</a>
                </div>
                <div class="item ">
                    <a href="" style=" text-decoration: none;color: #000; font-size:20px;"><i class="fa-solid fa-eye" style="padding-right: 20px;"></i> Sản phẩm mới xem</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="title">

                    <div class="row">
                        <div class="col-md-9">
                            <h5>Địa chỉ của tôi</h5>
                        </div>
                        <div class="col-md-3"> <a href="{{ route('diachi.create', '$diachi->id')}}" class="btn btn-success">Thêm địa chỉ</a></div>
                    </div>

                </div>
                <hr>
                <div class="row">

                    @foreach ($addresses as $address)
                    <div class="col-md-9">
                        <p> <b> {{$user->hoten}}</b> | {{$user->sdt}}</p>
                        <p>{{ $address->cuThe }} </p>
                        <p> xã/phường: {{ $address->xa }}, quận/huyện: {{ $address->huyen }}, tỉnh/thành phố: {{ $address->tinh }}</p>
                    </div>
                    <div class="col-md-3" style="display: -webkit-box;">
                        <a href="{{ route('diachi.edit', $address->id)}}" class="btn btn-primary" style="margin-right:10px ;">Sửa</a>
                        <form action="{{route('diachi.destroy', $address->id)}}" method="POST" onsubmit="return confirm('Bạn có muốn xoá địa chỉ này')">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                    </div>
                    <hr>
                    @endforeach
                </div>

            </div>
        </div>


    </div>
    @endsection