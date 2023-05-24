@extends('admin_layout')
@section('admin_content')

<h6 class="font-weight-bolder mb-0">Add Category</h6>
<hr>
<form style="width: 1500px;" action="{{ route('addcategories') }}" method="post">
  @csrf
  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0"></label>
    <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Enter category name">
    @if ($errors->has('category_name'))
    <span class="text-danger">{{ $errors->first('category_name') }}</span>
    @endif
  </div>


  <hr>
  <button type="submit" name="add_category_product" class="btn btn-primary">Add</button>

</form>


@endsection