@extends('layouts.main_layout')

@section('title')
    Hồ sơ
@endsection

@section('meta_tag')
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('clients/css/profile.css') }}">
@endsection

@section('content')
    <div class="main-container">
        <div class="p-profile-title">
            <div>
                <i class="fa-regular fa-address-card"></i>
                <p>Hồ sơ cá nhân</p>
            </div>
        </div>

        <div class="p-profile-container">
            <div class="profile">
                <div class="profile-main">
                    <div class="profile-avt">
                        <img src="{{ !$user->provider ? '/uploads/avatar/' . $user->avt : $user->avt }}" alt="">
                        <form action="{{ route('profile.update_avatar') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="old_avatar" value="{{ $user->avt }}">
                            <input type="file" name="new_avatar" value="">
                            <button>Cập nhật</button>
                        </form>
                        <button class="profile-avt-btnsubmit" onclick="">Đổi ảnh</button>
                    </div>
                    <form class="profile-infor" action="{{ route('profile.update_user') }}" method="post">
                        @csrf
                        <div class="profile-infor-name">
                            <label for="user_name">Tên người dùng:</label>
                            <input type="text" name="user_name" value="{{ $user->user_name }}">
                        </div>
                        <div class="profile-infor-email">
                            <label for="user_name">Email:</label>
                            <input type="email" name="user_email" value="{{ $user->user_email }}">
                        </div>
                        <div class="profile-infor-created">
                            <label for="created_at">Ngày tham gia:</label>
                            <input type="datetime-local" name="user_name" value="{{ $user->created_at }}" disabled>
                        </div>
                        <button></button>
                    </form>
                    <div class="profile-infor-btnedit profile-infor-btn">Chỉnh sửa</div>
                    <div class="profile-infor-btngroup">
                        <div class="profile-infor-btnsave profile-infor-btn">Lưu</div>
                        <div class="profile-infor-btncancel profile-infor-btn">Hủy</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script-tag')
    <script>
        $(".profile-avt-btnsubmit").click(() => {
            $('.profile-avt form input').click();
            let myInterval = setInterval(() => {
                $('.profile-avt form input').change((e) => {
                    clearInterval(myInterval);
                    $('.profile-avt form button').click();
                })
            }, 1000);
        });

        $(".profile-infor-btnedit").click(() => {
            $('.profile-infor-name input, .profile-infor-email input').css({
                'pointer-events': 'all',
                'border-color': 'rgb(233, 190, 0)'
            });
            $(".profile-infor-btnedit").css('display', 'none');
            $(".profile-infor-btngroup").css('display', 'flex');
        });
        $(".profile-infor-btncancel").click(() => {
            location.reload();
        });
        $(".profile-infor-btnsave").click(() => {
            $(".profile-infor button").click();
        });
    </script>
@endsection
