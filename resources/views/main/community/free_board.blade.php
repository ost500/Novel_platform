@extends('layouts.main_layout')
@section('content')

    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.community.LNB')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 위클리베스트게시물 -->
                @if($weekly_best->offsetExists(0))
                    <section class="weekly-best">
                        <h2 class="title">
                            <span class="str1">Weekly</span>
                            <span class="str2">Best</span>
                        </h2>

                        <div class="list-wrap">
                            <ol class="list">

                                @foreach($weekly_best[0] as $best)
                                    <li>
                                        <a href="{{route('free_board.detail',['id'=>$best->id])}}">{{$best->title}}</a><span
                                                class="writer">{{str_limit($best->users->name,10)}}</span>
                                    </li>
                                @endforeach

                            </ol>
                            <ol start="6" class="list">
                                @if($weekly_best->offsetExists(1))
                                    @foreach($weekly_best[1] as $best)
                                        <li>
                                            <a href="{{route('free_board.detail',['id'=>$best->id])}}">{{$best->title}}</a><span
                                                    class="writer">{{str_limit($best->users->name,10)}}</span>
                                        </li>
                                    @endforeach
                                @endif

                            </ol>
                        </div>

                    </section>
            @endif

            <!-- //위클리베스트게시물 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--free">
                    <caption>자유게시판 목록</caption>
                    <thead>
                    <tr>
                        <th>번호</th>
                        <th>제목</th>
                        <th>글쓴이</th>
                        <th>등록일</th>
                        <th>조회수</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td class="col-no">{{ $article->id }}</td>
                            <td class="col-subject">
                                <a href="{{ route('free_board.detail',['id'=>$article->id]) }}">{{ $article->title }}</a>
                                <span class="hidden">댓글 </span><span
                                        class="comment-cnt">{{ $article->comments_count }}</span>
                                <i class="new-icon">새글</i>
                            </td>
                            <td class="col-name">{{ $article->users->name }}</td>
                            <td class="col-datetime">{{ $article->created_at->format('Y-m-d') }}</td>
                            <td class="col-view">{{ $article->view_count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- //게시판목록 -->

                <!-- 하단버튼 -->
                <div class="list-bottom-btns">
                    <div class="right-btns">
                        <a href="#mode_nav" class="btn">글쓰기</a>
                    </div>
                </div>
                <!-- //하단버튼 -->
                <!-- 페이징 -->
            @include('pagination_front', ['collection' => $articles, 'url' => route('free_board')."?search_option=".$search_option."&search_text=".$search_text."&"])
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