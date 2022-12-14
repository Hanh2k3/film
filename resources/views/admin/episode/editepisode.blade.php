@extends('admin.layouts.master')
@section('content')
    <div class="col-md-12 g_container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="g_title">SỬA TẬP PHIM</h1>
            </div>
            <div class="col-md-2" style="text-align: right;">
                <a href="{{ route('adminepisode.show', $episode_get->film_id) }}" class="btn btn-success">Trở Lại</a>
            </div>
        </div>
        <form action="{{ route('adminepisode.update', $episode_get->episode_id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group col-4 mb-3">
                <label for="film_id">Mã phim:</label>
                <input type="text" name="film_id" class="form-control" readonly value="{{ $episode_get->film_id }}">
            </div>
            <div class="form-group col-4 mb-3">
                <label for="episode_link">Nguồn phim:</label>
                <input type="text" name="episode_link" class="form-control" value="{{ $episode_get->episode_link }}">
            </div>
            <div class="form-group col-4 mb-3">
                <label for="episode_number">Số tập:</label>
                <input type="text" name="episode_number" class="form-control" value="{{ $episode_get->episode_number }}">
            </div>
            <button type="submit" class="btn btn-info mt-2">Lưu</button>
        </form>
    </div>
@endsection
