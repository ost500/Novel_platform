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
                        <a href="{{route('reader_reco')}}?genre=현대로맨스"
                           @if($genre == '현대로맨스')class="is-active lnb-depth1-2"
                           @else class="lnb-depth1-2"@endif>현대로맨스</a>

                        <a href="{{route('reader_reco')}}?genre=시대로맨스"
                           @if(($genre == '시대로맨스'))class="is-active lnb-depth1-2"
                           @else class="lnb-depth1-2"@endif>시대로맨스</a>

                        <a href="{{route('reader_reco')}}?genre=서양역사"
                           @if(($genre=='서양역사'))class="is-active lnb-depth1-2"
                           @else class="lnb-depth1-2"@endif>서양역사</a>
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
                                                href="{{ route('reader_reco.detail', ['id' => $review->id]) }}">{{$review->review_title}}</a></strong>
                                    <span class="writer">{{$review->users->nickname}}</span>
                                </div>
                                <p class="post-content">{{ str_limit($review->review, 260) }}</p>

                                <p class="post-info">
                                    @foreach ($review->novel_groups->keywords as $keyword)
                                        <span>{{ $keyword->name }}</span>
                                        @break
                                    @endforeach
                                    <span>조회수 {{$review->total_count}}</span>
                                    <span>작성일 {{ $review->created_at->format('Y-m-d') }}</span>
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
                            <option value="nickname">글쓴이</option>
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