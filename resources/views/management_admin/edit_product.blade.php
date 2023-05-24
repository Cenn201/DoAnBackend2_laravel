@extends('admin_layout')
@section('admin_content')

<h6 class="font-weight-bolder mb-0">Edit Product</h6>
<hr>
<form style="width: 1500px;" action="{{ route('editproduct',$sp[0]->id) }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group ">
  <label style="font-size:16px" class="font-weight-bolder mb-0">Product Name</label>
    <label style="font-size:16px" class="font-weight-bolder mb-0"></label>
    <input type="text" name="product_name" class="form-control" id="product_name" value="{{ $sp[0]->tensp }}" placeholder="Enter product name">
    @if ($errors->has('product_name'))
    <span class="text-danger">{{ $errors->first('product_name') }}</span>
    @endif
  </div>

  <div class="form-group">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Product Description</label>
    <textarea style="resize: none;" rows="5" class="form-control" name="product_desc" id="editor1" >{{$sp[0]->mota}}</textarea>
    @if ($errors->has('product_desc'))
    <span class="text-danger">{{ $errors->first('product_desc') }}</span>
    @endif
  </div>

  <div class="form-group ">
  <label style="font-size:16px" class="font-weight-bolder mb-0">Number of product</label>
    <label style="font-size:16px" class="font-weight-bolder mb-0"></label>
    <input type="text" name="number_of_product" class="form-control" id="number_of_product" value="{{ $sp[0]->soluong }}" placeholder="Enter number of product">
    @if ($errors->has('number_of_product'))
    <span class="text-danger">{{ $errors->first('number_of_product') }}</span>
    @endif
  </div>

  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Product Price</label>
    <input type="text" name="product_price" class="form-control" id="product_price" value="{{ $sp[0]->gia }}" placeholder="Enter product price">
    @if ($errors->has('product_price'))
    <span class="text-danger">{{ $errors->first('product_price') }}</span>
    @endif
  </div>

  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Product Image</label>
    <input type="file" name="product_img" class="form-control" id="product-img" >
    @if ($errors->has('product_img'))
    <span class="text-danger">{{ $errors->first('product_img') }}</span>
    @endif
    <br>
    <img src="{{ asset('/uploads/'.$sp[0]->hinhanh) }}" height="100px" width="100px" alt="">
  </div>

  <label style="font-size:16px" for="product-parent">Category</label>
  <select name="category" class="form-control" id="product-parent">
  @foreach($listLsp as $item)
    @if($item->id==$sp[0]->id_loaisp)
    <option selected value="{{ $item->id }}">{{ $item->tenloaisanpham }}</option>
    @else
    <option value="{{ $item->id }}">{{ $item->tenloaisanpham }}</option>
    @endif
    @endforeach
    
  </select>
  <br>

<label style="font-size:16px" for="product-parent">Promotional</label>
  <select name="promotional" class="form-control" id="product-parent">
  <option value="-1">None</option>
  @foreach($listkm as $item)
    @if($item->id==$sp[0]->id_khuyenMai)
    <option selected value="{{ $item->id }}">{{ $item->tenkhuyenmai }}</option>
    @else
    <option value="{{ $item->id }}">{{ $item->tenkhuyenmai }}</option>
    @endif
    @endforeach
  </select>
  <br>
  <hr>
  <button type="submit" name="add_category_product" class="btn btn-primary">Edit</button>

</form>


@endsection