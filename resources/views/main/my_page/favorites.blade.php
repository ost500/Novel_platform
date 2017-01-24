@extends('../layouts.main_layout')
@section('content')
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            @include('main.my_page.left_sidebar')
                    <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 작품목록정렬 -->
                <div class="sort-nav sort-nav--novel">
                    <nav>
                        <ul>

                            <li>
                                <a href="{{route('my_page.favorites')}}" @if(!$keyword_name) class="is-active" @endif>전체</a></li>
                            @foreach($keywords as $keyword)

                                <li><a href="{{route('my_page.favorites').'?keyword='.$keyword->name }}"
                                       @if($keyword_name == $keyword->name) class="is-active" @endif>{{$keyword->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <!-- //작품목록정렬 -->
                <!-- **작품목록정렬과 작품목록 사이에는 태그삽입 금지 -->
                <!-- 작품목록 -->
                <ul class=" novel-list--scrap novel-list">
                    @if(count($my_favorites)  > 0)
                        @foreach($my_favorites as $my_favorite )
                            <li>
                                <div class="thumb">
                                    <span><a href="{{route('each_novel.novel_group',['id'=>$my_favorite->id])}}"><img
                                                    src="/img/novel_covers/{{$my_favorite->cover_photo}}"
                                                    alt="망의 연월"></a></span>
                                </div>
                                <div class="post">
                                    <div class="post-header">
                                        <strong class="title"><a
                                                    href="{{route('each_novel.novel_group',['id'=>$my_favorite->id])}}">{{str_limit($my_favorite->title,60)}}</a>
                                            @if($week_gap < $my_favorite->new)<i class="new-icon">New</i>@endif
                                            @if($my_favorite->completed)<i class="end-icon">End</i>@endif @if($my_favorite->secret)<i class="secret-icon">Secret</i>@endif</strong>
                                        <span class="writer">{{$my_favorite->nicknames->nickname}}</span>
                                        <span class="datetime">{{time_elapsed_string($my_favorite->new)}}</span>
                                    </div>
                                    <div class="post-scrap">
                                        <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <div style="text-align:center;"> No Results Found!!.
                        </div>
                    @endif

                </ul>
                <!-- //작품목록 -->
                <!-- 페이징 -->

                <div class="page-nav">
                    @include('pagination_front', ['collection' => $my_favorites, 'url' => route('my_page.favorites').$query_string.'&'])
                </div>

                <!-- //페이징 -->
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
    <!-- 푸터 -->


@endsection