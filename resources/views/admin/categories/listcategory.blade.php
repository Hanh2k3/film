@extends('admin.layouts.master')
@section('content')
<div class="col-md-12">
    <h1>DANH SÁCH DANH MỤC</h1>
    <table class="table table-bordered table-hover">
        <thead class="table-success">
            <th>STT</th>
            <th>Mã danh mục</th>
            <th>Tên danh mục</th>
            <th>Hành động</th>
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
                    <a href="{{route('admincategory.edit', $value->category_id)}}" class="btn btn-warning"><i class="ti-pencil-alt"></i></a>
                    <form class="d-inline-block" action="{{route('admincategory.destroy', $value->category_id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="ti-trash"></i></button>
                   </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection