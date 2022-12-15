@extends('layouts.main_layout')

@section('meta_tag')
@endsection

{{-- Put data here --}}
@section('title')
@foreach ($film as $item )
@php
    $name_film = $item->film_name; 
    $description = $item->description;
@endphp   

@endforeach
    {{ $name_film = $item->film_name }}
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('clients/css/infor/top-content/name-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/top-content/main-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/bottom-content/episode-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/bottom-content/comment-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/switalert.css') }}">

@endsection

@section('content')

     <form action="">
    <div class="form-evaluate un_active" id="form_evaluate1">
        <div class="head-evaluate">
            <span>Đánh giá phim</span>
            <button id="exits" onclick="exits_form_evaluate();"><i class="ti-close"> </i> </button>
        </div>
        <div class="start">
            <i class="ti-star star-evaluate" id="rate-1" data-id="1"></i>
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
           <p><i class="ti-video-clapper"> </i> {{ $name_film }}</p>
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
                    <i class="fa-regular fa-star" id="score-1"></i>
                    <i class="fa-regular fa-star" id="score-2"></i>
                    <i class="fa-regular fa-star" id="score-3"></i>
                    <i class="fa-regular fa-star" id="score-4"></i>
                    <i class="fa-regular fa-star" id="score-5"></i>
                    <i class="fa-regular fa-star" id="score-6"></i>
                    <i class="fa-regular fa-star" id="score-7"></i>
                    <i class="fa-regular fa-star" id="score-8"></i>
                    <i class="fa-regular fa-star" id="score-9"></i>
                    <i class="fa-regular fa-star" id="score-10"></i>
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
                            {{ $description }}
                                    
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
                <form action="#" method="GET">
            
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
                    @foreach ($list_cmt as $comment)
                        <li>
                            <div class="parent_comment">
                                <div class="c_comment_head">

                                    <a href="#">
                                        @if ($comment->provider)
                                            <img src="{{ $comment->avt }}" alt="">
                                        @else
                                            <img src="{{ asset("uploads/avatar/$comment->avt") }}" alt="Images avatar of user">
                                        @endif
                                       
                                    </a>
                                </div>
                                <div>
                                    <div class="c_comment_body">
                                        <a class="c_comment_user" href="#">{{ $comment->user_name }}</a>
                                        <p class="c_comment_content">{{ $comment-> comment_content }}</p>
                                        <div>
                                            <p><a href="">Trả lời</a></p>
                                            <p class="c_comment_time">{{ $comment-> created_at }}</p>
                                        </div>
                                    
                                    </div>
                               
                                </div>
                            </div>

                            @if ($comment->sub_cmt)
                                @foreach ($comment->sub_cmt as $sub)
                                    <div class="div_b">
                                        <div class="sub_cmt">
                                            <div class="c_comment_head">
                                                <a href="#">
                                                    @if ($sub->provider)
                                                        <img src="{{ $sub->avt }}" alt="">
                                                    @else
                                                        <img src="{{ asset("uploads/avatar/$sub->avt") }}" alt="Images avatar of user">
                                                    @endif
                                                </a>
                                            </div>
                                            <div>
                                                <div class="c_comment_body">
                                                    <a class="c_comment_user" href="#">{{ $sub-> user_name }}</a>
                                                    <p class="c_comment_content">{{$sub-> comment_content }}</p>
                                                    <div>
                                                        <p class="c_comment_time">{{ $sub->created_at }}</p>
                                                    </div>
                                                
                                                </div>
                                             
                                            </div>
                                        </div>
                                    </div>  
                                @endforeach                              
                            @endif
                          <form action="#" method="GET">
            
                                <textarea name="comment" id="comment" class="cmt_1" cols="10" rows="5"></textarea>
                                <div class="div_comment">
                                    <i class="first-btn ti-comments-smiley"></i>
                                    <input type="submit" value="Bình luận" id="btn_cmt">
                                </div>
                            </form>  
                        </li>
                    @endforeach
                </ul>
                <div class="bt_load_cm">
                    <a href="#" class="fw-600">Tải thêm bình luận</a>
                </div>
            </div>
        </div>
    </div>

    

    <script src="{{ asset('clients/js/switalert.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>    
        var num_star = "{{ $num_star }}"; 
        function add_start_active(a) {
            for(var i=1; i<=a; i++) {
                let star_id = "rate-" + i ; 
                document.getElementById(star_id).classList.add("star-active"); 
            }
            
        }
        add_start_active(num_star); 
        // score 
        var score = "{{ $score }}";
        function display_score(a) {
            a = Math.round(a); 
            for(var i=1; i<=a; i++) {
                let star_id = "score-" + i ;
                document.getElementById(star_id).classList.remove("fa-regular"); 
                document.getElementById(star_id).classList.add("fa-solid"); 
            }
        }
        display_score(score); 

        // display icon comment boxes 
       

        
      $(document).ready(function () {
           $('#btn_cmt').click(function () {
                event.preventDefault();
                let comment = document.getElementById('comment').value;
                
                
                if (comment.length == 0) {
                    alert('Vui lòng nhập bình luận'); 
                    return ; 
                }
                var _token = $('input[name=_token]').val();   
                var film_id =    "{{ $id }}"; 
                $.get(
                    '{{route('save_comment')}}',
                    {
                        comment: comment,
                        film_id: film_id                      
                    },
                    function(data) {
                        $('#comment').val('');  
                        $('.comment_list').html(data); 
                    }
                )      
            })  
          
            $('.star-evaluate').click(function () {  
                event.preventDefault();
                var t  = $(this).data('id');
                var user_id = "{{ session('user_id') }}"; 
                var film_id = "{{ $id }}"; 
                $.get(
                    "{{route('evaluate')}}", 
                    {
                        user_id : user_id,
                        film_id : film_id,
                        evaluate_value: t
                    }, 
                    function (data) {
                        for(var i=1; i<=10; i++) {
                            let star_id = "rate-" + i ; 
                            document.getElementById(star_id).classList.remove("star-active"); 
                        }
                       
                        for(var i=1; i<=data; i++) {
                            let star_id = "rate-" + i ; 
                            document.getElementById(star_id).classList.add("star-active"); 
                        }
                        swal("Thành công", "Bạn đã đánh giá   {{ $name_film }} " + data +" " + ' sao' , "success");
                        exits_form_evaluate(); 
                    }
                ) 
            }) 
        });  
    </script>

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
    </script>
    <script src="{{ asset('clients/js/font-awesome.js') }}"></script>
    <script src="{{ asset('clients/js/infor.js') }}"></script>
@endsection

