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
                            <li><a href="#mode_nav" class="is-active">전체</a></li>
                            <li><a href="#mode_nav">현대로맨스</a></li>
                            <li><a href="#mode_nav">시대로맨스</a></li>
                            <li><a href="#mode_nav">로맨스판타지</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- //작품목록정렬 -->
                <!-- **작품목록정렬과 작품목록 사이에는 태그삽입 금지 -->
                <!-- 작품목록 -->
                <ul class="novel-list novel-list--scrap">
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/scrap_novel10.png" alt="망의 연월"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">망의 연월</a><i class="new-icon">New</i><i class="end-icon">End</i><i class="secret-icon">Secret</i></strong>
                                <span class="writer">림랑</span>
                                <span class="datetime">1분 전</span>
                            </div>
                            <div class="post-scrap">
                                <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/scrap_novel9.png" alt="고백게임"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">고백게임</a><i class="new-icon">New</i></strong>
                                <span class="writer">이비안</span>
                                <span class="datetime">1분 전</span>
                            </div>
                            <div class="post-scrap">
                                <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/scrap_novel8.png" alt="낙원연가"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">낙원연가</a><i class="secret-icon">Secret</i></strong>
                                <span class="writer">Girdap</span>
                                <span class="datetime">2분 전</span>
                            </div>
                            <div class="post-scrap">
                                <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/scrap_novel7.png" alt="공녀 엘린느"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">공녀 엘린느</a><i class="end-icon">End</i></strong>
                                <span class="writer">박초율</span>
                                <span class="datetime">2분 전</span>
                            </div>
                            <div class="post-scrap">
                                <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/scrap_novel6.png" alt="초콜릿 객잔 702번지"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">초콜릿 객잔 702번지</a></strong>
                                <span class="writer">림랑</span>
                                <span class="datetime">2분 전</span>
                            </div>
                            <div class="post-scrap">
                                <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/scrap_novel5.png" alt="연애한도초과"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">연애한도초과</a></strong>
                                <span class="writer">김현서</span>
                                <span class="datetime">2분 전</span>
                            </div>
                            <div class="post-scrap">
                                <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/scrap_novel4.png" alt="순수의 욕망"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">순수의 욕망</a></strong>
                                <span class="writer">럼</span>
                                <span class="datetime">3분 전</span>
                            </div>
                            <div class="post-scrap">
                                <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/scrap_novel3.png" alt="달꽃너울"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">달꽃너울</a></strong>
                                <span class="writer">Milkymoon</span>
                                <span class="datetime">3분 전</span>
                            </div>
                            <div class="post-scrap">
                                <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/scrap_novel2.png" alt="울지마 유령"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">울지마 유령</a></strong>
                                <span class="writer">림랑</span>
                                <span class="datetime">3분 전</span>
                            </div>
                            <div class="post-scrap">
                                <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/scrap_novel1.png" alt="한설"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">한설</a></strong>
                                <span class="writer">Milkymoon</span>
                                <span class="datetime">3분 전</span>
                            </div>
                            <div class="post-scrap">
                                <a href="#mode_nav" class="userbtn userbtn--scrap-active">선호작</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- //작품목록 -->
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
                            <li><a href="#mode_nav" class="next-page"><span>다음</span></a></li>
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
    <!-- 푸터 -->


@endsection