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
            <i class="ti-star star-evaluate star-active" id="rate-1" data-id="1"></i>
            <i class="ti-star star-evaluate" id="rate-2" data-id="2"></i>
            <i class="ti-star star-evaluate" id="rate-3" data-id="3"></i>
            <i class="ti-star star-evaluate" id="rate-4" data-id="4"></i>
            <i class="ti-star star-evaluate" id="rate-5" data-id="5"></i>
            <i class="ti-star star-evaluate" id="rate-6" data-id="6"></i>
            <i class="ti-star star-evaluate" id="rate-7" data-id="7"></i>
            <i class="ti-star star-evaluate" id="rate-8" data-id="8"></i>
            <i class="ti-star star-evaluate" id="rate-9" data-id="9"></i>
            <i class="ti-star star-evaluate" id="rate-10"  data-id="10"></i>
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
                    <img src="{{asset('uploads/img_film/test.jpg')}}" alt="">
                    <div>
                        <div class="button_box">
                            <a class="btn_watch" href="{{route('viewPage.', ['film_id' => $id, 'episode_id' => 1 ])}}">Xem phim</a>
                            <a class="btn_remember" href="{{ '#' }}">Lưu phim</a>
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
                           @foreach ($film as $item )
                                {{ $item->description }}                               
                           @endforeach
                                    
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
                        <a href="{{route('viewPage.', ['film_id' => $id, 'episode_id' => $episode->episode_number])}}">{{ $episode->episode_number }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="comment_film">
            @if(session('user_id'))
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
                        <a href="{{route('login.index')}}">Đăng nhập để bình luận</a>
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.star-evaluate').click(function () {  
                event.preventDefault();
                var t  = $(this).data('id');
                var user_id = "{{session('user_id')}}"; 
                var film_id = "{{$id}}"; 
    
                $.get(
                    "{{route('evaluate')}}", 
                    {
                        user_id : user_id,
                        film_id : film_id,
                        evaluate_value: t
                    }, 
                    function (data) {
                        alert(data); 
                     
                        for(var i=1; i<=t; i++) {
                            console.log(i); 
                        }
                    }
                ) 
               
                //swal("Good job!", "You clicked the button!", "success");
            }) 
    
           
        });
    </script>


    <script src="{{ asset('clients/js/font-awesome.js') }}"></script>
    <script src="{{ asset('clients/js/infor.js') }}"></script>
@endsection
