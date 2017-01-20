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
                            <a href="#mode_nav">자유게시판</a>
                        </li>
                        <li>
                            <a href="#mode_nav" class="is-active">독자추천</a>
                            <ul class="lnb-depth2">
                                <li><a href="{{route('series')}}"
                                       @if($genre=='%')class="is-active"@endif>전체</a></li>
                                <li><a href="{{route('series')}}?genre=현대판타지"
                                       @if($genre=='현대판타지')class="is-active"@endif>현대판타지</a></li>
                                <li><a href="{{route('series')}}?genre=사극/현대물"
                                       @if($genre=='사극/현대물')class="is-active"@endif>사극/현대물</a>
                                </li>
                                <li><a href="{{route('series')}}?genre=동양판타지"
                                       @if($genre=='동양판타지')class="is-active"@endif>동양판타지</a>
                                </li>
                                <li><a href="{{route('series')}}?genre=서양/중세"
                                       @if($genre=='서양/중세')class="is-active"@endif>서양/중세</a>
                                </li>
                                <li><a href="{{route('series')}}?genre=로맨스판타지"
                                       @if($genre=='로맨스판타지')class="is-active"@endif>로맨스판타지</a>
                                </li>
                                <li><a href="{{route('series')}}?genre=미래/SF"
                                       @if($genre=='미래/SF')class="is-active"@endif>미래/SF</a>
                                </li>
                                <li><a href="{{route('series')}}?genre=메디컬로맨스"
                                       @if($genre=='메디컬로맨스')class="is-active"@endif>메디컬로맨스</a>
                                </li>
                                <li><a href="{{route('series')}}?genre=전문직로맨스"
                                       @if($genre=='전문직로맨스')class="is-active"@endif>전문직로맨스</a>
                                </li>
                                <li><a href="{{route('series')}}?genre=캠퍼스로맨스"
                                       @if($genre=='캠퍼스로맨스')class="is-active"@endif>캠퍼스로맨스</a>
                                </li>
                                <li><a href="{{route('series')}}?genre=학원로맨스"
                                       @if($genre=='학원로맨스')class="is-active"@endif>학원로맨스</a>
                                </li>
                                <li><a href="{{route('series')}}?genre=할리퀸로맨스"
                                       @if($genre=='할리퀸로맨스')class="is-active"@endif>할리퀸로맨스</a>
                                </li>
                                <li><a href="{{route('series')}}?genre=스포츠"
                                       @if($genre=='스포츠')class="is-active"@endif>스포츠</a></li>
                                <li><a href="{{route('series')}}?genre=연예계"
                                       @if($genre=='연예계')class="is-active"@endif>연예계</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 작품목록 -->
                <ul class="novel-list">
                    @foreach ($reviews as $review)
                        <li>
                            <div class="thumb">
                            <span><a href="#mode_nav"><img
                                            src="/img/novel_covers/{{$review->novel_groups->cover_photo}}"
                                            alt="망의 연월"></a></span>
                            </div>
                            <div class="post">
                                <div class="post-header">
                                    <strong class="title"><a href="#mode_nav">{{$review->title}}</a></strong>
                                    <span class="writer">{{$review->users->name}}</span>
                                </div>
                                <p class="post-content">{{ $review->review }}</p>
                                <p class="post-info">
                                    @foreach ($review->novel_groups->keywords as $keyword)
                                        <span>{{ $keyword->name }}</span>
                                    @endforeach
                                    <span>조회수 {{$review->novel_groups->view_count}}</span> <span>작성일 2016.06.21</span>
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- //작품목록 -->

                <!-- 하단버튼 -->
                <div class="list-bottom-btns">
                    <div class="right-btns">
                        <a href="#mode_nav" class="btn">글쓰기</a>
                    </div>
                </div>
                <!-- //하단버튼 -->
                <!-- 페이징 -->
                <div class="page-nav">
                    <nav>
                        <ul>
                            <!--<li><a href="#mode_nav" class="prev-page"><span>이전</span></a></li>-->
                            <li><a href="#mode_nav" class="current-page">1</a></li>
                            <li><a href="#mode_nav">2</a></li>
                            <li><a href="#mode_nav">3</a></li>
                            <li><a href="#mode_nav">4</a></li>
                            <li><a href="#mode_nav">5</a></li>
                            <li><a href="#mode_nav">6</a></li>
                            <li><a href="#mode_nav">7</a></li>
                            <li><a href="#mode_nav">8</a></li>
                            <li><a href="#mode_nav">9</a></li>
                            <li><a href="#mode_nav">10</a></li>
                            <li><a href="#mode_nav" class="next-page"><span>다음</span></a></li>
                        </ul>
                    </nav>
                </div>
                <!-- //페이징 -->

                <!-- 검색 -->
                <form name="content_search_form" action="#" class="content-search-form">
                    <fieldset>
                        <legend>검색</legend>
                    <span class="selectbox">
                        <select title="검색옵션">
                            <option>제목</option>
                            <option>내용</option>
                        </select>
                    </span>
                        <input type="text" class="text1" title="검색어">
                        <button type="submit" class="userbtn userbtn--search">검색</button>
                    </fieldset>
                </form>
                <!-- //검색 -->
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
            <div class="aside-nav" id="aside_nav">
                <nav>
                    <ul class="aside-menu">
                        <li><a href="#mode_nav" class="userbtn userbtn--alarm"><span>알림</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--memo"><span>쪽지</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--myinfo"><span>마이메뉴</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--scrap"><span>선호작</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--marble"><span>보유구슬</span></a></li>
                    </ul>
                </nav>
            </div>
            <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
@endsection