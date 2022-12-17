@extends('layouts.main_layout')

@section('title')
    Lưu phim
@endsection

@section('meta_tag')
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('clients/css/store.css') }}">
@endsection

@section('content')
    <div class="main-container">
        <div class="p-store-title">
            <div>
                <i class="ti-bookmark-alt"></i>
                <p>Kho Phim</p>
            </div>
        </div>
        <div class="p-store-container">
            <ul class="store-list">
                @foreach ($followedFilm as $film)
                    <div class="store-film">
                        <div class="store-film-img">
                            <img src="{{ $film->img }}" alt="">
                        </div>
                        <div class="store-film-name" onclick="$(this).children()[0].click()">
                            <a href="{{ route('infor.view', $film->film_id) }}"></a>
                            <div class="store-film-desc">
                                Xem phim
                            </div>
                            <p>{{ $film->film_name }}</p>
                        </div>
                        <div class="store-film-delete">
                            <form action="{{ route('store.delete', ['film_id' => $film->film_id]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button>Xóa</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
@endsection


@section('script-tag')
@endsection
