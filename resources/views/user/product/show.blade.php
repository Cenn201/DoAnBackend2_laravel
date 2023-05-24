@extends('dashboard')
@section('content')
<div class="container" style="background: #fff;">
    <div class="row">
        <div class="col-md-6">
            <div class="show_img_main">
                <button class="next round" onclick="plusDivs(-1)">&#10094;</button>
                <div class="img_main">
                    @foreach ($photos as $photo)
                    <img id="theImage" class="mySlides" src="{{ asset('/uploads/'.$photo) }}" alt="">
                    @endforeach
                </div>
                <button class="next round" onclick="plusDivs(1)">&#10095;</button>
            </div>

            <div class="show_img">
                @foreach ($photos as $photo)
                <img src="{{ asset('/uploads/'.$photo)}}" alt="" class="img-fluid" style="width:20%;">
                @endforeach
            </div>

        </div>

        <div class="col-md-6">

            <div class="product-description ">
                <h3 style="padding-top:65px;">{{$product->tensp}}</h3>
                <div style="padding:8px;font-size: 32px;line-height: 32px;color: #C92127;font-family: 'Roboto',sans-serif !important;">
                    {{ number_format($product->gia) }}VND
                </div>
                <div>
                    Chính sách đổi trả : Đổi trả sản phẩm trong 30 ngày <a href=" " style="text-decoration: auto;">Xem thêm</a>
                </div>
            </div>
            <div class="box-product-promotion">
                <div class="is-flex p-2 has-text-weight-semibold is-align-items-center">
                    <div>
                        <div class="box-product-promotion">
                            <div class="box-product-promotion-header is-flex p-2 has-text-weight-semibold is-align-items-center">
                                <div class="icon">
                                    <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M152 0H154.2C186.1 0 215.7 16.91 231.9 44.45L256 85.46L280.1 44.45C296.3 16.91 325.9 0 357.8 0H360C408.6 0 448 39.4 448 88C448 102.4 444.5 115.1 438.4 128H480C497.7 128 512 142.3 512 160V224C512 241.7 497.7 256 480 256H32C14.33 256 0 241.7 0 224V160C0 142.3 14.33 128 32 128H73.6C67.46 115.1 64 102.4 64 88C64 39.4 103.4 0 152 0zM190.5 68.78C182.9 55.91 169.1 48 154.2 48H152C129.9 48 112 65.91 112 88C112 110.1 129.9 128 152 128H225.3L190.5 68.78zM360 48H357.8C342.9 48 329.1 55.91 321.5 68.78L286.7 128H360C382.1 128 400 110.1 400 88C400 65.91 382.1 48 360 48V48zM32 288H224V512H80C53.49 512 32 490.5 32 464V288zM288 512V288H480V464C480 490.5 458.5 512 432 512H288z"></path>
                                    </svg>
                                    <p>Khuyến Mãi</p>
                                </div>
                            </div>
                            <div class="box-product-promotion-content px-2 pt-2 show-all">
                                <div class="is-flex is-align-content-center my-2">

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="button-product-buy is-flex">
                <div class="col-md-6">
                    @if(!empty($userId))
                    <button class="btn btn-danger text-white add-to-cart-btn" data-product-id="{{ $product->id }}" data-user-id="{{ $userId }}" style="width:100%; height:100%; font-size: 15px;">Thêm vào giỏ hàng</button>
                    @else
                    <button class="btn btn-danger text-white add-to-cart-btn" data-product-id="{{ $product->id }}" style="width:100%; height:100%; font-size: 15px;">Thêm vào giỏ hàng</button>
                    @endif
                </div>
                <div class="col-md-6">
                    <form action="{{ route('useroderproducts.index', [$product->id,1]) }}" method="get">
                        @if(empty($userId))
                        <a href="{{ route('showLogin')}}" class="btn btn-danger text-white btn-mua">Mua ngay</a>
                        @else
                        <button class="btn btn-danger text-white btn-mua" data-product-id="{{ $product->id }}">Mua ngay</button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="notification" style="display: none;">
            </div>
        </div>
    </div>
    <div class="container" style="margin-top:20px; background:#fff;">
        <h3 style="padding-top:20px">Mô Tả Sản Phẩm</h3>
        <div style="padding:5px;">{{ $product->mota }}</div>

    </div>
    @endsection
    <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex - 1].style.display = "block";
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            const btnAdd = document.querySelector('.add-to-cart-btn');
            const notification = document.querySelector('.notification');
            btnAdd.addEventListener('click', function() {
                var productId = btnAdd.getAttribute('data-product-id');
                var userId = btnAdd.getAttribute('data-user-id');
                if (userId == null) {
                    window.location.href = "{{ route('showLogin')}}";
                } else {
                    var url = "{{ route('usercarts.store') }}";
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: JSON.stringify({
                            product_id: productId,
                            user_id:userId,
                            quantity: 1
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('Sản phẩm đã được thêm vào giỏ hàng');
                            notification.style.display = "unset";
                            notification.innerHTML = "<br><b>Thêm Sản Phẩm Vào Giỏ Hàng Thành Công</b>";
                            setTimeout(function() {
                                notification.style.display = "none";
                            }, 1000);
                        },
                        error: function(xhr) {
                            console.log('Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng');
                            notification.style.display = "unset";
                            notification.innerHTML = "<br><b>Thêm Sản Phẩm Vào Giỏ Hàng Không Thành Công</b>";
                            setTimeout(function() {
                                notification.style.display = "none";
                            }, 1000);
                        }
                    });
                }

            });

        });
    </script>