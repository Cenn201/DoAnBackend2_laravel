@extends('dashboard')
@section('content')
<!-- san pham gio hang -->
<div class="container">
    <table class="table" style="background:#fff;">
        <tr class="cart_item">
            <th class="product_item"> <input type="checkbox" id="allProducts" onclick="toggle(this)">Sản phẩm </th>
            <th>Đơn giá </th>
            <th>Số lượng</th>
            <th>Số tiền</th>
        </tr>
        @if (!empty($carts))
        @foreach ($carts as $cart)
        <tr>
            <td style="font-size: 15px;text-overflow:ellipsis;"> <input type="checkbox" onclick="checkButton()" name="productCart[]" id="productCart" class="product-checkbox" value="{{ $cart->products->first()->id }}" />
                <a href="{{ route('showProductDetail',['id'=>$cart->products->first()->id ]) }}" class="product__item">
                    <img src="{{ asset('/uploads/'.$cart->products->first()->hinhanh)}}" alt="" class="img-fluid " style="width:100px;">
                    {{$cart->products->first()->tensp}}
                </a>
            </td>
            <td class="product__desciption"> {{number_format($cart->products->first()->gia)}} VND</td>
            <td>{{$cart->soluong}} </td>
            <td> {{number_format($cart->products->first()->gia * $cart->soluong)}} VND</td>
        </tr>
        @endforeach
    </table>
    <div class="payment_cart_right">
        <form action="#" method="get" id="form-buy">
            <button id="payment_Product_checked" class="btn btn-danger oder-product-btn"> Mua Hàng</button>
        </form>
        <button type="button" class="btn btn-danger" style="padding: 0;width: 100px;height: 38px;" id="submit-del-products" data-user-id="{{ $userId }}">Xoá</button>
    </div>
    @endif
</div>
@endsection
<script>
    function toggle(source) {
        checkboxes = document.getElementsByName('productCart[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
        checkButton();
    }

    function CheckAll() {
        // var payment = document.getElementById('payment_Product_checked');
        // var del = document.getElementById('delete_product');

        if (document.getElementById('allProducts').clicked == true) {

            return true;
        }
        return false;
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function checkButton() {
        // Lấy danh sách các checkbox
        const checkboxes = document.querySelectorAll('#productCart');
        // Tạo một mảng để lưu trữ giá trị các checkbox được chọn
        const selectedCheckboxes = [];

        // Lặp qua các checkbox
        checkboxes.forEach((checkbox) => {
            // Kiểm tra xem checkbox đó đã được chọn hay không
            if (checkbox.checked) {
                // Nếu checkbox đã được chọn, thêm giá trị của nó vào mảng selectedCheckboxes
                selectedCheckboxes.push(checkbox.value);
            }
        });

        // Lấy giá trị của các checkbox được chọn
        const selectedValues = selectedCheckboxes.join(',');
        console.log(selectedValues);
        return selectedValues;
    }

    document.addEventListener('DOMContentLoaded', function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        const btnDel = document.querySelector('#submit-del-products');
        const btnBuy = document.querySelector('.oder-product-btn');
        var userId = btnDel.getAttribute('data-user-id');
        var actionfrom = document.getElementById('form-buy');
        btnBuy.addEventListener('click', () => {
            var product_ids = checkButton();
            console.log(product_ids);
            var formActionUrl = "{{ route('useroderproducts.index', ['__product_ids__', 0]) }}";
            var newActionUrl = formActionUrl.replace('__product_ids__', product_ids);
            actionfrom.action = newActionUrl;
        })

        btnDel.addEventListener('click', function() {
            var url = "{{ route('carts.destroy') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: JSON.stringify({
                    product_ids: [checkButton()],
                    user_id: userId
                }),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Sản phẩm đã được xoá');
                    // Tải lại trang
                    location.reload();
                },
                error: function(xhr) {
                    console.log('Đã xảy ra lỗi khi xoá sản phẩm trong giỏ hàng');
                }
            });
        });
    });
</script>