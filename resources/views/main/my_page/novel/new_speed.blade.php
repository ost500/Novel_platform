@extends('../layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">My정보</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="#mode_nav">마이페이지 홈</a>
                        </li>
                        <li>
                            <a href="#mode_nav">선호작</a>
                        </li>
                        <li>
                            <a href="#mode_nav">이용정보</a>
                        </li>
                        <li>
                            <a href="#mode_nav" class="is-active">소설</a>
                            <ul class="lnb-depth2">
                                <li><a href="#mode_nav" class="is-active">소식</a></li>
                                <li><a href="#mode_nav">신작알림</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#mode_nav">개인</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">소식</h2>
                </div>
                <!-- 페이지헤더 -->

                <!-- 소식 -->
                <ul class="alarm-list alarm-list--news">
                    @foreach ($new_speeds as $new_speed)
                        <li>
                            <div class="thumb">
                                <img src="/img/novel_covers/{{ $new_speed->image }}" alt="">
                            </div>
                            <div class="post">
                                <p class="post-content"><a href="#mode_nav">{{ $new_speed->title }}</a></p>
                                <p class="post-datetime">{{ time_elapsed_string($new_speed->created_at) }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- //소식 -->
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
    <div class="footer">
        <!-- 푸터공지 -->
        <div class="notice">
            <div class="wrap"><a href="#mode_nav">제2회 여우정원 로맨스 콘테스트 당선작 발표</a></div>
        </div>
        <!-- //푸터공지 -->

        <!-- 푸터내용 -->
        <div class="wrap">
            <!-- 푸터고객링크 -->
            <nav>
                <ul class="customer-link">
                    <li><a href="#mode_nav">이용약관</a></li>
                    <li><a href="#mode_nav">개인정보취급방침</a></li>
                    <li><a href="#mode_nav">고객센터</a></li>
                    <li><a href="#mode_nav">구슬충전</a></li>
                </ul>
            </nav>

            <!-- //푸터고객링크 -->

            <!-- 푸터사이트정보 -->
            <div class="copyright">
                <p>
                    여우정원의 모든 글은 작성자의 허락없이 타사이트에 게시할 수 없습니다.<br>
                    소설을 파일로 변환하여 공유, 또는 전송행위는 저작권법에 의거 고발될 수 있습니다.<br>
                    ㈜여우정원 / 대표 고광택 / 사업자 등록번호 123-45-78901 / 통신판매업 제 2016-서울강남-123호<br>
                    서울시 강남구 역삼동 123-4 여우빌딩 5층<br>
                    개인정보관리책임자 security@foxygarden.com<br>
                    Copyright ⓒ foxygarden co.,Ltd. All Rights Reserved.
                </p>
            </div>
            <!-- //푸터사이트정보 -->

            <!-- 패밀리사이트 -->
            <div class="family-site">
                <div class="select-link">
                    <button type="button">패밀리사이트</button>
                    <ul>
                        <li><a href="#mode_nav">패밀리 사이트1</a></li>
                        <li><a href="#mode_nav">패밀리 사이트2</a></li>
                    </ul>
                </div>
            </div>
            <!-- //패밀리사이트 -->
        </div>
        <!-- //푸터내용 -->
    </div>
    <!-- //푸터 -->
@endsection