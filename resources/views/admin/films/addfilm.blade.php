@extends('admin.layouts.master')
@section('content')
<div class="col-md-12">
    <h1>THÊM PHIM MỚI</h1>
    <form action="{{route('adminfilm.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group col-4 mb-3">
            <label for="category_film">Danh mục phim:</label>
            <select name="category_film" class="form-control">
                @foreach ($category_film as $danhmuc)
                    <option value="{{ $danhmuc->category_id }}">
                        {{ $danhmuc->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-4 mb-3">
            <label for="film_name">Tên phim:</label>
            <input type="text" name="film_name" class="form-control" placeholder="Nhập tên phim">
        </div>
        <div class="form-group col-8 mb-3">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="editor1" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group col-3 mb-3">
            <label for="img">Ảnh:</label>
            <input type="file" name="img" class="form-control">
        </div>
        <div class="form-group col-4 mb-3">
            <label for="episodes_quantity">Số lượng tập:</label>
            <input type="text" name="episodes_quantity" class="form-control">
        </div>
        <div class="form-group col-4 mb-3">
            <label for="release_date">Ngày phát sóng:</label>
            <input type="date" name="release_date" class="form-control">
        </div>
        <button type="submit" class="btn btn-info mt-2">Thêm phim</button>
    </form>
</div>
@endsection