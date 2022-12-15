@extends('admin.layouts.master')
@section('content')
<div class="col-md-12">
    <h1>SỬA THÔNG TIN PHIM</h1>
    <form action="{{route('adminfilm.update', $getfilm->film_id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group col-4 mb-3">
            <label for="category_film">Danh mục phim:</label>
            <select name="category_film" class="form-control">
                @foreach ($category_film as $key)
                    <option @if ($getfilm->category_id == $key->category_id)
                        {{"selected"}}
                    @endif value="{{$key->category_id}}">{{$key->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-4 mb-3">
            <label for="film_name">Tên phim:</label>
            <input type="text" name="film_name" class="form-control" placeholder="Nhập tên phim" value="{{$getfilm->film_name}}">
        </div>
        <div class="form-group col-8 mb-3">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="editor1" cols="30" rows="10" aria-valuetext="{{$getfilm->description}}"></textarea>
        </div>
        <div class="form-group col-3 mb-3">
            <label for="img">Ảnh:</label>
            @if (isset($getfilm))
                <img src="{{asset('uploads/avatar_film/' . $getfilm->img)}}" alt="" style="display: block; margin: 10px 0px;">
            @endif
            <input type="file" name="img" class="form-control">
        </div>
        <div class="form-group col-4 mb-3">
            <label for="episodes_quantity">Số lượng tập:</label>
            <input type="text" name="episodes_quantity" class="form-control" value="{{$getfilm->episodes_quantity}}">
        </div>
        <div class="form-group col-4 mb-3">
            <label for="release_date">Ngày phát sóng:</label>
            <input type="date" name="release_date" class="form-control" value="{{$getfilm->release_date}}">
        </div>
        <button type="submit" class="btn btn-info mt-2">Lưu</button>
    </form>
</div>
@endsection