@extends('layouts.main_layout')


@section('title')
    Login   
@endsection

@section('meta_tag')
    
@endsection

@section('link')
    <link rel="stylesheet" href="{{asset('clients/css/home.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/login/login.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/login/register.css')}}">

@endsection

@section('content')
    <div class="margin-20">
        <div class="banner">
        <div>Đăng ký</div>
        </div>
    </div>

    <div class="movies-list margin-20 login">
        
       <form action="">
        <div class="item">
            <label for="">Tên của bạn</label>
            <input type="text" name="user_name" id="" placeholder="Nhập họ tên của bạn">
        </div>
            <div class="item">
                <label for="">Email</label>
                <input type="text" name="email" id="" placeholder="Nhập email của bạn">
            </div>

            <div class="item">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" id="" placeholder="Nhập mật khẩu của bạn">
            </div>

            <div class="item">
                <label for="">Nhập lại mật khẩu</label>
                <input type="password" name="confirm_password" id="" placeholder="Nhập lại mật khẩu của bạn">
            </div>
            <div class="item">
                <label for="" style="color: yellow; font-weight: bold; padding:6px 10px 6px 20px; background-color: black; display: inline-block;">QCKHZXP</label>
                <input type="text" name="code_id" id="" placeholder="Nhập mã xác minh">
            </div>

            <div class="button">
                <div class="btn-login">
                    <button style="background-color:#37869e;">Đăng ký</button>
                </div>
                <div style="color: #ccc;" id="forget-password">
                    Bạn đã có tài khoản?<a href="{{route('login.')}}">Đăng nhập</a>
                </div>

            </div>
       </form>

    </div>


@endsection