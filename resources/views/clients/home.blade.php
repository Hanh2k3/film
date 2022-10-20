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

    <div class="carousel">
        <div class="banner">
            <div>Phim đề cử</div>
        </div>

        <div class="swiper mySwiper slide-container">
            <div class="swiper-wrapper">
                <div id="card" class="swiper-slide">
                    <a href="https://www.google.com/search?q=gg%20d%E1%BB%8Bch">
                           <div>
                               <img src="https://animehay.club/upload/poster/3518-1659146047.jpg" alt="">
                           </div>
                   </a>
                   <div class="name">Phàm nhân tu tiên</div>
                   <div class="episode-lastes">12/20</div>
               </div>
               
                <div id="card" class="swiper-slide">
                         <a href="https://www.google.com/search?q=gg%20d%E1%BB%8Bch">
                                <div>
                                    <img src="https://animehay.club/upload/poster/3518-1659146047.jpg" alt="">
                                </div>
                        </a>
                        <div class="name">Phàm nhân tu tiên</div>
                        <div class="episode-lastes">12/20</div>
                </div>

                 <div id="card" class="swiper-slide">
                         <a href="https://www.google.com/search?q=gg%20d%E1%BB%8Bch">
                                <div>
                                    <img src="https://animehay.club/upload/poster/3518-1659146047.jpg" alt="">
                                </div>
                        </a>
                        <div class="name">Phàm nhân tu tiên</div>
                        <div class="episode-lastes">12/20</div>
                </div>

                 <div id="card" class="swiper-slide">
                         <a href="https://www.google.com/search?q=gg%20d%E1%BB%8Bch">
                                <div>
                                    <img src="https://animehay.club/upload/poster/3518-1659146047.jpg" alt="">
                                </div>
                        </a>
                        <div class="name">Phàm nhân tu tiên</div>
                        <div class="episode-lastes">12/20</div>
                </div>

                 <div id="card" class="swiper-slide">
                         <a href="https://www.google.com/search?q=gg%20d%E1%BB%8Bch">
                                <div>
                                    <img src="https://animehay.club/upload/poster/3518-1659146047.jpg" alt="">
                                </div>
                        </a>
                        <div class="name">Phàm nhân tu tiên</div>
                        <div class="episode-lastes">12/20</div>
                </div>

                 <div id="card" class="swiper-slide">
                         <a href="https://www.google.com/search?q=gg%20d%E1%BB%8Bch">
                                <div>
                                    <img src="https://animehay.club/upload/poster/3518-1659146047.jpg" alt="">
                                </div>
                        </a>
                        <div class="name">Phàm nhân tu tiên</div>
                        <div class="episode-lastes">12/20</div>
                </div>


                 <div id="card" class="swiper-slide">
                         <a href="https://www.google.com/search?q=gg%20d%E1%BB%8Bch">
                                <div>
                                    <img src="https://animehay.club/upload/poster/3518-1659146047.jpg" alt="">
                                </div>
                        </a>
                        <div class="name">Phàm nhân tu tiên</div>
                        <div class="episode-lastes">12/20</div>
                </div>

                 <div id="card" class="swiper-slide">
                         <a href="https://www.google.com/search?q=gg%20d%E1%BB%8Bch">
                                <div>
                                    <img src="https://animehay.club/upload/poster/3518-1659146047.jpg" alt="">
                                </div>
                        </a>
                        <div class="name">Phàm nhân tu tiên</div>
                        <div class="episode-lastes">12/20</div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
    </div>

    <div class="list_film">
        <div class="banner">
            <div>Phim đề cử</div>
        </di
    </div>
    <script src="{{asset('clients/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('clients/js/home.js')}}"></script>

    
@endsection