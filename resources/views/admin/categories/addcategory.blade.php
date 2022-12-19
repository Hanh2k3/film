@extends('admin.layouts.master')
@section('content')
    <div class="col-md-12 g_container">
        <h2 class="g_title">THÊM DANH MỤC</h1>
        <form action="{{ route('admincategory.store') }}" method="post">
            @csrf
            <div class="form-group col-4">
                <label for="">Tên danh mục:</label>
                <input type="text" name="category_name" class="form-control mt-1" placeholder="Nhập tên danh mục">
            </div>
            <button type="submit" class="btn btn-info mt-3 mb-2">Thêm danh mục</button>
        </form>
    </div>
@endsection
