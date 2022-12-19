@extends('admin.layouts.master')
@section('content')
    <div class="col-md-12 g_container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="g_title">THÊM TẬP PHIM</h1>
            </div>
            <div class="col-md-2" style="text-align: right;">
                <a href="{{ route('adminepisode.show', $getfull->film_id) }}" class="btn btn-success">Trở Lại</a>
            </div>
        </div>
        <form action="{{ route('adminepisode.store') }}" method="post">
            @csrf
            <div class="form-group col-4 mb-3">
                <label for="film_id">Mã phim:</label>
                <input type="text" name="film_id" class="form-control" readonly value="{{ $getfull->film_id }}">
            </div>
            <div class="form-group col-4 mb-3">
                <label for="">Tên phim:</label>
                <input type="text" class="form-control" disabled value="{{ $getfull->film_name }}">
            </div>
            <div class="form-group col-4 mb-3">
                <label for="episode_link">Nguồn phim:</label>
                <input type="text" name="episode_link" class="form-control" placeholder="Nhập nguồn phim">
            </div>
            <div class="form-group col-4 mb-3">
                <label for="episode_number">Số tập:</label>
                <input type="text" name="episode_number" class="form-control" placeholder="Nhập số tập">
            </div>
            <button type="submit" class="btn btn-info mt-2">Thêm tập phim</button>
        </form>
    </div>
@endsection
