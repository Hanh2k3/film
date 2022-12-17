@extends('layouts.main_layout')

@section('meta_tag')
@endsection

{{-- Put data here --}}
@section('title')
    @foreach ($film as $item)
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
    <script src="{{ asset('clients/js/vanillaEmojiPicker.js') }}"></script>
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
                <i class="ti-star star-evaluate" id="rate-10" data-id="10"></i>
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
                    @php
                        $img = $film[0]->img;
                    @endphp
                    <img src="{{ asset("uploads/avatar_film/$img") }}" alt="">

                    <div>
                        <div class="button_box">
                            <a class="btn_watch" href="{{ route('viewPage.', ['film_id' => $id, 'episode_id' => 1]) }}">Xem
                                phim</a>
                            <form action="{{ route('store.insert') }}" method="post">
                                @csrf
                                <input type="hidden" name="film_id" value="{{ $id }}">
                                <button id="infor-btn-submit"></button>
                            </form>
                            @if (checkFollowedFilm($id))
                                <form action="{{ route('infor.unfollow', ['film_id' => $id]) }}" method="post">
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
        
                        <div class="detail_content content_film" style="display: table; ">
                            <h5>Nội dung:</h5>
                            {{-- Put data here --}}
                            <p>{!! $description !!}</p>

                        </div>
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
                <p class="comment_title" id="total">Bình luận ({{ $total }})</p>
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
                        <textarea name="comment" id="comment" class="cmt_1 comment_a" cols="10" rows="5"></textarea>
                        <div class="div_comment">
                            <i class="first-btn ti-comments-smiley" id="binh_luan"></i>
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
                                            <img src="{{ asset("uploads/avatar/$comment->avt") }}"
                                                alt="Images avatar of user">
                                        @endif
                                    </a>
                                </div>
                                <div>
                                    <div class="c_comment_body">
                                        <a class="c_comment_user" href="#">{{ $comment->user_name }}</a>
                                        <p class="c_comment_content">{{ $comment->comment_content }}</p>
                                        <div>
                                            <p><button href="#" class="answer"
                                                    data-id="{{ $comment->comment_id }}">Trả lời</button></p>
                                            <p class="c_comment_time">{{ $comment->created_at }}</p>
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
                                                        <img src="{{ asset("uploads/avatar/$sub->avt") }}"
                                                            alt="Images avatar of user">
                                                    @endif
                                                </a>
                                            </div>
                                            <div>
                                                <div class="c_comment_body">
                                                    <a class="c_comment_user" href="#">{{ $sub->user_name }}</a>
                                                    <p class="c_comment_content">{{ $sub->comment_content }}</p>
                                                    <div>
                                                        <p class="c_comment_time">{{ $sub->created_at }}</p>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <form action="#" method="GET" class="un_active"
                                id="form_answer_{{ $comment->comment_id }}">
                                <textarea name="comment_{{ $comment->comment_id }}" id="comment_{{ $comment->comment_id }}" class="comment_a"
                                    cols="10" rows="5"></textarea>
                                <div class="div_comment">
                                    <i class="ti-comments-smiley" id="btn_{{ $comment->comment_id }}"></i>
                                    <input type="submit" value="Bình luận" class="btn_submit"
                                        id="btn_submit_{{ $comment->comment_id }}" data-id="{{ $comment->comment_id }}">
                                </div>
                            </form>
                        </li>
                    @endforeach
                    <script>
                        new EmojiPicker({
                            trigger: [{
                                    selector: '#binh_luan',
                                    insertInto: '#comment' // '.selector' can be used without array
                                },
                                @foreach ($list_cmt as $comment)
                                    {
                                        selector: "#btn_{{ $comment->comment_id }}",
                                        insertInto: "#comment_{{ $comment->comment_id }} " // '.selector' can be used without array
                                    },
                                @endforeach

                            ],
                            closeButton: true,
                            //specialButtons: green
                        });
                    </script>
                </ul>
                <div class="bt_load_cm" id="load_cm">
                    <button href="#" class="fw-600" id="btn_load">Tải thêm bình luận</button>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('clients/js/switalert.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var times_load = 5;
        var total = "{{ $total }}";
        total = Number(total);

        function test1() {
            $('.answer').click(function() {
                event.preventDefault();
                let t = $(this).data('id');
                btn_cmt = t;
                let cl = 'form_answer_' + t;
                let answer_form = document.getElementById(cl);
                console.log(answer_form);
                answer_form.classList.remove('un_active');

            });

        }
        var num_star = "{{ $num_star }}";
        var btn_cmt = null;

        function add_start_active(a) {
            for (var i = 1; i <= a; i++) {
                let star_id = "rate-" + i;
                document.getElementById(star_id).classList.add("star-active");
            }

        }
        add_start_active(num_star);
        // score 
        var score = "{{ $score }}";

        function display_score(a) {
            a = Math.round(a);
            for (var i = 1; i <= a; i++) {
                let star_id = "score-" + i;
                document.getElementById(star_id).classList.remove("fa-regular");
                document.getElementById(star_id).classList.add("fa-solid");
            }
        }
        display_score(score);

        // display icon comment boxes 



        $(document).ready(function() {
            $('#btn_cmt').click(function() {
                event.preventDefault();
                let comment = document.getElementById('comment').value;


                if (comment.length == 0) {
                    alert('Vui lòng nhập bình luận');
                    return;
                }

                var film_id = "{{ $id }}";
                $.get(
                    '{{ route('save_comment') }}', {
                        comment: comment,
                        film_id: film_id,
                        times_load: times_load,

                    },
                    function(data) {
                        $('#comment').val('');
                        $('.comment_list').html(data);
                        total += 1;
                        document.getElementById('total').innerText = 'Bình luận (' + total + ')';
                    }
                )
            })
            //  display sub comment 
            $('.answer').click(function() {
                event.preventDefault();
                let t = $(this).data('id');
                btn_cmt = t;
                let cl = 'form_answer_' + t;
                let answer_form = document.getElementById(cl);
                console.log(answer_form);
                answer_form.classList.remove('un_active');

            });

            // submit answer 
            $('.btn_submit').click(function() {

                event.preventDefault();
                let t = $(this).data('id');

                let c = 'comment_' + t;
                let comment = document.getElementById(c).value;

                if (comment.length == 0) {
                    alert('Vui lòng nhập bình luận');
                    return;
                }
                var film_id = "{{ $id }}";
                $.get(
                    '{{ route('save_comment') }}', {
                        comment: comment,
                        film_id: film_id,
                        answer: true,
                        comment_id: t,
                        times_load: times_load,

                    },
                    function(data) {
                        $('#' + c).val('');
                        let answer_form = document.getElementById(c);
                        answer_form.classList.add('un_active');
                        $('.comment_list').html(data);
                    }
                )
            });

            // load comment 
            $('#btn_load').click(function() {
                event.preventDefault();
                times_load += 5;
                let film_id = "{{ $id }}";
                $.get(
                    '{{ route('load_comment') }}', {
                        times_load: times_load,
                        film_id: film_id,
                    },
                    function(data) {
                        if (times_load >= total) {
                            var t = document.getElementById('load_cm');
                            t.style.display = 'none';
                        }
                        $('.comment_list').html(data['result']);
                    }
                );
            });

            $('.star-evaluate').click(function() {
                event.preventDefault();
                var t = $(this).data('id');
                var user_id = "{{ session('user_id') }}";
                var film_id = "{{ $id }}";
                $.get(
                    "{{ route('evaluate') }}", {
                        user_id: user_id,
                        film_id: film_id,
                        evaluate_value: t
                    },
                    function(data) {
                        for (var i = 1; i <= 10; i++) {
                            let star_id = "rate-" + i;
                            document.getElementById(star_id).classList.remove("star-active");
                        }

                        for (var i = 1; i <= data; i++) {
                            let star_id = "rate-" + i;
                            document.getElementById(star_id).classList.add("star-active");
                        }
                        swal("Thành công", "Bạn đã đánh giá   {{ $name_film }} " + data + " " +
                            ' sao', "success");
                        exits_form_evaluate();
                    }
                )
            })
        });
    </script>
    <script src="{{ asset('clients/js/font-awesome.js') }}"></script>
    <script src="{{ asset('clients/js/infor.js') }}"></script>
@endsection
