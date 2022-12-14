@extends('layouts.main_layout')

@section('title')
    Xem phim   
@endsection

@section('meta_tag')
    
@endsection

@section('link')
    <link rel="stylesheet" href="{{asset('clients/css/viewfilm.css')}}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/bottom-content/episode-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/bottom-content/comment-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/switalert.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/top-content/name-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/top-content/main-film.css') }}">
@endsection

@section('content')
    <div class="f_content">
        <div class="watch_film">
            <div class="intro_film">
                <a href="#" class="fw-700"><i class="ti-video-clapper"></i>{{$film[0]->film_name}}</a>
                <div class="fw-700">
                    <span>Đang xem Tập {{ $episode }}</span>
                    <span>Đăng tải ? giờ trước</span>
                </div>
            </div>

            <div class="chap_film">
                <div class="episode">
                    <div class="episode_number">
                        Tập {{$episode}}
                    </div>
                </div>
                <div class="info_error">
                    <a href="#"><i class="ti-info-alt fs-18"></i></a>
                    <a href="#" class="mg-r10"><i class="ti-alert fs-18"></i></a>
                </div>
            </div>

            <div class="content_film">

                <iframe src="{{$item->episode_link}}" style="width: 100%; height: 100%;" frameborder="0" allowFullScreen="true"></iframe>


            </div>

            <div class="settings_film">
                <div class="settings_episode pd-7 bd-r-5 mg-r10">
                    <i class="ti-settings"></i>
                </div>
                <div class="next_film pd-7 bd-r-5">
                    <a href="{{route('viewPage.', ['film_id' => $film[0]->film_id, 'episode_id' => $episode + 1])}}" class="pd-7">Tiếp<i class="ti-control-forward"></i></a>
                </div>
            </div>

            <div class="list_episode">
                <div class="heading">
                    <span class="fw-700">Danh sách tập</span>
                    <span class="fw-600">Lần trước xem<a href="#">Tập 1</a></span>
                </div>
                <div class="list_item_episode scroll-bar">
                    @foreach ($list_episodes as $item )
                        @if ($item-> episode_number == $episode)
                            <a href="{{route('viewPage.', ['film_id' => $film[0]->film_id, 'episode_id' => $item->episode_number])}}" class="active"><span>{{$item-> episode_number}}</span></a>
                            @continue
                        @endif
                        <a href="{{route('viewPage.', ['film_id' => $film[0]->film_id, 'episode_id' => $item->episode_number])}}"><span>{{$item-> episode_number}}</span></a>
                    @endforeach
                </div>
            </div>

            <div class="gd_comment">
                <div class="comment_film" style="background: none;">
                    <div class="comment_head" style="width: 100%;">
                        {{-- Put data here --}}
                        <p class="comment_title">Bình luận ({{ '123' }})</p>
                        <div class="comment_nav">
                            {{-- Put data here --}}
                            <select name="" id="">
                                <option value=""><a href="#">Mặc định</a></option>
                                <option value=""><a href="#">Mới nhất</a></option>
                                <option value=""><a href="#">Cũ nhất</a></option>
                            </select>
                        </div>
                    </div>
                    <div class="comment_container" style="width: 100%;">
                        @if (session('user_id'))
                        <form action="{{ '#' }}">
                            <textarea name="comment" id="comment" class="cmt_1" cols="10" rows="5"></textarea>
                            <div class="div_comment">
                                <i class="first-btn ti-comments-smiley"></i>
                                <input type="submit" value="Bình luận" id="btn_cmt">
                            </div>
                        </form>
                        @else
                            <div class="login-comment">
                                <a href="{{ route('login.index') }}">Đăng nhập để bình luận</a>
                            </div>
                        @endif
                       
                        <ul class="comment_list">
                            {{-- Put data here --}}
                            @foreach ($list_episodes as $comment)
                                <li>
                                    <div class="c_comment_head">
                                        <a href="#"><img src="https://scontent.fdad1-3.fna.fbcdn.net/v/t39.30808-6/312806537_658556435769267_2568947083291964863_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=e3f864&_nc_ohc=BceEm5ZU8zkAX_SgCHb&_nc_ht=scontent.fdad1-3.fna&oh=00_AfCvrLJUWkIg6gm29_1IuvmlwWHoo-dxWtrPiayn-AdI3g&oe=639EA5F1" alt=""></a>
                                    </div>
                                    <div>
                                        <div class="c_comment_body">
                                            <a class="c_comment_user" href="#">{{ 'Name of User' }}</a>
                                            <p class="c_comment_content">{{ 'This is a test comment' }}</p>
                                            <div>
                                                <p><a href="">Trả lời</a></p>
                                                <p class="c_comment_time">{{ 'comment time' }}</p>
                                            </div>
                                        </div>
                                        <div class="c_comment_tail">
                                            {{-- Continue --}}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                         <div class="bt_load_cm">
                                <a href="#" class="fw-600">Tải thêm bình luận</a>
                        </div>
                    </div>
                    
                </div>
        </div>
    </div>

 


    <script src="{{ asset('clients/js/vanillaEmojiPicker.js') }}"></script>
    <script src="{{ asset('clients/js/switalert.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('clients/js/vanillaEmojiPicker.js') }}"></script>
    <script>
            
        new EmojiPicker({
            trigger: [
                {
                    selector: '.first-btn',
                    insertInto: ['#comment'] // '.selector' can be used without array
                },
                {
                    selector: '.second-btn',
                    insertInto: '.two'
                }
            ],
            closeButton: true,
            //specialButtons: green
        });
        $(document).ready(function () {
            $('#btn_cmt').click(function () {
                event.preventDefault();
                let comment = document.getElementById('comment').value;
                if (comment.length == 0) {
                    alert('Vui lòng nhập bình luận'); 
                    return ; 
                }
                alert(true); 
            })
        
        });
    </script> 
 
@endsection

