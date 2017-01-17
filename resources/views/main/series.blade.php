@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">연재</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="#mode_nav" @if(!$free_or_charged)class="is-active"@endif>유료소설</a>
                            <ul class="lnb-depth2">
                                <li><a href="#mode_nav" @if(!$free_or_charged)class="is-active"@endif>전체</a></li>
                                <li><a href="#mode_nav">현대로맨스</a></li>
                                <li><a href="#mode_nav">시대로맨스</a></li>
                                <li><a href="#mode_nav">로맨스판타지</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#mode_nav" @if($free_or_charged)class="is-active"@endif>무료소설</a>
                            <ul class="lnb-depth2">
                                <li><a href="#mode_nav" @if($free_or_charged)class="is-active"@endif>전체</a></li>
                                <li><a href="#mode_nav">현대로맨스</a></li>
                                <li><a href="#mode_nav">시대로맨스</a></li>
                                <li><a href="#mode_nav">로맨스판타지</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 작품목록정렬 -->
                <div class="sort-nav sort-nav--novel">
                    <nav>
                        <ul>
                            <li><a href="#mode_nav" class="is-active">업데이트순</a></li>
                            <li><a href="#mode_nav">선호작순</a></li>
                            <li><a href="#mode_nav">조회순</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- //작품목록정렬 -->
                <!-- **작품목록정렬과 작품목록 사이에는 태그삽입 금지 -->
                <!-- 작품목록 -->
                <ul class="novel-list">
                    @foreach($novel_groups as $novel_group)
                        <li>
                            <div class="thumb">
                                <span><a href="#mode_nav"><img src="/img/novel_covers/{{$novel_group->cover_photo}}" alt="망의 연월"></a></span>
                            </div>
                            <div class="post">
                                <div class="post-header">
                                    <strong class="title"><a href="#mode_nav">{{$novel_group->title}}</a></strong>
                                    <span class="writer">{{ $novel_group->nicknames->nickname }}</span>
                                    <span class="datetime">{{ time_elapsed_string($novel_group->new) }}</span>
                                </div>
                                <p class="post-content"><?php echo nl2br($novel_group->description, false); ?>
                                </p>
                                <p class="post-info"><span>동양판타지</span> <span>총 {{$novel_group->novels_count}}화</span> <span>조회수 287,413</span></p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- //작품목록 -->
                <!-- 페이징 -->
            @include('pagination_front', ['collection' => $novel_groups, 'url' => route('series')])
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


@endsection