@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">커뮤니티</h2>

                    <ul class="lnb-depth1">

                        <li>
                            <a href="{{route('free_board')}}">자유게시판</a>
                        </li>

                        <li>
                            <a href="{{route('reader_reco')}}" class="is-active">독자추천</a><br>
                            <a href="{{route('reader_reco')}}"
                               @if($genre=='%')class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2" @endif>전체</a><br>
                            <a href="{{route('reader_reco')}}?genre=현대"
                               @if($genre=='현대판타지' || $genre == '현대')class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2"@endif>현대로맨스</a>
                            <ul class="lnb-depth2">
                                @if($genre=='현대판타지' || $genre == '현대')
                                    <li><a href="{{route('reader_reco')}}?genre=현대"
                                           @if($genre=='현대')class="is-active"@endif>현대</a></li>
                                    <li><a href="{{route('reader_reco')}}?genre=현대판타지"
                                           @if($genre=='현대판타지')class="is-active"@endif>현대판타지</a></li>
                                @endif
                            </ul>
                            <a href="{{route('reader_reco')}}?genre=시대"
                               @if(($genre=='시대' or $genre == '사극' or $genre == '동양판타지'))class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2"@endif>시대로맨스</a>
                            <ul class="lnb-depth2">
                                @if(($genre=='시대' or $genre == '사극' or $genre == '동양판타지'))
                                    <li><a href="{{route('reader_reco')}}?genre=시대"
                                           @if($genre=='시대')class="is-active"@endif>시대</a></li>
                                    <li><a href="{{route('reader_reco')}}?genre=사극"
                                           @if($genre=='사극')class="is-active"@endif>사극</a></li>
                                    <li><a href="{{route('reader_reco')}}?genre=동양판타지"
                                           @if($genre=='동양판타지')class="is-active"@endif>동양판타지</a></li>
                                @endif
                            </ul>
                            <a href="{{route('reader_reco')}}?genre=서양역사"
                               @if(($genre=='서양역사' or $genre == '로맨스판타지'))class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2"@endif>서양역사</a>
                            <ul class="lnb-depth2">
                                @if(($genre=='서양역사' or $genre == '로맨스판타지'))
                                    <li><a href="{{route('reader_reco')}}?genre=서양역사"
                                           @if($genre=='서양역사')class="is-active"@endif>서양역사</a></li>
                                    <li><a href="{{route('reader_reco')}}?genre=로맨스판타지"
                                           @if($genre=='로맨스판타지')class="is-active"@endif>로맨스판타지</a></li>
                                @endif
                            </ul>
                        </li>


                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                @if(Session::has('flash_message'))
                    {{-- important, success, warning, danger and info --}}
                    <div class="alert alert-success">
                        {{Session('flash_message')}}
                    </div>
            @endif
            <!-- 작품목록 -->
                <div class="sort-nav sort-nav--novel">
                    <div style="float:left;margin-left: 10px;">
                        @if($novel_group_id){{$reviews[0]->title}}의 다른 리뷰들 @endif
                        @if($review_user_id){{$reviews[0]->user_name}}님의 리뷰들@endif
                    </div>
                    <div style="float:right;margin-right: 10px;">
                        {{$reviews->Total()}}개의 결과물
                    </div>
                </div>
                <ul class="novel-list">
                    @foreach ($reviews as $review)
                        <li>
                            <div class="thumb">
                            <span><a href="{{ route('reader_reco.detail', ['id' => $review->id]) }}"><img
                                            src="/img/novel_covers/{{$review->novel_groups->cover_photo}}"
                                            alt="망의 연월"></a></span>
                            </div>
                            <div class="post">
                                <div class="post-header">
                                    <strong class="title"><a
                                                href="{{ route('reader_reco.detail', ['id' => $review->id]) }}">{{$review->title}}</a></strong>
                                    <span class="writer">{{$review['users']['name']}}</span>
                                </div>
                                <p class="post-content">{{ $review->review }}</p>

                                <p class="post-info">
                                    @foreach ($review->novel_groups->keywords as $keyword)
                                        <span>{{ $keyword->name }}</span>
                                        @break
                                    @endforeach
                                    <span>조회수 {{$review->novel_groups->view_count}}</span> <span>작성일 2016.06.21</span>
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- //작품목록 -->

                <!-- 하단버튼 -->

                <!-- //하단버튼 -->
                <!-- 페이징 -->
            @include('pagination_front', ['collection' => $reviews, 'url' => route('reader_reco')."?genre=".$genre."&search_option=".$search_option."&search_text=".$search_text."&novel_group=".$novel_group_id."&review_user=".$review_user_id."&"])
            {{--<div class="page-nav">--}}
            {{--<nav>--}}
            {{--<ul>--}}
            {{--<!--<li><a href="#mode_nav" class="prev-page"><span>이전</span></a></li>-->--}}
            {{--<li><a href="#mode_nav" class="current-page">1</a></li>--}}
            {{--<li><a href="#mode_nav">2</a></li>--}}
            {{--<li><a href="#mode_nav">3</a></li>--}}
            {{--<li><a href="#mode_nav">4</a></li>--}}
            {{--<li><a href="#mode_nav">5</a></li>--}}
            {{--<li><a href="#mode_nav">6</a></li>--}}
            {{--<li><a href="#mode_nav">7</a></li>--}}
            {{--<li><a href="#mode_nav">8</a></li>--}}
            {{--<li><a href="#mode_nav">9</a></li>--}}
            {{--<li><a href="#mode_nav">10</a></li>--}}
            {{--<li><a href="#mode_nav" class="next-page"><span>다음</span></a></li>--}}
            {{--</ul>--}}
            {{--</nav>--}}
            {{--</div>--}}
            <!-- //페이징 -->

                <!-- 검색 -->
                <form action="{{Request::url()}}" class="content-search-form">
                    <fieldset>
                        <legend>검색</legend>
                    <span class="selectbox">
                        <select name="search_option" title="검색옵션">
                            <option value="title">제목</option>
                            <option value="content">내용</option>
                        </select>
                    </span>
                        <input name="search_text" type="text" class="text1" title="검색어">
                        <button type="submit" class="userbtn userbtn--search">검색</button>
                    </fieldset>
                </form>
                <!-- //검색 -->
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    </div>
    <!-- //컨테이너 -->
    <script>
        /*   $(".alert-dismissable").fadeTo(2000, 500).slideUp(500, function(){
         $(".alert-dismissable").alert('close');
         });*/
        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>
@endsection