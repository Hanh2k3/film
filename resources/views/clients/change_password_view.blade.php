@extends('layouts.main_layout')


@section('title')
    Forget Password 
@endsection

@section('meta_tag')
    
@endsection

@section('link')
    <link rel="stylesheet" href="{{asset('clients/css/home.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/login/login.css')}}">

@endsection

@section('content')
    <div class="margin-20">
        <div class="banner">
        <div>Lấy lại mật khẩu</div>
        </div>
    </div>

    <div class="movies-list margin-20 login">
        
       <div class="login-google mt-3">
         @if (session('change_password_success'))
            <div class="alert alert-success">{{session('change_password_success')}}</div>
            @php
                session() -> put('change_password_success', null); 
            @endphp
         @endif   
        
       </div>
       <form action="{{route('forget_password.change_password')}}" method="POST">
            @csrf 
            <div class="item">
                <input type="hidden" name="user_id" value ="{{$user_id}}">
                <label for="">Nhập mật khẩu mới</label>
                <input type="password" name="password" id="" placeholder="Nhập mật khẩu mới" value="{{old('password')}}">
                @error('password')
                    <p style="color:red;">{{$message}}</p>
                @enderror
            </div>

            <div class="item">
                <label for="">Nhập lại  mật khẩu</label>
                <input type="password" name="confirm_password" id="" placeholder="Nhập mật khẩu mới" value="{{old('confirm_password')}}">
                @error('confirm_password')
                    <p style="color:red;">{{$message}}</p>
                @enderror
            </div>
         
            <div class="button">
                <div class="btn-login">
                    <button>Thay đổi mật khẩu</button>
                </div>
            </div>
       </form>
    </div>


@endsection