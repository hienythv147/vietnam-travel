@extends('layouts.app')

@section('content')
<div class="card card-primary" style="margin: 10px;">
  <div class="card-header">
    <h3 class="card-title">Danh Sách Danh Mục Tour</h3>
  </div>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tiêu đề</th>
      <th scope="col">Mô tả</th>
      <th scope="col">Hình ảnh</th>
      <th scope="col">Slug</th>
      <th scope="col">Status</th>
      <th scope="col">Ngày tạo</th>
      <th scope="col">Ngày sửa</th>
      <!-- <th scope="col"><i class="nav-icon fas fa-tachometer-alt"></i></th> -->
    </tr>
  </thead>
  <tbody>
    @foreach($categories as $key => $cate) 
    <tr>
      <th scope="row">{{$cate->id}}</th>
      <td>{{$cate->title}}</td>
      <td>{{$cate->description}}</td>
      <td><img src="{{asset('uploads/categories/'.$cate->image)}}" height="120" width="120"/></td>
      <td>{{$cate->slug}}</td>
      <td>
        @if($cate->status == 1)
        <span class="text text-success">Active</span>
        @else
        <span class="text text-danger">Unactive</span>
        @endif
      </td>
      <td>{{$cate->created_at}}</td>
      <td>{{$cate->updated_at}}</td>
      <td>
        <a href="{{route('categories.edit', [$cate->id])}}" class="btn btn-warning">Sửa</a>
        <form onsubmit="return confirm('Bạn có muốn xóa không?');" action="{{route('categories.destroy', [$cate->id])}}" method="POST">
          @method('DELETE')
          @csrf
          <input type="submit" class="btn btn-danger" value="Xóa">
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection
