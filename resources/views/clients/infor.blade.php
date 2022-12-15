@extends('layouts.main_layout')

@section('meta_tag')
@endsection

{{-- Put data here --}}
@section('title')
    {{ 'Tên film' }}
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('clients/css/infor/top-content/name-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/top-content/main-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/bottom-content/episode-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/bottom-content/comment-film.css') }}">
@endsection

@section('content')
    <form action="">
        <div class="form-evaluate un_active" id="form_evaluate1">
            <div class="head-evaluate">
                <span>Đánh giá phim</span>
                <button id="exits" onclick="exits_form_evaluate();"><i class="ti-close"></i></button>
            </div>
            <div class="start">
                <i class="ti-star star-active" onclick="alert('test');"></i>
                <i class="ti-star" id="rate-2"></i>
                <i class="ti-star"></i>
                <i class="ti-star"></i>
                <i class="ti-star"></i>
                <i class="ti-star"></i>
                <i class="ti-star"></i>
                <i class="ti-star"></i>
                <i class="ti-star"></i>
                <i class="ti-star"></i>
            </div>
        </div>
    </form>
    <div class="top_content">
        <div class="name_film">
            {{-- Put data here --}}
            <p><i class="ti-video-clapper"> </i> Thôn Phệ Tinh Không</p>
        </div>
        <div class="main_film">
            <div class="poster_film" id="poster_film">
                <div class="poster" id="poster_id">
                    <img src="{{ $film->img }}" alt="">
                    <div>
                        <div class="button_box">
                            <a class="btn_watch" href="{{ route('viewPage.', ['film_id' => $id, 'episode_id' => 1]) }}">Xem
                                phim</a>
                            <form action="{{ route('store.insert') }}" method="post">
                                @csrf
                                <input type="hidden" name="film_id" value="{{ $film->film_id }}">
                                <button id="infor-btn-submit"></button>
                            </form>
                            @if (checkFollowedFilm($film->film_id))
                                <form action="{{ route('infor.unfollow', ['film_id' => $film->film_id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button id="infor-btn-unfollow"></button>
                                </form>
                                <a class="btn_remember" href="#" onclick="$('#infor-btn-unfollow').click()">Bỏ lưu</a>
                            @else
                                <a class="btn_remember" href="#" onclick="$('#infor-btn-submit').click()">Lưu phim</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="rate" style="color: white">
                    {{-- Put data here --}}
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </div>
            </div>
            <div class="detail_film">
                <div class="detail">
                    <div class="detail_list" id="detail_list">
                        <table class="detail_content">
                            @foreach ($list_episodes as $row)
                                <tr class="table_row">
                                    {{-- Put data here --}}
                                    <th>Trạng thái:</th>
                                    <td>Full 12/12 tập</td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="detail_content content_film">
                            <h5>Nội dung:</h5>
                            {{-- Put data here --}}
                            <p>{{ $film->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="detail_btn">
                    <div>
                        <button id="btn_detail_film" onclick="handleDetailFilm()"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_content">
        <div class="episode_film">
            <div class="episode_title">Tập phim</div>
            <div class="episode_container">
                <div>
                    {{-- Put data here --}}
                    @foreach ($list_episodes as $episode)
                        <a
                            href="{{ route('viewPage.', ['film_id' => $id, 'episode_id' => $episode->episode_number]) }}">{{ $episode->episode_number }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="comment_film">
            @if (session('user_id'))
                <div class="comment_head border-none">
                    {{-- Put data here --}}
                    <button id="btn_evaluate" onclick="display_form_evaluate();">Đánh giá</button>
                </div>
            @endif

            <div class="comment_head">
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
            <div class="comment_container">
                @if (session('user_id'))
                    <form action="{{ '#' }}">
                        <input type="text" name="your_comment" placeholder="Nhập bình luận">
                        <div><input type="submit" value="Bình luận"></div>
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
                                <a href="#">AVT</a>
                            </div>
                            <div>
                                <div class="c_comment_body">
                                    <a class="c_comment_user" href="#">{{ 'Name of User' }}</a>
                                    <p class="c_comment_content">{{ 'This is a test comment' }}</p>
                                    <p class="c_comment_time">{{ 'comment time' }}</p>
                                </div>
                                <div class="c_comment_tail">
                                    {{-- Continue --}}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script src="{{ asset('clients/js/font-awesome.js') }}"></script>
    <script src="{{ asset('clients/js/infor.js') }}"></script>
@endsection
