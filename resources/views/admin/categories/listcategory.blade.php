@extends('admin.layouts.master')
@section('content')
<div class="col-md-12">
    <h1>DANH SÁCH DANH MỤC</h1>
    <table class="table table-bordered table-hover">
        <thead class="table-success">
            <th>STT</th>
            <th>Mã danh mục</th>
            <th>Tên danh mục</th>
            <th>Hoạt động</th>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($categories as $value)
            <tr>
                <td>
                    {{ $i+=1 }}
                </td>
                <td>{{ $value->category_id }}</td>
                <td>{{ $value->category_name }}</td>
                <td>
                    <a href="#" class="btn btn-warning">Sửa</a>
                    <a href="#" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection