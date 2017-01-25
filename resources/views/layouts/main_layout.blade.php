<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>여우정원</title>
    <link rel="stylesheet" href="/front/css/font/nanum_barun_gothic.css" type="text/css">
    <link rel="stylesheet" href="/front/css/font/nanum_gothic.css" type="text/css">
    <link rel="stylesheet" href="/front/css/font/nanum_myeongjo.css" type="text/css">
    <link rel="stylesheet" href="/front/css/icons.css" type="text/css">
    <link rel="stylesheet" href="/front/css/style.css" type="text/css">
    <link rel="stylesheet" href="/front/css/sub.css?v={{time()}}" type="text/css">
    <link rel="stylesheet" href="/front/css/main.css?v={{time()}}" type="text/css">
    <link rel="stylesheet" href="/front/css/register.css" type="text/css">

    <script src="/front/js/jquery-1.12.4.min.js"></script>
    <script src="/front/js/jquery.easing.min.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.min.js"></script>
    <!--[if lte IE 8]>
    <script src="/front/js/html5shiv.min.js"></script>
    <script src="/front/js/respond.min.js"></script>
    <script src="/front/js/bootbox.min.js"></script>


    <![endif]-->
</head>
<body>
<a class="skip-content" href="#gnb">주요서비스 바로가기</a>
<a class="skip-content" href="#content">본문 바로가기</a>

<script>
    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
    ]); ?>
</script>

<!-- 모드 -->
<div class="mode-nav" id="mode_nav">
    <ul class="wrap">
        <li class="nav1 is-active"><a href="{{ route('root') }}">여우정원 홈</a></li>
        <li class="nav2"><a href="{{ route('author.index') }}">여우정원 작가홈</a></li>
    </ul>
</div>
<!-- //모드 -->
<!-- 헤더 -->
<header class="header" id="header">
    <div class="header-top wrap">
        <h1 class="logo wrap"><a href="{{ route('root') }}">여우정원</a></h1>
        <!-- 사용자메뉴 -->
        <div class="usermenu">
            <!-- 방문자버튼 -->
            <div class="login-area">
                @if(Auth::check())
                    <button type="button" class="userbtn userbtn--open" id="more_btns_open">사용자메뉴</button>
                    <div class="more-btns" id="more_btns">
                        <div class="layer-popup-wrap">
                            <a href="{{ route('my_page.index') }}" class="userbtn userbtn--myinfo">마이메뉴</a>
                            <!-- 마이페이지팝업 -->
                            <section class="layer-popup layer-popup--myinfo">
                                <div class="inner">
                                    <h2 class="myinfo-user-name">Kimdal</h2>
                                    <ul class="myinfo-nav clr">
                                        <li class="link1">
                                            보유구슬<br>
                                            <a href="#mode_nav">1,170개</a>
                                        </li>
                                        <li class="link2">
                                            선호작<br>
                                            <a href="#mode_nav">32작품</a>
                                        </li>
                                        <li class="link3">
                                            MY정보<br>
                                            <a href="{{route('my_page.index')}}">관리하기</a>
                                        </li>
                                    </ul>
                                    <div class="logout-btn"><a href="{{url('/logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">로그아웃</a></div>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </section>
                            <!-- //마이페이지팝업 -->
                        </div>
                        <div class="layer-popup-wrap">
                            <a href="{{route('mails.received')}}" class="userbtn userbtn--memo">쪽지</a>
                            <!-- 쪽지팝업 -->
                            <section class="layer-popup layer-popup--memo">
                                <div class="inner">
                                    <div class="alarm-container">
                                        <h2 class="alarm-title">받은쪽지함</h2>
                                        <ul class="alarm-list">
                                            <li class="is-new">
                                                <div class="thumb">
                                                    <img src="/front/imgs/thumb/memo1.png" alt="">
                                                </div>
                                                <div class="post">
                                                    <p class="post-content"><a href="#mode_nav">와이엠북스입니다.</a></p>
                                                    <p class="post-datetime">2016.11.16</p>
                                                </div>
                                            </li>
                                            <li class="is-new">
                                                <div class="thumb">
                                                    <img src="/front/imgs/thumb/memo2.png" alt="">
                                                </div>
                                                <div class="post">
                                                    <p class="post-content"><a href="#mode_nav">앞편좀 하루 열어주세요.</a></p>
                                                    <p class="post-datetime">2016.11.16</p>
                                                </div>
                                            </li>
                                            <li class="is-new">
                                                <div class="thumb">
                                                    <img src="/front/imgs/thumb/memo3.png" alt="">
                                                </div>
                                                <div class="post">
                                                    <p class="post-content"><a href="#mode_nav">안녕하세요. 이비안입니다.</a></p>
                                                    <p class="post-datetime">2016.11.15</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="/front/imgs/thumb/memo4.png" alt="">
                                                </div>
                                                <div class="post">
                                                    <p class="post-content"><a href="#mode_nav">작가님, 소울에임 편집팀입니다.</a>
                                                    </p>
                                                    <p class="post-datetime">2016.11.15</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="/front/imgs/thumb/memo1.png" alt="">
                                                </div>
                                                <div class="post">
                                                    <p class="post-content"><a href="#mode_nav">감사합니다.</a></p>
                                                    <p class="post-datetime">2016.11.14</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <a href="#mode_nav" class="alarm-more-btn">더보기</a>
                                    </div>
                                    <a href="#mode_nav" class="alarm-bottom-more-btn">더보기</a>
                                </div>
                            </section>
                            <!-- //쪽지팝업 -->
                        </div>
                        <div class="layer-popup-wrap">
                            <a href="#mode_nav" class="userbtn userbtn--alarm">알림</a>
                            <!-- 소식팝업 -->
                            <section class="layer-popup layer-popup--news">
                                <div class="inner">
                                    <div class="alarm-container">
                                        <h2 class="alarm-title">소식</h2>
                                        <ul class="alarm-list">
                                            <li class="is-new">
                                                <div class="thumb">
                                                    <img src="/front/imgs/thumb/alarm1.png" alt="">
                                                </div>
                                                <div class="post">
                                                    <p class="post-content"><a href="#mode_nav">고백게임 작가 이비안의 신작 <b
                                                                    class="novel-title">탐닉의 밤</b>이 신규 등록되었습니다.</a></p>
                                                    <p class="post-datetime">1시간 전</p>
                                                </div>
                                            </li>
                                            <li class="is-new">
                                                <div class="thumb">
                                                    <img src="/front/imgs/thumb/alarm2.png" alt="">
                                                </div>
                                                <div class="post">
                                                    <p class="post-content"><a href="#mode_nav">지난달 베스트 1위 작품 공개! 2016년
                                                            5월의
                                                            판매 1위는?</a></p>
                                                    <p class="post-datetime">2시간 전</p>
                                                </div>
                                            </li>
                                            <li class="is-new">
                                                <div class="thumb">
                                                    <img src="/front/imgs/thumb/alarm3.png" alt="">
                                                </div>
                                                <div class="post">
                                                    <p class="post-content"><a href="#mode_nav">6월 둘째 주, 유료연재 주간 베스트 작품
                                                            TOP
                                                            5를 소개합니다!</a></p>
                                                    <p class="post-datetime">1일 전</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="/front/imgs/thumb/alarm4.png" alt="">
                                                </div>
                                                <div class="post">
                                                    <p class="post-content"><a href="#mode_nav">오늘 가장 많이 읽은 유료연재
                                                            소설은?</a>
                                                    </p>
                                                    <p class="post-datetime">1일 전</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="/front/imgs/thumb/alarm5.png" alt="">
                                                </div>
                                                <div class="post">
                                                    <p class="post-content"><a href="#mode_nav">로맨스판타지 10% 할인 이벤트!</a>
                                                    </p>
                                                    <p class="post-datetime">2일 전</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <a href="#mode_nav" class="alarm-more-btn">더보기</a>
                                    </div>
                                    <a href="#mode_nav" class="alarm-bottom-more-btn">더보기</a>
                                </div>
                            </section>
                            <!-- //알림팝업 -->
                        </div>
                    </div>
                @else
                <!-- 방문자버튼 -->

                    <a href="#mode_nav" class="userbtn userbtn--login" data-modal-id="login_form"
                       @if($errors->has('email') || $errors->has('password')) data-modal-start @endif >로그인</a>

                @endif
            </div>
            <!-- 검색버튼 -->
            <div class="search-area">
                <a href="#search_form" class="userbtn userbtn--search" data-modal-id="search_form">검색</a>
                <a href="#mode_nav" class="userbtn userbtn--scrap">선호작</a>
            </div>
        </div>
        <!-- //사용자메뉴 -->
    </div>
    <!-- GNB -->
    <nav class="gnb" id="gnb">
        <h2 class="hidden">주요서비스</h2>
        <div class="wrap" id="gnb_wrap">
            <ul class="gnb-depth1 clr">
                <li>
                    <a href="{{route('bests')}}">베스트</a>
                    <ul class="gnb-depth2">
                        <li><a href="{{route('bests')}}">유료소설 베스트</a></li>
                        <li><a href="{{route('bests',['free_or_charged'=>'free'])}}">무료소설 베스트</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('series')}}">연재</a>
                    <ul class="gnb-depth2">
                        <li><a href="{{route('series')}}">유료소설</a></li>
                        <li><a href="{{route('series',['free_or_charged'=>'free'])}}">무료소설</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#mode_nav">완결</a>
                    <ul class="gnb-depth2">
                        <li><a href="{{route('completed')}}">유료완결</a></li>
                        <li><a href="{{route('completed',['free_or_charged'=>'free'])}}">무료완결</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#mode_nav">커뮤니티</a>
                    <ul class="gnb-depth2">
                        <li><a href="{{route('free_board')}}">자유게시판</a></li>
                        <li><a href="{{route('reader_reco')}}">독자추천</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#mode_nav">고객센터</a>
                    <ul class="gnb-depth2">
                        <li><a href="{{route('ask.faqs').'?best'}}">자주묻는 질문</a></li>
                        <li><a href="{{route('ask.questions')}}">1:1 문의</a></li>
                        <li><a href="#mode_nav">이용방법</a></li>
                        <li><a href="{{route('ask.notifications')}}">공지사항</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="gnb-bg"></div>
    </nav>
    <!-- //GNB -->
    <!-- 로그인모달 -->
    <div id="login_form" class="login-modal" tabindex="0">
        <section class="login-form">
            <h2 class="hidden">로그인</h2>
            <div class="wrap">
                <div class="login-aside">
                    <strong class="title">여우정원 계정</strong>
                    <p class="title-desc">지금 여우정원에서 다양한 로맨스 소설을 만나보세요.</p>
                    <p class="str str--intro">
                        <strong>여우정원은</strong> 로맨스를 사랑하는 독자와 작가를 위한 로맨스 전문연재 사이트입니다.
                    </p>
                    <p class="str str--register">
                        <strong>회원가입</strong> 아직 여우정원의 회원이 아니라면 지금 바로 계정을 생성해 보세요.
                    </p>
                </div>
                <form role="form" method="POST" action="{{ url('/login') }}" class="login-form-box">
                    {{ csrf_field() }}
                    <fieldset>
                        <legend class="un-hidden">Login</legend>
                        <div class="field">
                            <input id="email" type="email" name="email" class="text2" title="아이디"
                                   value="{{ old('email') }}" placeholder="여우정원계정">
                            @if ($errors->has('email'))<span
                                    class="alert-msg is-active">{{ $errors->first('email') }}</span>@endif
                        </div>
                        <div class="field">
                            <input id="password" type="password" class="text2" title="비밀번호" name="password" required
                                   placeholder="비밀번호(4~16자리)">
                            @if ($errors->has('password'))<span
                                    class="alert-msg is-active">{{ $errors->first('password') }}</span>@endif
                        </div>
                        <div class="submit">
                            <button type="submit" class="btn btn--submit">로그인</button>
                        </div>
                        <div class="auto-login">
                            <span class="checkbox1"><input type="checkbox" name="remember" id="auto_login_check"><label
                                        for="auto_login_check">로그인 상태 유지</label></span>
                            <p class="auto-login-notice" id="auto_login_notice">개인정보 보호를 위해 개인 PC에서만 사용하세요.</p>
                        </div>
                        <div class="aside-link">
                            <a href="#mode_nav">아이디 찾기</a><i></i><a href="{{ url('/password/reset') }}">비밀번호 찾기</a>

                        </div>
                    </fieldset>
                </form>
            </div>
        </section>
    </div>
    <!-- //로그인모달 -->
    <!-- 통합검색모달 -->
    <div id="search_form" class="search-modal" tabindex="0">
        <form name="search_form" action="#" class="search-form">
            <fieldset class="wrap clr">
                <legend>검색</legend>
                <div class="search-form-basic">
                    <strong class="search-form-title">일반검색</strong>
                    <span class="selectbox">
                        <select title="검색옵션">
                            <option>전체</option>
                            <option>서브</option>
                            <option>서브2</option>
                        </select>
                    </span>
                    <div class="input"><input type="text" class="text1" title="검색어"></div>
                </div>
                <div class="search-form-hash-tag">
                    <strong class="search-form-title">해시태그 검색</strong>
                    <div class="input"><input type="text" class="text1" title="해시태그 검색어"></div>
                    <div class="submit">
                        <button type="submit" class="userbtn userbtn--search-submit">검색</button>
                    </div>
                    <div class="hot-hash-tag">
                        <strong class="title">자주 찾는 해시태그</strong>
                        <div class="list">
                            <a href="#mode_nav">#현대</a> <a href="#mode_nav">#시대</a> <a href="#mode_nav">#로맨스판타지</a><br>
                            <a href="#mode_nav">#메디컬</a> <a href="#mode_nav">#남장여자</a> <a href="#mode_nav">#회귀물 <a
                                        href="#mode_nav">#원나잇</a> <a href="#mode_nav">#계약물 <a href="#mode_nav">#정략결혼 <a
                                                href="#mode_nav">#나쁜남자</a> <a href="#mode_nav">#재벌남</a> <a
                                                href="#mode_nav">#후회남</a> <a href="#mode_nav">#철벽녀 <a href="#mode_nav">#로맨틱코미디</a>
                                            <a href="#mode_nav">#피폐물</a> <a href="#mode_nav">#잔잔물</a> <a
                                                    href="#mode_nav">#신파</a>
                                        </a>
                                    </a>
                                </a>
                            </a>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <!-- //통합검색모달 -->
</header>
<!-- //헤더 -->

@yield('content')
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
<script src="/front/js/common.js"></script>
<!--[if lte IE 9]>
<script src="js/jquery.placeholder.min.js"></script>
<script> $(document).ready(function () {
    $('input, textarea').placeholder();
}); </script>
<![endif]-->
<!--[if lte IE 8]>
<script src="js/selectivizr-min.js"></script>
<script src="js/checked-polyfill.min.js"></script>
<script> $(document).ready(function () {
    $('input:radio, input:checkbox').checkedPolyfill();
}); </script>
<![endif]-->
</body>
</html>