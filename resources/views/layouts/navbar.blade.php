
<div class="logo">
    <a href="{{route('home.')}}" class="g_logo">
        <img src="{{asset('uploads/logo/logo.png')}}" alt="logo thuong hieu">
    </a>
</div>
<div>
    <div class="icon">
        <a href="#" onclick="toggle()" class="g_nav_btn p-lg-4 p-md-3 p-sm-2" id="bu" ><i class="ti-menu"></i></a>
        <a href="{{ route('store.index') }}" class="g_nav_btn p-lg-4 p-md-3 p-sm-2"><i class="ti-bookmark-alt"></i></a>
        @if(session('user_id'))
            <a class="g_nav_btn p-lg-4 p-md-3 p-sm-2" href="#" onclick="display_account()" id="display_account"><i class="ti-user"></i></a>
            <a class="g_nav_btn p-lg-4 p-md-3 p-sm-2" href="#" onclick="hide_account()"  style="display:none:" id="hide_account"><i class="ti-layout-placeholder"></i></a>
            @php
                $user_name = session('user_name'); 
                $user_avatar = session('user_avatar');
            @endphp
        @else 
            <a class="g_nav_btn p-lg-4 p-md-3 p-sm-2" href="{{route('login.index')}}"><i class="ti-shift-right"></i></a>
        @endif
    </div>
    @if (session('user_id'))
    <div class="infor-account un_active" id="account">
        <div class="avatar">

            @if (session('google'))
                <img src="{{ $user_avatar }}" alt="Images avatar of user">
            @else 
                <img src="{{ asset("uploads/avatar/$user_avatar") }}" alt="Images avatar of user">
            @endif
            <div>{{$user_name}}</div>
        </div>
        <a href="{{ route('profile.index') }}">Thông tin tài khoản</a>
        @if (session('type_user') == 'admin')
            <a href="{{route('adminindex')}}">Trang quản trị</a>
        @endif
        <a href="{{route('logout')}}">Đăng xuất</a>
    </div>
    @endif
</div>






