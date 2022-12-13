@extends('admin.layouts.master')
@section('content')
<div class="col-md-12">
    <h1>SỬA DANH MỤC</h1>
    <form action="{{ route('admincategory.update', $category->category_id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group col-4">
            <label for="">Tên danh mục:</label>
            <input type="text" name="categoryname" class="form-control mt-1" placeholder="Nhập tên danh mục" value="{{$category->category_name}}">
        </div>
        <button type="submit" class="btn btn-info mt-2">Lưu</button>
    </form>
</div>
@endsection