@extends('layouts.main_layout')

@section('title')
    Xem phim
@endsection

@section('meta_tag')
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('clients/css/viewfilm.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/bottom-content/episode-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/bottom-content/comment-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/switalert.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/top-content/name-film.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/infor/top-content/main-film.css') }}">
    <script src="{{ asset('clients/js/vanillaEmojiPicker.js') }}"></script>
@endsection

@section('content')
    <div class="f_content">
        <div class="watch_film">
            <div class="g_heading">
                <div>
                    <p class="m-0"><i class="ti-video-clapper me-2"></i>{{ $film[0]->film_name }}</p>
                </div>
            </div>

            <div class="chap_film">
                <div class="episode">
                    <div class="episode_number">
                        Tập {{ $episode }}
                    </div>
                </div>
                <div class="info_error">
                    <a href="#"><i class="ti-info-alt fs-18"></i></a>
                    <a href="#" class="mg-r10"><i class="ti-alert fs-18"></i></a>
                </div>
            </div>

            <div class="content_film">


                <iframe src="{{ $link }}" style="width: 100%; height: 100%;" frameborder="0"
                    allowFullScreen="true"></iframe>



            </div>

            <div class="settings_film">
                <div class="settings_episode pd-7 bd-r-5 mg-r10">
                    <i class="ti-settings"></i>
                </div>
                <div class="next_film pd-7 bd-r-5">
                    <a href="{{ route('viewPage.', ['film_id' => $film[0]->film_id, 'episode_id' => $episode + 1]) }}"
                        class="pd-7">Tiếp<i class="ti-control-forward"></i></a>
                </div>
            </div>

            <div class="list_episode">
                <div class="heading">
                    <span class="fw-700">Danh sách tập</span>
                   
                </div>
                <div class="list_item_episode scroll-bar">
                    @foreach ($list_episodes as $item)
                        @if ($item->episode_number == $episode)
                            <a href="{{ route('viewPage.', ['film_id' => $film[0]->film_id, 'episode_id' => $item->episode_number]) }}"
                                class="active"><span>{{ $item->episode_number }}</span></a>
                            @continue
                        @endif
                        <a
                            href="{{ route('viewPage.', ['film_id' => $film[0]->film_id, 'episode_id' => $item->episode_number]) }}"><span>{{ $item->episode_number }}</span></a>
                    @endforeach
                </div>
            </div>

            <div class="comment_film m-0 p-0 mt-4">
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
                                                <p class="c_comment_time">{{ date_format(date_create($comment->created_at), ' H:i d/m/Y ') }}</p>
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
                                                        <a class="c_comment_user"
                                                            href="#">{{ $sub->user_name }}</a>
                                                        <p class="c_comment_content">{{ $sub->comment_content }}</p>
                                                        <div>
                                                            <p class="c_comment_time">{{ date_format(date_create($sub->created_at), ' H:i d/m/Y ') }}</p>
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
                                            id="btn_submit_{{ $comment->comment_id }}"
                                            data-id="{{ $comment->comment_id }}">
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
        </script>

        <script>
            $(document).ready(function() {
                $('#btn_cmt').click(function() {
                    event.preventDefault();
                    let comment = document.getElementById('comment').value;


                    if (comment.length == 0) {
                        alert('Vui lòng nhập bình luận');
                        return;
                    }

                    var film_id = "{{ $film_id }}";
                    var episode = "{{ $episode }}";
                    $.get(
                        '{{ route('save_comment_view') }}', {
                            comment: comment,
                            film_id: film_id,
                            times_load: times_load,
                            episode: episode,

                        },
                        function(data) {
                            $('#comment').val('');
                            $('.comment_list').html(data);
                            total += 1;
                            document.getElementById('total').innerText = 'Bình luận (' + total + ')';


                        }
                    )
                });

                // answer comment 
                $('.answer').click(function() {
                    event.preventDefault();
                    let t = $(this).data('id');
                    btn_cmt = t;
                    let cl = 'form_answer_' + t;
                    let answer_form = document.getElementById(cl);
                    console.log(answer_form);
                    answer_form.classList.remove('un_active');

                });

                $('.btn_submit').click(function() {

                    event.preventDefault();
                    let t = $(this).data('id');

                    let c = 'comment_' + t;
                    let comment = document.getElementById(c).value;
                    let episode = "{{ $episode }}";

                    if (comment.length == 0) {
                        alert('Vui lòng nhập bình luận');
                        return;
                    }
                    var film_id = "{{ $film_id }}";
                    $.get(
                        '{{ route('save_comment_view') }}', {
                            comment: comment,
                            film_id: film_id,
                            episode: episode,
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

                $('#btn_load').click(function() {

                    event.preventDefault();
                    times_load += 5;
                    let film_id = "{{ $film_id }}";
                    let episode = "{{ $episode }}";
                    $.get(
                        '{{ route('load_comment_view') }}', {
                            times_load: times_load,
                            film_id: film_id,
                            episode: episode,

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

            })
        </script>
    @endsection
