@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">베스트</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="#mode_nav" class="is-active">유료소설 베스트</a>
                            <ul class="lnb-depth2">
                                <li><a href="#mode_nav" class="is-active">투데이베스트</a></li>
                                <li><a href="#mode_nav">주간베스트</a></li>
                                <li><a href="#mode_nav">월간베스트</a></li>
                                <li><a href="#mode_nav">스터디셀러</a></li>
                                <li><a href="#mode_nav">장르별베스트</a></li>
                                <li><a href="#mode_nav">완결베스트</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="#mode_nav">무료소설 베스트</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 작품목록 -->
                <ul class="novel-list novel-list--best">
                    @foreach($novel_groups as $novel_group)
                        <li>
                            <div class="rank">{{(10 * $page) + $loop->index + 1}}</div>
                            <div class="thumb">
                                <span><a href="#mode_nav"><img src="imgs/thumb/novel1.png" alt="꽃에 미치다"></a></span>
                            </div>
                            <div class="post">
                                <div class="post-header">
                                    <strong class="title"><a href="#mode_nav">꽃에 미치다</a></strong>
                                    <span class="writer">선움</span>
                                    <span class="datetime">5분 전</span>
                                </div>
                                <p class="post-content">[악녀여주를 탈탈턴다/엑스트라빙의/케미터짐/우정물/능글능글남주/츤데레남주/사이다후추후추/개그후추후추] 못 볼 것을
                                    보게 된
                                    도로시는 눈을 살포시 감고는 읊조렸다.<br>“눈이 썩었어요.”</p>
                                <p class="post-info"><span>로맨스판타지</span> <span>총 188화</span> <span>조회수 2,121,988</span>
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- 작품목록 -->
                <!-- 베스트페이징 -->
                <div class="bestpage-nav">
                    <nav>
                        <ul>
                            <li><a href="#mode_nav" class="current-page">1-20위</a></li>
                            <li><a href="#mode_nav">21-40위</a></li>
                            <li><a href="#mode_nav">41-60위</a></li>
                            <li><a href="#mode_nav">61-80위</a></li>
                            <li><a href="#mode_nav">81-100위</a></li>
                        </ul>
                    </nav>
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

@endsection