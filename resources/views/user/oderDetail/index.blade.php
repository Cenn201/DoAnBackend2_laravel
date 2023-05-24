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

                <h4><a href="{{route('users.show' , $user->id) }}" style="text-decoration: none; color: #000;">{{ $user->username }}</a></h4>
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
            <div class="status" style="display: flex; border-radius: 2px; border: solid 2px  #e1d8d8; padding: 15px; background: #e1d8d8;">
                <div class="item_status" style="margin-right: 50px;">
                    <a href=" {{route('donhang.index' )}}" style="text-decoration: none; color: #000;">Tất cả</a>
                </div>
                <div class="item_status" style="margin-right: 50px;">
                    <a href="{{route('oderDetail.status_dangGiao' )}}" style="text-decoration: none; color: #000;">đang vận chuyển</a>
                </div>
                <div class="item_status">
                    <a href="" style="text-decoration: none; color: #000;">đã giao</a>
                </div>
            </div>

            @foreach ($donhang as $dh)
            <!-- Hiển thị thông tin đơn hàng -->
            <h3>Đơn hàng: {{ $dh->id }}</h3>
            <!-- Hiển thị thông tin đơn hàng chi tiết -->
            @foreach ($dh->donhangchitiet as $dhct)
            <div class="row">
                <div class="col-md-3">
                    <div style="width: 150px; height: 150px;">

                        <img id="theImage" class="mySlides" src="{{ asset('/uploads/'.$dhct->sanpham->hinhanh) }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-9">
                    <p><b> {{ $dhct->sanpham->tensp }}</b></p>
                    <p>Số lượng: {{ $dhct->soLuongsp }}</p>

                    <p> giá : {{ number_format($dhct->gia, 0, ',', '.')  }} đ</p>

                    <!-- Hiển thị thông tin chi tiết khác của đơn hàng chi tiết -->
                    <!-- ... -->
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <p style="color: red;">Thành tiền : {{ number_format($dh->tongtien, 0, ',', '.') }} đ</p>

                    <p style="color: red;">Trạng thái: @if ($dh->trangthai == 2)
                        đã giao
                        @elseif($dh->trangthai == 1)
                        đang giao
                        @endif
                    </p>

                </div>
                <div class="col-md-4">
                   @if ($dh->trangthai == 2)

                    <form action="{{route('donhang.destroy', $dh->id)}}" method="POST" onsubmit="return confirm('Ban muon xoa khong')">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>

</div>
@endsection