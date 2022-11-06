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

@endsection

@section('content')
    <div class="margin-20">
        <div class="banner">
        <div>Đăng nhập thành viên</div>
        </div>
    </div>

    <div class="movies-list margin-20 login">
        
       <div class="login-google">
            <a href=""><img src="{{asset('clients/images/logo/google-signin-button.png')}}" alt="Đăng nhập với google"></a>

       </div>
       <form action="">
            <div class="item">
                <label for="">Email</label>
                <input type="text" name="email" id="" placeholder="Nhập email của bạn">
            </div>

            <div class="item">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" id="" placeholder="Nhập mật khẩu của bạn">
            </div>
            <div class="button">
                <div class="btn-login">
                    <button>Đăng nhập</button>
                    <a href="">Quên mật khẩu</a>
                    
                </div>
                <div class="btn-register">
                    <a href="{{route('register.')}}">Đăng ký</a>
                </div>

            </div>
       </form>

    </div>


@endsection