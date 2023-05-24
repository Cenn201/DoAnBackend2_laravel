@extends('admin_layout')
@section('admin_content')


<hr>
<h6 class="font-weight-bolder mb-0">Coupon</h6>
<table class="table align-middle mb-0 bg-white" >
  <thead class="bg-light">
    <tr style="text-align:  center;">
      <th>Tên khuyến mại</th>
      <th>Giá trị</th>
      <th>Ngày tạo</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody >

  	@foreach($coupon as $key => $cp)
    <tr>
      <td>
        <div class="d-flex align-items-center">
         {{--  <img
              src="https://mdbootstrap.com/img/new/avatars/8.jpg"
              alt=""
              style="width: 45px; height: 45px"
              class="rounded-circle"
              /> --}}
          <div class="ms-3">
            <p class="fw-bold mb-1">{{ $cp->tenkhuyenmai }}</p>
          </div>
        </div>
      </td>
      <td>
        {{ $cp->giatri }}
      </td>
      <td>
      	{{ $cp->created_at }}
      </td>
      <td style="text-align: center;">
      	<a onclick="return confirm('Are you sure you want delete?')" href="{{URL::to('delete-coupon/'.$cp->id)}}" type="button" class="btn btn-danger">Delete</a>

      </td>
    </tr>
    @endforeach

  </tbody>
</table>
@endsection