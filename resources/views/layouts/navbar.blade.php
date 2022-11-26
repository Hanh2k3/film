
<div class="logo">
  <img src="https://animehay.club/themes/img/logo.png"  style="width:347px; height:65px;"alt="logo thuong hieu">
</div>
<div class="search-bar">
    <form action="" class="">
        <input type="text" name="" id="" class="" placeholder="Search...">
        <button><i class="ti-search"></i></button>
    </form>
</div>
<div class="icon">
    <a href="#" onclick="toggle()" class="" id="bu" ><i class="ti-menu"></i></a>
    <a href=""><i class="ti-bookmark-alt"></i></a>
    @if(session('user_id'))
        <a href="#" onclick="display_account()" id="display_account"><i class="ti-user"></i></a>
        <a href="#" onclick="hide_account()"  style="display:none:" id="hide_account"><i class="ti-layout-placeholder"></i></a>
        @php
            $user_name = session('user_name'); 
            $user_avatar = session('user_avatar');
        @endphp
    @else 
        <a href="{{route('login.index')}}"><i class="ti-shift-right"></i></a>
    @endif
</div>

@if (session('user_id'))
<div class="infor-account un_active" id="account">
    <div class="avatar">

        @if (session('google'))
            <img src="{{$user_avatar}}" alt="Images avatar of user">
        @else 
            <img src="{{asset("uploads/avatar/$user_avatar")}}" alt="Images avatar of user">
        @endif
        <div>{{$user_name}}</div>
    </div>
    <a href="">Thông tin tài khoản</a>
    <a href="{{route('logout')}}">Đăng xuất</a>
    
</div>
@endif





