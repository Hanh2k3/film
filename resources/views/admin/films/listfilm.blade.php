@extends('admin.layouts.master')
@section('content')
<div class="col-md-12">
    <h1>DANH SÁCH PHIM</h1>
    <table class="table table-bordered table-hover">
        <thead class="table-success">
            {{-- <th>STT</th> --}}
            <th>Mã phim</th>
            <th>Tên phim</th>
            <th style="width: 200px;">Mô tả</th>
            <th style="width: 200px;">Ảnh</th>
            <th>Thời lượng</th>
            <th>Ngày phát sóng</th>
            <th>Hành động</th>
        </thead>
        <tbody>
            @php
                // $i = 0;
            @endphp
            @foreach ($films as $value)
            <tr>
                {{-- <td>
                    {{ $i+=1 }}
                </td> --}}
                <td style="text-align: center">{{$value->film_id}}</td>
                <td>{{$value->film_name}}</td>
                <td>{{$value->description}}</td>
                <td>
                    <img src="{{asset('uploads/avatar_film/' . $value->img)}}" style="width: 60%;">
                </td>
                <td style="text-align: center">{{$value->episodes_quantity}}</td>
                <td>{{$value->release_date}}</td>
                <td>
                    <a href="{{route('adminfilm.edit', $value->film_id)}}" class="btn btn-warning btn-sm"><i class="ti-pencil-alt"></i></a>
                    <form class="d-inline-block" enctype="multipart/form-data" action="{{route('adminfilm.destroy', $value->film_id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="ti-trash"></i></button>
                   </form>
                   <a href="" class="btn btn-secondary btn-sm"><i class="ti-settings"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection