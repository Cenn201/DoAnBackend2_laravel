@extends('admin_layout')    
@section('admin_content')
<h6 class="font-weight-bolder mb-0">Category Product</h6>
<div class="searcha">
    <form action="{{route('seekcategory')}}" method="GET">
        <div class="input-group">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="seek" placeholder="Type category name here...">
            <button type="submit" class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank">Search</button>
        </div>
        @csrf
        
    </form>
</div>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr style="text-align:  center;">
            <th>ID</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listLsp as $item)
        <tr>
            <td style="text-align: center;">
                <p class="fw-bold mb-1">{{ $item->id }}</p>
            </td>
            <td style="text-align: center;">
                {{$item->tenloaisanpham}}
            </td>
            <td style="text-align: center;">
                <a href="{{route('editscreencategories', ['id'=>$item->id])}}" type="button" class="btn btn-info">Edit</a>
                <a onclick="return confirm('Are you sure you want delete?')" href="{{route('removecategories', ['id'=>$item->id])}}" type="button" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div>{{$listLsp->links('pagination::bootstrap-4')}}</div>
@endsection