@extends('layouts.main_layout')

@section('title')
    Trang chủ    
@endsection

@section('meta_tag')
    
@endsection

@section('link')
    <link rel="stylesheet" href="{{asset('clients/css/home.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/swiper-bundle.min.css')}}">
@endsection

@section('content')

    <div class="carousel margin-20">
        <div class="banner">
            <div>Phim đề cử</div>
        </div>

        <div class="swiper mySwiper slide-container" id="slide">
            <div class="swiper-wrapper">
                @php 
                    $i = 0; 
                @endphp 
                
                @foreach ($film as $item )    
                    <div id="card" class="swiper-slide">
                        <a href="{{route('infor.view', ['id' => $item->film_id])}}">
                            <div>
                                <img src="{{$item->img}}" alt="">
                            </div>
                        </a>
                        <div class="name">{{$item->film_name}}</div>
                        <div class="episode-lastes">{{$list_film[$i]}}/{{$item->episodes_quantity}}</div>
                    </div>
                @php 
                    $i +=1; 
                @endphp 
               
                @endforeach
                @php 
                    $i =0; 
                @endphp 
              
            </div>
            <div class="swiper-pagination"></div>
          </div>
    </div>
    <div class="margin-20">
         <div class="banner">
            <div>Phim mới nhất</div>
         </div>
    </div>
   
    <div class="movies-list margin-20">
        

        @foreach ($film_new as $item )
        <div class="movie-item">
            <a href="{{route('infor.view', ['id' => $item->film_id])}}">
                <div class="episode-latest">{{$list_film_new[$i]}}/{{$item->episodes_quantity}}</div>
                <div>
                    <img src="{{$item->img}}" alt="">
                </div>

                <div class="score">9.2</div>

                <div class="name-movie">{{$item->film_name}}</div>
            </a>
        </div>
        @php 
            $i +=1; 
        @endphp 
            
        @endforeach
 
    </div>
    <script src="{{asset('clients/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('clients/js/home.js')}}"></script>

@endsection