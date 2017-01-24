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
                <li>
                    <strong class="author-name">림랑</strong>
                    <ul class="author-new-work-list">
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work1.png" alt="누흔"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">누흔</a></strong>
                                <span class="datetime">2017.01.01</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work2.png" alt="괴롭히고 싶다"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">괴롭히고 싶다</a></strong>
                                <span class="datetime">2016.10.30</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work3.png" alt="울지마 유령"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">울지마 유령</a></strong>
                                <span class="datetime">2016.05.11</span>
                            </div>
                        </li>
                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
                <li>
                    <strong class="author-name">이비안</strong>
                    <ul class="author-new-work-list">
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work4.png" alt="탐닉의 밤"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">탐닉의 밤</a></strong>
                                <span class="datetime">2016.12.05</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work5.png" alt="고백게임"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">고백게임</a></strong>
                                <span class="datetime">2016.05.22</span>
                            </div>
                        </li>
                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
                <li>
                    <strong class="author-name">럼</strong>
                    <ul class="author-new-work-list">
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work6.png" alt="순수의 욕망 시즌2"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">순수의 욕망 시즌2</a></strong>
                                <span class="datetime">2016.10.11</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work7.png" alt="그들의 밀착관계"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">그들의 밀착관계</a></strong>
                                <span class="datetime">2016.08.26</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work8.png" alt="순수의 욕망"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">순수의 욕망</a></strong>
                                <span class="datetime">2016.06.01</span>
                            </div>
                        </li>
                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
                <li>
                    <strong class="author-name">김아린</strong>
                    <ul class="author-new-work-list">
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work9.png" alt="심장이 깨지다"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">심장이 깨지다</a></strong>
                                <span class="datetime">2016.11.22</span>
                            </div>
                        </li>
                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
                <li>
                    <strong class="author-name">이에르바</strong>
                    <ul class="author-new-work-list">
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work10.png" alt="늑대의 주인"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">늑대의 주인</a></strong>
                                <span class="datetime">2016.05.13</span>
                            </div>
                        </li>
                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
                <li>
                    <strong class="author-name">김현서</strong>
                    <ul class="author-new-work-list">
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work11.png" alt="연애잠복기"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">연애잠복기</a></strong>
                                <span class="datetime">2016.12.10</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work12.png" alt="연애 한도 초과"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">연애 한도 초과</a></strong>
                                <span class="datetime">2016.03.31</span>
                            </div>
                        </li>
                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
                <li>
                    <strong class="author-name">박초율</strong>
                    <ul class="author-new-work-list">
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work13.png" alt="공녀 엘린느"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">공녀 엘린느</a></strong>
                                <span class="datetime">2017.01.01</span>
                            </div>
                        </li>
                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
                <li>
                    <strong class="author-name">Milkymoon</strong>
                    <ul class="author-new-work-list">
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work14.png" alt="여흔"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">여흔</a></strong>
                                <span class="datetime">2016.12.20</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work15.png" alt="미혹에 빠지다"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">미혹에 빠지다</a></strong>
                                <span class="datetime">2016.08.30</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work16.png" alt="한설"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">한설</a></strong>
                                <span class="datetime">2016.03.12</span>
                            </div>
                        </li>
                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
                <li>
                    <strong class="author-name">Girdap</strong>
                    <ul class="author-new-work-list">
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work17.png" alt="낙원연가"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">낙원연가</a></strong>
                                <span class="datetime">2016.09.15</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work18.png" alt="달이 숨쉬는"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">달이 숨쉬는</a></strong>
                                <span class="datetime">2016.07.19</span>
                            </div>
                        </li>
                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
                <li>
                    <strong class="author-name">이제현</strong>
                    <ul class="author-new-work-list">
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work19.png" alt="잔혹한 다정함에게"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">잔혹한 다정함에게</a></strong>
                                <span class="datetime">2017.01.01</span>
                            </div>
                        </li>
                        <li>
                            <div class="thumb"><a href="#mode_nav"><img src="imgs/thumb/new_work20.png" alt="착한 결혼"></a></div>
                            <div class="post">
                                <strong class="title"><a href="#mode_nav">착한 결혼</a></strong>
                                <span class="datetime">2016.11.01</span>
                            </div>
                        </li>
                    </ul>
                    <div class="new-work-close"><button type="button" class="userbtn userbtn--close">삭제</button></div>
                </li>
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