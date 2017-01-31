@extends('../layouts.main_layout')
@section('content')
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 조각이란 -->
                <div class="box-header">
                    <h2 class="title">조각이란?</h2>
                    <p class="title-desc">여우정원에서 제공하는 서비스 결제 수단입니다.<br>한 개의 조각은 한 개의 구슬처럼 사용할 수 있습니다.</p>
                </div>
                <div class="my-item">
                    <i class="piece3-icon"></i><span class="item-name">내가 가진 조각</span><strong class="count">0 개</strong>
                </div>
                <!-- //조각이란 -->

                <!-- 페이지헤더 -->
                <div class="list-header list-header--piece">
                    <h2 class="title">조각관리</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--piece">
                    <caption>조각관리 목록</caption>
                    <thead>
                    <tr>
                        <th>적립일</th>
                        <th>적립내역</th>
                        <th>적립조각</th>
                        <th>소멸일</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-datetime2">2016.11.14 18:01</td>
                        <td class="col-subject">기간 한정 특별 이벤트</td>
                        <td class="col-payment">1조각</td>
                        <td class="col-datetime3">2016.11.15 23:59</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.11.03 19:08</td>
                        <td class="col-subject">구슬 충전 추가 보너스</td>
                        <td class="col-payment">35조각</td>
                        <td class="col-datetime3"></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.09.03 01:09</td>
                        <td class="col-subject">여우정원 이용자 설문조사 참여</td>
                        <td class="col-payment">10조각</td>
                        <td class="col-datetime3">2016.09.30 23:59</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.08.07 21:35</td>
                        <td class="col-subject">구슬 충전 추가 보너스</td>
                        <td class="col-payment">3조각</td>
                        <td class="col-datetime3"></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.08.04 20:53</td>
                        <td class="col-subject">기간 한정 특별 이벤트</td>
                        <td class="col-payment">1조각</td>
                        <td class="col-datetime3">2016.12.31 23:59</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.04.25 04:17</td>
                        <td class="col-subject">기간 한정 특별 이벤트</td>
                        <td class="col-payment">2조각</td>
                        <td class="col-datetime3">2016.12.31 23:59</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.04.07 19:38</td>
                        <td class="col-subject">기간 한정 특별 이벤트</td>
                        <td class="col-payment">1조각</td>
                        <td class="col-datetime3">2016.12.31 23:59</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.03.28 22:04</td>
                        <td class="col-subject">구슬 충전 추가 보너스</td>
                        <td class="col-payment">99조각</td>
                        <td class="col-datetime3"></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.02.24 00:16</td>
                        <td class="col-subject">구슬 충전 추가 보너스</td>
                        <td class="col-payment">15조각</td>
                        <td class="col-datetime3"></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.11.28 09:57</td>
                        <td class="col-subject">구슬 충전 추가 보너스</td>
                        <td class="col-payment">3조각</td>
                        <td class="col-datetime3"></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.30 10:58</td>
                        <td class="col-subject">구슬 충전 추가 보너스</td>
                        <td class="col-payment">15조각</td>
                        <td class="col-datetime3"></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.29 22:04</td>
                        <td class="col-subject">구슬 충전 추가 보너스</td>
                        <td class="col-payment">3조각</td>
                        <td class="col-datetime3"></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.21 18:53</td>
                        <td class="col-subject">기간 한정 특별 이벤트</td>
                        <td class="col-payment">1조각</td>
                        <td class="col-datetime3">2016.12.31 23:59</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.07 20:59</td>
                        <td class="col-subject">구슬 충전 추가 보너스</td>
                        <td class="col-payment">35조각</td>
                        <td class="col-datetime3"></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.07 02:58</td>
                        <td class="col-subject">기간 한정 특별 이벤트</td>
                        <td class="col-payment">1조각</td>
                        <td class="col-datetime3">2016.12.31 23:59</td>
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
                            <li><a href="#mode_nav">6</a></li>
                            <li><a href="#mode_nav">7</a></li>
                            <li><a href="#mode_nav">8</a></li>
                            <li><a href="#mode_nav">9</a></li>
                            <li><a href="#mode_nav">10</a></li>
                            <li><a href="#mode_nav" class="next-page"><span>다음</span></a></li>
                        </ul>
                    </nav>
                </div>
                <!-- //페이징 -->
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->


@endsection