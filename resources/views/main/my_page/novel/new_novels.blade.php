@extends('../layouts.main_layout')
@section('content')
<div class="container">
    <div class="wrap">
        <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

        <!-- 서브컨텐츠 -->
        <div class="content" id="content">
            <!-- 페이지헤더 -->
            <div class="list-header">
                <h2 class="title">신작알림</h2>
            </div>
            <!-- //페이지헤더 -->

            <!-- 신작알림 -->
            <ul class="new-work-list">
                @foreach($new_novels as $new_novel )
                <li>
                    <strong class="author-name">{{$new_novel->nicknames->nickname}}</strong>
                    <ul class="author-new-work-list">

                        <li>
                            <div class="thumb"> <span><a href="{{route('each_novel.novel_group',['id'=>$new_novel->id])}}"><img
                                            src="/img/novel_covers/{{$new_novel->cover_photo}}"
                                            alt="망의 연월"></a></span></div>
                            <div class="post">
                                <strong class="title"><a href="{{route('each_novel.novel_group',['id'=>$new_novel->id])}}">{{str_limit($new_novel->title,20)}}</a></strong>
                                <span class="datetime">{{$new_novel->new}}</span>
                            </div>
                        </li>
                        @foreach($other_novels[$new_novel->user_id] as $other_novel )
                        <li>
                            <div class="thumb"><a href="{{route('each_novel.novel_group',['id'=>$other_novel->id])}}"><img src="/img/novel_covers/{{$other_novel->cover_photo}}" alt="괴롭히고 싶다"></a></div>
                            <div class="post">
                                <strong class="title"><a href="{{route('each_novel.novel_group',['id'=>$other_novel->id])}}">{{str_limit($other_novel->title,20)}}</a></strong>
                                <span class="datetime">{{$other_novel->new}}</span>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
                @endforeach

            </ul>
            <!-- //신작알림 -->
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