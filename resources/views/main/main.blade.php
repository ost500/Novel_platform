@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container" id="content">
        <!-- 정오 -->
        <section class="noon">
            <div class="wrap">
                <h2 class="noon-title"><span>여</span>기, <span>정</span>오의 <span>추천</span></h2>
                <ul class="noon-list clr">
                    @foreach($recommends as $recommend)
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="/img/novel_covers/{{$recommend->cover_photo}}" alt=""></p>
                                <p class="book-title">{{str_limit($recommend->title, 15)}}</p>
                                <p class="author">{{str_limit($recommend->nicknames->nickname,15)}}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <!-- //정오 -->

        <!-- 메인소설 -->
        <div class="wrap">
            <!-- 유료연재베스트 -->
            <section class="latest-wrap latest-wrap--charge">
                <h2 class="latest-title"><span>유료연재</span> 투데이 베스트</h2>
                <ol class="latest latest--rank latest--rank--charge">
                    @foreach($non_free_today_bests as $today_best)
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="/img/novel_covers/{{$today_best->cover_photo}}" alt=""></p>
                                @if($loop->first)
                                    <p class="book-title">{{ str_limit($today_best->title, 17) }}</p>
                                @else
                                    <p class="book-title">{{ str_limit($today_best->title, 10) }}</p>
                                @endif
                                <p class="author">{{ str_limit($today_best->nicknames->nickname, 13) }}</p>
                            </a>
                        </li>
                    @endforeach
                </ol>
                <a href="#mode_nav" class="latest-more-btn">더보기</a>
            </section>
            <!-- //유료연재베스트 -->

            <!-- 무료,새소설,독자추천 -->
            <div class="latest-content">
                <div class="latest-group">
                    <!-- 무료연재베스트 -->
                    <section class="latest-wrap latest-wrap--free">
                        <h2 class="latest-title"><span>무료연재</span> 투데이 베스트 </h2>
                        <ol class="latest latest--rank">
                            @foreach($free_today_bests as $free_today_best)
                                <li>
                                    <a href="#mode_nav">
                                        <p class="thumb"><img src="img/novel_covers/{{$free_today_best->cover_photo}}"
                                                              alt=""></p>
                                        <p class="book-title">{{ str_limit($free_today_best->title, 15) }}</p>
                                        <p class="author">{{ str_limit($free_today_best->nicknames->nickname, 10) }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                        <a href="#mode_nav" class="latest-more-btn">더보기</a>
                    </section>
                    <!-- //무료연재베스트 -->

                    <!-- 새로등록된소설 -->
                    <section class="latest-wrap latest-wrap--new">
                        <h2 class="latest-title">새로 등록된 소설</h2>
                        <ul class="latest">
                            @foreach($latests as $latest)
                                <li>
                                    <a href="#mode_nav">
                                        <p class="thumb"><img src="img/novel_covers/{{$latest->cover_photo}}"
                                                              alt=""></p>
                                        <p class="book-title">{{ str_limit($latest->title, 15) }}</p>
                                        <p class="author">{{ str_limit($latest->nicknames->nickname, 10) }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#mode_nav" class="latest-more-btn">더보기</a>
                    </section>
                    <!-- //새로등록된소설 -->
                </div>
                <!-- 독자추천 -->
                <section class="recommend recommend--main">
                    <h2 class="recommend-title">독자추천</h2>
                    <ul class="recommend-list">
                        @foreach($reader_reviews as $reader_review)
                            <li>
                                <a href="#mode_nav">
                                    <div class="thumb">
                                        <span><img src="img/novel_covers/{{$reader_review->novel_groups->cover_photo}}"
                                                   alt=""></span>
                                    </div>
                                    <div class="post">
                                        <strong class="title">{{$reader_review->review}}</strong>
                                        <p class="post-content">{{$reader_review->review}}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="#mode_nav" class="recommend-more-btn">더보기</a>
                </section>
                <!-- //독자추천 -->
            </div>
            <!-- //무료,새소설,독자추천 -->

            <!-- 회원님을위한추천 -->
            <section class="custom-latest-wrap">

                @if(Auth::check())
                    <h2 class="custom-latest-title"><span>
                            {{ Auth::user()->name }}
                            </span>님을 위한 추천</h2>
                @else
                    <h2 class="custom-latest-title"><span>
                            추천
                            </span>인기 소설</h2>
                @endif

                <ul class="latest">
                    @foreach($recommendations as $recommendation)
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="img/novel_covers/{{$recommendation->cover_photo}}" alt="">
                                </p>
                                <p class="book-title">{{ str_limit($recommendation->title, 15) }}</p>
                                <p class="author">{{ str_limit($recommendation->nicknames->nickname, 10) }}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
            <!-- //회원님을위한추천 -->
        </div>
        <!-- //메인소설 -->
    </div>
    <!-- //컨테이너 -->


@endsection