@extends('admin_layout')
@section('admin_content')


<hr>
<form method="POST" action="{{ url('/update-status/'.$order_by_id -> id_donhang ) }}">
  @csrf
  <select name="status">
    <option style="background-color: #ffc107;" value="1" @if ($order_by_id->trangthai == 1) selected @endif>Pending</option>
    <option style="background-color: #007bff;" value="2" @if ($order_by_id->trangthai == 2) selected @endif>Comfirm</option>
    <option style="background-color: #28a745;" value="3" @if ($order_by_id->trangthai == 3) selected @endif>Done</option>
    <option style="background-color: #dc3545;" value="4" @if ($order_by_id->trangthai == 4) selected @endif>Cancelled</option>
  </select>
  <br>
  <br>
  <button class="btn btn-success" type="submit">Save</button>
</form>
<h6 class="font-weight-bolder mb-0">Information</h6>

<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr style="text-align:  center;">
      <th>Name</th>
      <th>Phone</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <tr>

      <td style="text-align: center;">
        {{ $order_by_id->hoten }}
      </td>
      <td style="text-align: center;">
        {{ $order_by_id->sdt }}
      </td>

      <td style="text-align: center;">
        {{ $order_by_id->email }}
      </td>
    </tr>
  </tbody>
</table>
<br>
<hr>

<h6 class="font-weight-bolder mb-0">Shipping Detail</h6>
<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr style="text-align:  center;">

      <th>Address</th>
      <th>Note</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;">
        {{ $order_by_id->cuThe }}
      </td>

      <td style="text-align: center;">

      </td>
    </tr>
  </tbody>
</table>

<br>
<hr>
<hr>
<h6 class="font-weight-bolder mb-0">Order Detail</h6>
<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr style="text-align:  center;">
      <th>Hình ảnh</th>
      <th>Tên sản phẩm</th>
      <th>Giá</th>
    </tr>
  </thead>
  <tbody>
    @foreach($order_by_id_product as $key => $value)
    <tr>
      <td>
        <div class="d-flex align-items-center" style="justify-content: center;">
          <div class="ms-3">
            <p class="fw-bold mb-1 "><img src="{{ asset('/uploads/'.$value-> hinhanh) }}" class="img-fluid" alt="" width="200px" height="200px"></p>

          </div>
        </div>
      </td>

      <td style="text-align: center;">
        {{ $value->tensp }}
      </td>

      <td style="text-align: center;">
        {{number_format($value->gia).' VNĐ'}}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<h4 style="color:red; text-align:center;padding: 50px 0px;">Tổng tiền: {{ $order_by_id->tongtien }} VNĐ</h2>
  {{-- <button class="order-status-btn">
  <span class="status waiting">Pending</span>
  <span class="status processing">Comfirm</span>
  <span class="status completed">Done</span>
  <span class="status cancelled">Cancelled</span>
</button> --}}
<a target="_blank" href="{{ url('print-order/'.$order_by_id->id_donhang ) }}" class="btn btn-info" type="submit">Print Bill</a>

<br>

  @endsection