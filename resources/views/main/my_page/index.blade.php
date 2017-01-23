@extends('../layouts.main_layout')
@section    ('content')
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            @include('main.my_page.left_sidebar')
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 내정보 -->
                <section class="myinfo">
                    <h2 class="hidden">My정보</h2>
                    <div class="myinfo-box">
                        <!-- 회원정보 -->
                        <div class="col-member">
                            <strong class="user-name">김달</strong>
                            <span class="user-id">kimdal</span>
                            <span class="user-email">kimdal@naver.com</span>
                            <a href="#mode_nav" class="btn btn--special">로그아웃</a>
                            <a href="#mode_nav" class="setup-btn"><i class="setup-icon">설정</i></a>
                        </div>
                        <!-- 보유구슬 -->
                        <div class="col-marble">
                            <i class="marble3-icon"></i>
                            <span class="item-name">보유구슬</span>
                            <strong class="item-count">1,170개</strong>
                            <a href="#mode_nav" class="btn btn--submit">구슬충전</a>
                        </div>
                        <!-- 보유조각 -->
                        <div class="col-piece">
                            <i class="piece3-icon"></i>
                            <span class="item-name">보유조각</span>
                            <strong class="item-count">0개</strong>
                            <span class="item-etc">소멸 예정 0개</span>
                        </div>
                        <!-- 선호작 -->
                        <div class="col-scrap">
                            <i class="scrap3-icon"></i>
                            <span class="item-name">선호작</span>
                            <strong class="item-count">32작품</strong>
                        </div>
                    </div>
                </section>
                <!-- //내정보 -->

                <!-- 최근구매내역 -->
                <section class="latest-wrap latest-wrap--mypage">
                    <h2 class="latest-title">최근 구매 내역</h2>
                    <ul class="latest">
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="imgs/thumb/buy_book1.png" alt=""></p>
                                <p class="book-title">고백게임</p>
                                <p class="author">이비안</p>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="imgs/thumb/buy_book2.png" alt=""></p>
                                <p class="book-title">낙원연가</p>
                                <p class="author">Girdap</p>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="imgs/thumb/buy_book3.png" alt=""></p>
                                <p class="book-title">공녀 엘린느</p>
                                <p class="author">박초율</p>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="imgs/thumb/buy_book4.png" alt=""></p>
                                <p class="book-title">초콜릿 객잔 702번지</p>
                                <p class="author">림랑</p>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="imgs/thumb/buy_book5.png" alt=""></p>
                                <p class="book-title">연애한도초과</p>
                                <p class="author">김현서</p>
                            </a>
                        </li>
                    </ul>
                    <a href="#mode_nav" class="latest-more-btn">더보기</a>
                </section>
                <!-- //최근구매내역 -->

                <!-- 선호작업데이트 -->
                <section class="latest-wrap latest-wrap--mypage">
                    <h2 class="latest-title">선호작 업데이트</h2>
                    <ul class="latest">
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="imgs/thumb/scrap_book1.png" alt=""></p>
                                <p class="book-title">순수의 욕망</p>
                                <p class="author">럼</p>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="imgs/thumb/scrap_book2.png" alt=""></p>
                                <p class="book-title">달꽃너울</p>
                                <p class="author">Milkymoon</p>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="imgs/thumb/scrap_book3.png" alt=""></p>
                                <p class="book-title">울지마 유령</p>
                                <p class="author">림랑</p>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="imgs/thumb/scrap_book4.png" alt=""></p>
                                <p class="book-title">한설</p>
                                <p class="author">Milkymoon</p>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="imgs/thumb/scrap_book5.png" alt=""></p>
                                <p class="book-title">늑대의 주인</p>
                                <p class="author">이에르바</p>
                            </a>
                        </li>
                    </ul>
                    <a href="#mode_nav" class="latest-more-btn">더보기</a>
                </section>
                <!-- //선호작업데이트 -->
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