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

    @if (isset($define))
        <h1>Không có kết quả tìm kiếm</h1>
    @else
        <div class="margin-20">
            <div class="banner g_heading">
                <div>Kết quả tìm kiếm của {{ $key }}</div>
            </div>
        </div>

        <div class="movies-list margin-20">


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
    @endif

@endsection
