@extends('layouts.main_layout')

@section('title')
    Xem phim   
@endsection

@section('meta_tag')
    
@endsection

@section('link')
    <link rel="stylesheet" href="{{asset('clients/css/viewfilm.css')}}">
@endsection

@section('content')
    <div class="f_content">
        <div class="watch_film">
            <div class="intro_film">
                <a href="#" class="fw-700"><i class="ti-video-clapper"></i>Vạn Giới Tiên Trung</a>
                <div class="fw-700">
                    <span>Đang xem Tập ?</span>
                    <span>Đăng tải ? giờ trước</span>
                </div>
            </div>

            <div class="chap_film">
                <div class="episode">
                    <div class="episode_number">
                        Tập 1
                    </div>
                </div>
                <div class="info_error">
                    <a href="#"><i class="ti-info-alt fs-18"></i></a>
                    <a href="#" class="mg-r10"><i class="ti-alert fs-18"></i></a>
                </div>
            </div>

            <div class="content_film">

            </div>

            <div class="settings_film">
                <div class="settings_episode pd-7 bd-r-5 mg-r10">
                    <i class="ti-settings"></i>
                </div>
                <div class="next_film pd-7 bd-r-5">
                    <a href="#" class="pd-7">Tiếp<i class="ti-control-forward"></i></a>
                </div>
            </div>

            <div class="list_episode">
                <div class="heading">
                    <span class="fw-700">Danh sách tập</span>
                    <span class="fw-600">Lần trước xem<a href="#">Tập 1</a></span>
                </div>
                <div class="list_item_episode scroll-bar">
                    @for ($i = 1; $i < 501; $i++)
                        <a href="#"><span>1</span></a>
                    @endfor
                </div>
            </div>

            <div class="gd_comment">
                <div class="header_cm">
                    <div class="fw-700">
                        <i class="ti-comment-alt"></i>
                        Bình luận (0)
                    </div>
                    <div class="refresh_icon">
                        <i class="ti-reload fs-20"></i>
                    </div>
                </div>

                <div class="bt_login fw-600">
                    <a href="#">Đăng nhập để bình luận</a>
                </div>

                <div class="comment_message">
                    @for ($i = 0; $i <= 5; $i++)
                    <div class="item_comment">
                        <div class="user_comment">
                            <div class="left">
                                <div class="avatar">
                                    <img src="https://animehay.club/upload/poster/2451-1659688080.jpg" alt="">
                                </div>
                            </div>
                            <div class="right">
                                <div>
                                    <div class="nickname fw-700">
                                        Cu Tí
                                    </div>
                                    <div class="content_comment">
                                        Phim dở quá, ngừng phát sóng đi
                                    </div>
                                    <div class="cm_time">
                                        <div>0 giờ trước</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="bt_load_cm">
                    <a href="#" class="fw-600">Tải thêm bình luận</a>
                </div>
            </div>
        </div>
    </div>
@endsection