@extends('admin_layout')
@section('admin_content')

<h6 class="font-weight-bolder mb-0">Add Coupon</h6>
<hr>

<form style="width: 1200px;" action="{{ URL::to('add-coupon') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Tên khuyến mại</label>
    <input type="text" name="tenkhuyenmai" class="form-control" id="tenkhuyenmai" placeholder="">
  </div>
  <div class="form-group">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Giá trị</label>
    <input type="text" name="giatri" class="form-control" id="tenkhuyenmai" placeholder="">
  </div>
  <button type="submit" name="add_coupon" class="btn btn-primary">Add</button>
  <hr>
</form>


  @endsection