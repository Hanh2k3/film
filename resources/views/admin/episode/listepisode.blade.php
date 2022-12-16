@extends('admin.layouts.master')
@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-10">
            <h1>DANH SÁCH TẬP PHIM</h1>
        </div>
        <div class="col-md-2" style="text-align: right;">
            <a href="{{route('adminfilm.index')}}" class="btn btn-success">Trở Lại</a>
        </div>
    </div>
    <div class="row">
        @foreach ($fim as $value)
        <p style="font-size: 16px">Mã phim: <span class="text-dark text-capitalize" style="font-weight: 600">{{$value->film_id}}</span></p>
        <p style="font-size: 16px">Tên phim: <span class="text-dark text-capitalize" style="font-weight: 600">{{$value->film_name}}</span></p>
        <div class="col-md-4">
            <a href="{{route('admincreate_episode', $value->film_id)}}" class="btn btn-info">Thêm tập mới</a>
        </div>
        @endforeach
    </div>
    <div class="row mt-5">
        <h4>Danh sách</h4>
        <div class="col-md-12">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <th>Mã tập phim</th>
                    <th>Nguồn phim</th>
                    <th>Số tập</th>
                    <th>Hành động</th>
                </thead>
                <tbody>
                    @foreach ($episodes as $value)
                    <tr>
                        <td>{{$value->episode_id}}</td>
                        <td>{{$value->episode_link}}</td>
                        <td>{{$value->episode_number}}</td>
                        <td>
                            <a href="{{route('adminepisode.edit', $value->episode_id)}}" class="btn btn-warning btn-sm"><i class="ti-pencil-alt"></i></a>
                            <form class="d-inline-block" action="{{route('adminepisode.destroy', $value->episode_id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="ti-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection