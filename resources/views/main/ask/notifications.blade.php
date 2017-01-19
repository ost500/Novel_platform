@extends('../layouts.main_layout')
@section('content')
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            @include('main.ask.left_sidebar')
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">공지사항</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--notice">
                    <caption>공지사항 목록</caption>
                    <thead>
                    <tr>
                        <th>분류</th>
                        <th>제목</th>
                        <th>등록일</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-category">오류</td>
                        <td class="col-subject">
                            <a href="#mode_nav">로맨스 판타지 로딩현상 수정 안내 (해결완료)</a>
                        </td>
                        <td class="col-datetime">05:03:21</td>
                    </tr>
                    <tr>
                        <td class="col-category">업데이트</td>
                        <td class="col-subject">
                            <a href="#mode_nav">안드로이드 앱 1.5버젼 업데이트</a>
                        </td>
                        <td class="col-datetime">2016.07.21</td>
                    </tr>
                    <tr>
                        <td class="col-category">안내</td>
                        <td class="col-subject">
                            <a href="#mode_nav">여우정원 여름 휴가 안내입니다.</a>
                        </td>
                        <td class="col-datetime">2016.07.20</td>
                    </tr>
                    <tr>
                        <td class="col-category">안내</td>
                        <td class="col-subject">
                            <a href="#mode_nav">7월 19일 (화) 정기점검 안내</a>
                        </td>
                        <td class="col-datetime">2016.07.19</td>
                    </tr>
                    <tr>
                        <td class="col-category">공모전</td>
                        <td class="col-subject">
                            <a href="#mode_nav">제2회 여우정원 로맨스 콘테스트 당선작 발표</a>
                        </td>
                        <td class="col-datetime">2016.07.15</td>
                    </tr>
                    <tr>
                        <td class="col-category">안내</td>
                        <td class="col-subject">
                            <a href="#mode_nav">여우정원 개인정보 취급방침 변경</a>
                        </td>
                        <td class="col-datetime">2016.07.12</td>
                    </tr>
                    <tr>
                        <td class="col-category">안내</td>
                        <td class="col-subject">
                            <a href="#mode_nav">Internet Explorer 8, 9 지원 중단 안내</a>
                        </td>
                        <td class="col-datetime">2016.07.01</td>
                    </tr>
                    <tr>
                        <td class="col-category">안내</td>
                        <td class="col-subject">
                            <a href="#mode_nav">비로그인 계정의 휴면계정 전환 안내</a>
                        </td>
                        <td class="col-datetime">2016.06.29</td>
                    </tr>
                    <tr>
                        <td class="col-category">안내</td>
                        <td class="col-subject">
                            <a href="#mode_nav">6월 26일 (화) 정기점검 안내</a>
                        </td>
                        <td class="col-datetime">2016.06.26</td>
                    </tr>
                    <tr>
                        <td class="col-category">안내</td>
                        <td class="col-subject">
                            <a href="#mode_nav">SKT 휴대폰 본인확인 서비스 일시 중단</a>
                        </td>
                        <td class="col-datetime">2016.06.25</td>
                    </tr>
                    </tbody>
                </table>
                <!-- //게시판목록 -->

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