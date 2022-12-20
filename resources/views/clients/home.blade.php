@extends('layouts.main_layout')

@section('title')
    Trang chủ
@endsection

@section('meta_tag')
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('clients/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/swiper-bundle.min.css') }}">
@endsection

@section('content')
    <div class="carousel">
        <div class="banner g_heading">
            <div>Phim đề cử</div>
        </div>

        <div id="slide">
            <div class="slide-container">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @php
                            $i = 0;
                        @endphp
        
                        @foreach ($film as $item)
                            @php
                                $score = number_format($list_score_1[$i][0]->score, 1);
                            @endphp
                            <div id="card" class="swiper-slide">
                                <a href="{{ route('infor.view', ['id' => $item->film_id]) . '?score=' . $score }}">
                                    <div>
                                        <img src="{{ asset("uploads/avatar_film/$item->img") }}" style="width: 250px; height: 350px"
                                            alt="">
                                    </div>
                                </a>
                                <div class="name">{{ $item->film_name }}</div>
                                <div class="episode-lastes">{{ $list_film[$i] }}/{{ $item->episodes_quantity }}</div>
                            </div>
                            @php
                                $i += 1;
                            @endphp
                        @endforeach
        
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="banner g_heading">
        <div>Phim mới nhất</div>
    </div>

    <div class="movies-list">
        @php
            $i = 0;
        @endphp
        @foreach ($film_new as $item)
            @php
                $score = number_format($list_score[$i][0]->score, 1);
            @endphp
            <div class="movie-item">
                <a href="{{ route('infor.view', ['id' => $item->film_id]) . '?score=' . $score }}">
                    <div class="episode-latest">{{ $list_film_new[$i] }}/{{ $item->episodes_quantity }}</div>
                    <div>
                        <img src="{{ asset("uploads/avatar_film/$item->img") }}" alt="">
                    </div>

                    <div class="score">{{ $score }}</div>

                    <div class="name-movie">{{ $item->film_name }}</div>
                </a>
            </div>
            @php
                $i += 1;
            @endphp
        @endforeach

    </div>
    <script src="{{ asset('clients/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('clients/js/home.js') }}"></script>
@endsection
