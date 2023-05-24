@extends('dashboard')
@section('content')


<div class="container">
    @if ($address == null)
    <h1 class="text-center py-3">Vui lòng nhập thông tin</h1>
    <div class="adress-user-oder">
        <form action="{{route('userorders.store')}} " method="POST">
            @csrf
            <div class="mb-3 form-outline">
                <label for="hoten" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="hoten" name="hoten">
            </div>
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('hoten') }}</span>
            @endif
            <div class="mb-3 form-outline">
                <label for="sdt" class="form-label">Số điện thoại</label>
                <input type="phone" class="form-control" id="sdt" name="sdt">
            </div>
            @if ($errors->has('sdt'))
            <span class="text-danger">{{ $errors->first('sdt') }}</span>
            @endif
            <div class="mb-3 form-outline">
                <label for="tinh" class="form-label">Tỉnh / Thành phố</label>
                <input type="text" class="form-control" id="tinh" name="tinh">
            </div>
            @if ($errors->has('tinh'))
            <span class="text-danger">{{ $errors->first('tinh') }}</span>
            @endif
            <div class="mb-3 form-outline">
                <label for="huyen" class="form-label">Quận / Huyện</label>
                <input type="text" class="form-control" id="huyen" name="huyen">
            </div>
            @if ($errors->has('huyen'))
            <span class="text-danger">{{ $errors->first('huyen') }}</span>
            @endif
            <div class="mb-3 form-outline">
                <label for="xa" class="form-label">Xã / Phường</label>
                <input type="text" class="form-control" id="xa" name="xa">
            </div>
            @if ($errors->has('xa'))
            <span class="text-danger">{{ $errors->first('xa') }}</span>
            @endif
            <div class="mb-3 form-outline">
                <label for="diachicuthe" class="form-label">Địa chỉ cụ thể</label>
                <input type="text" class="form-control" id="diachicuthe" name="diachicuthe">
            </div>
            @if ($errors->has('diachicuthe'))
            <span class="text-danger">{{ $errors->first('diachicuthe') }}</span>
            @endif
            <button type="submit" class="btn btn-danger">Thêm địa chỉ</button>
        </form>
    </div>
    @else
    <h1 class="text-center py-3">Mua Hàng</h1>
    <div class="container">

        <!--Section: Design Block-->
        <section>

            <div class="row">
                <div class="col-md-8">
                    <div class="card py-5">
                        <div class="card-body">
                            <div class="col-md-9">
                                <h4><b>Địa chỉ</b></h4>
                                <p> Tên : {{$user->hoten}} | SĐT : {{$user->sdt}}</p>
                                <p>Địa chỉ cụ thể : {{ $address->cuThe }} </p>
                                <p> Xã/phường: {{ $address->xa }}, quận/huyện: {{ $address->huyen }}, tỉnh/thành phố: {{ $address->tinh }}</p>
                            </div>
                            <div class="col-md-3" style="display: -webkit-box;">
                                <button class="btn btn-danger px-4 py-2 btn-update-address">Sửa</button>
                            </div>
                        </div>
                    </div>
                    <div class="row px-4">
                        <div class="payment py-3 card-body col-md-8">
                            <h3 class="py-2">Hình thức thanh toán</h3>
                            <div class="d-flex flex-row pb-3">
                                <div class="d-flex align-items-center pe-2">
                                    <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1" value="" aria-label="..." />
                                </div>
                                <div class="rounded border d-flex w-100 p-3 align-items-center">
                                    <p class="mb-0">
                                        <i class="fab fa-cc-visa fa-lg text-primary pe-2"></i>Visa Debit
                                        Card
                                    </p>
                                    <div class="ms-auto">************3456</div>
                                </div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="d-flex align-items-center pe-2">
                                    <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2" value="" aria-label="..." checked />
                                </div>
                                <div class="rounded border d-flex w-100 p-3 align-items-center">
                                    <p class="mb-0">
                                        <i class="fab fa-cc-mastercard fa-lg text-dark pe-2"></i>Tiền mặt
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-success text-center" style="display:none" role="alert">
                            </div>
                        </div>
                        <button class="btn btn-danger btn-payment btn-center py-3">Xác nhận thanh toán</button>
                    </div>
                </div>
                <div class="col-md-4 mb-4 position-static">
                    <div class="card mb-4">
                        <div class="card-header py-4">
                            <h5 class="mb-0 text-font">Sản phẩm <span class="float-end mt-1" style="font-size: 13px ;">Edit</span></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @php
                                $i = 0;
                                @endphp
                                @foreach ($products as $product)
                                <div class="col-md-4">
                                    <img src="{{ asset('/uploads/'.$product->hinhanh) }}" class="rounded-3" style="width: 100px;" alt="Blue Jeans Jacket" />
                                </div>
                                <div class="col-md-6 ms-3">
                                    <span class="mb-0 text-price"> {{ number_format($product->gia) }} VND</span>
                                    <p class="mb-0 text-descriptions">{{$product->tensp}}</p>
                                    <p class="text-descriptions mt-0">Số lượng:<span class="text-descriptions fw-bold"> {{$quantity[$i]}}</span>
                                    </p>
                                </div>
                                <hr>
                                @php
                                $prices[] = $product->gia;
                                $i++;
                                @endphp
                                @endforeach
                            </div>
                            <div class="card-footer-fluid mt-1">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 text-muted">
                                        Phí vận chuyển
                                        <span>{{ number_format(10000)}} VND</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 text-muted">
                                        Tổng tiền
                                        @php
                                        $result = array_sum(array_map(function ($a, $b) {
                                        return $a * $b;
                                        }, $prices, $quantity));
                                        @endphp
                                        <span>{{ number_format($result - 10000)}} VND </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 fw-bold text-uppercase">
                                        Tổng hoá đơn
                                        <span class="total-bill">{{number_format($result)}} VND</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section: Design Block-->
    </div>


    @endif
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        const btnAdd = document.querySelector('.btn-payment');
        const notification = document.querySelector('.alert-success');
        const address = "{{$address}}";
        const btnUpdateAddress = document.querySelector('.btn-update-address');
        btnUpdateAddress.addEventListener('click',()=>{
            '{{$address = null}}';
        });
        console.log(address);
        // var productPrice = [];
        if (address != "" ) {
            btnAdd.addEventListener('click', function() {
                productPrice = '{!! isset($prices) ? json_encode($prices) : "" !!}';
                var productQuantity = '{!! isset($prices) ? json_encode($quantity) : "" !!}';
                var totalBill = '{{ isset($prices) ?  $result : ""}}';
                var productId = '{!! isset($prices) ?  json_encode($idProducts) : ""!!}';
                var url = "{{ route('userorders.create') }}";
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: JSON.stringify({
                        product_ids: JSON.parse(productId),
                        totalBill: totalBill,
                        productQuantity: JSON.parse(productQuantity),
                        productPrice: JSON.parse(productPrice),
                        user_id:'{{$userID}}'
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Sản phẩm đã được thanh toán');
                        notification.innerHTML = "Mua sản phẩm thành công!!";
                        notification.style.display = "unset";
                        setTimeout(function() {
                            notification.style.display = "none";
                        }, 2000);
                        window.location.href = "{{ route('userproduct.index') }}";
                    },
                    error: function(xhr) {
                        console.log('Đã xảy ra lỗi khi thanh toán sản phẩm');
                        notification.innerHTML = "Mua sản phẩm thất bại!!";
                        notification.style.display = "unset";
                        setTimeout(function() {
                            notification.style.display = "none";
                        }, 1000);
                    }
                });

            });
        }
    });
</script>