@extends('admin.layouts.master')
@section('content')
<div class="col-md-12">
    <h1>THÊM PHIM MỚI</h1>
    <form action="" method="post">
        <div class="form-group col-4 mb-3">
            <label for="">Tên phim:</label>
            <input type="text" name="category_name" class="form-control">
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
            <label for="">Số lượng tập:</label>
            <input type="text" name="category_name" class="form-control">
        </div>
        <div class="form-group col-4 mb-3">
            <label for="">Ngày phát sóng:</label>
            <input type="text" name="category_name" class="form-control">
        </div>
        <button type="submit" class="btn btn-info mt-2">Thêm phim</button>
    </form>
</div>
@endsection