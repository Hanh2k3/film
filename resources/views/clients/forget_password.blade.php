@extends('layouts.main_layout')


@section('title')
    Forget Password
@endsection

@section('meta_tag')
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('clients/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/login/login.css') }}">
@endsection

@section('content')
    <div class="margin-20">
        <div class="banner">
            <div>Lấy lại mật khẩu</div>
        </div>
    </div>

    <div class="movies-list margin-20 login">

        <div class="login-google mt-3">
            @if (session('send_mail_success'))
                <div class="alert alert-success">{{ session('send_mail_success') }}</div>
                @php
                    session()->put('send_mail_success', null);
                @endphp
            @endif

        </div>
        <form action="{{ route('forget_password.') }}" method="POST">
            @csrf
            <div class="item">
                <label for="">Email</label>
                <input type="text" name="email" id="" placeholder="Nhập email của bạn"
                    value="{{ old('email') }}">
                @error('email')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="button">
                <div class="btn-login">
                    <button>Tìm lại mật khẩu</button>
                </div>
            </div>
        </form>
    </div>
@endsection
