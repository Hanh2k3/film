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
            <a href="{{route('login.login_google')}}"><img src="{{asset('clients/images/logo/google-signin-button.png')}}" alt="Đăng nhập với google"></a>
       </div>
       <div class="login-google mt-3">
         @if (session('register_success'))
            <div class="alert alert-success">{{session('register_success')}}</div>
            @php
                session() -> put('register_success', null); 
            @endphp
  
         @endif   

         @if (session('change_password_success'))
            <div class="alert alert-success">{{session('change_password_success')}}</div>
         @php
             session() -> put('change_password_success', null); 
         @endphp

        @endif  

        @if (session('erorr_login'))
        <div class="alert alert-danger">{{session('erorr_login')}}</div>
        @php
            session() -> put('erorr_login', null); 
        @endphp

        @endif   
        
       </div>
       <form action="{{route('login.check_login')}}" method="POST">
            @csrf 
            <div class="item">
                <label for="">Email</label>
                <input type="text" name="email" id="" placeholder="Nhập email của bạn">
                @error('email')
                    <p style="color:red;">{{$message}}</p>
                @enderror
            </div>

            <div class="item">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" id="" placeholder="Nhập mật khẩu của bạn">
                @error('password')
                    <p style="color:red;">{{$message}}</p>
                @enderror
            </div>
            <div class="button">
                <div class="btn-login">
                    <button>Đăng nhập</button>
                    <a href="{{route('forget_password.')}}">Quên mật khẩu</a>
                    
                </div>
                <div class="btn-register">
                    <a href="{{route('register.')}}">Đăng ký</a>
                </div>

            </div>
       </form>

    </div>


@endsection