@extends('admin.layouts.master')
@section('content')
<div class="col-md-12">
    <h1>SỬA TẬP PHIM</h1>
    <form action="{{route('adminepisode.update', $episode_get->episode_id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group col-4 mb-3">
            <label for="film_id">Mã phim:</label>
            <input type="text" name="film_id" class="form-control" readonly value="{{$episode_get->film_id}}">
        </div>
        <div class="form-group col-4 mb-3">
            <label for="episode_link">Nguồn phim:</label>
            <input type="text" name="episode_link" class="form-control" value="{{$episode_get->episode_link}}">
        </div>
        <div class="form-group col-4 mb-3">
            <label for="episode_number">Số tập:</label>
            <input type="text" name="episode_number" class="form-control" value="{{$episode_get->episode_number}}">
        </div>
        <button type="submit" class="btn btn-info mt-2">Lưu</button>
    </form>
</div>
@endsection