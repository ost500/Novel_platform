@extends('../layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">결제내역</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--payment">
                    <caption>결제내역 목록</caption>
                    <thead>
                    <tr>
                        <th>구매일</th>
                        <th>결제내역</th>
                        <th>결제수단</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-datetime2">2016.12.16 14:14</td>
                        <td class="col-subject">10,000원을 결제하였습니다.</td>
                        <td class="col-payment">휴대폰</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">실패</td>
                        <td class="col-subject">입금 기간이 만료되었습니다.</td>
                        <td class="col-payment">가상계좌</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.09.03 01:09</td>
                        <td class="col-subject">10,000원을 결제하였습니다.</td>
                        <td class="col-payment">계좌이체</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.08.07 21:35</td>
                        <td class="col-subject">50,000원을 결제하였습니다.</td>
                        <td class="col-payment">휴대폰</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.08.04 20:53</td>
                        <td class="col-subject">30,000원을 결제하였습니다.</td>
                        <td class="col-payment">휴대폰</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.04.25 04:17</td>
                        <td class="col-subject">10,000원을 결제하였습니다.</td>
                        <td class="col-payment">휴대폰</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.04.07 19:38</td>
                        <td class="col-subject">10,000원을 결제하였습니다.</td>
                        <td class="col-payment">휴대폰</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.03.28 22:04</td>
                        <td class="col-subject">3,000원을 결제하였습니다.</td>
                        <td class="col-payment">네이버페이</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.02.24 00:16</td>
                        <td class="col-subject">50,000원을 결제하였습니다.</td>
                        <td class="col-payment">카카오페이</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.11.28 09:57</td>
                        <td class="col-subject">10,000원을 결제하였습니다.</td>
                        <td class="col-payment">티머니</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.30 10:58</td>
                        <td class="col-subject">10,000원을 결제하였습니다.</td>
                        <td class="col-payment">신용카드</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.29 22:04</td>
                        <td class="col-subject">50,000원을 결제하였습니다.</td>
                        <td class="col-payment">유선전화</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.21 18:53</td>
                        <td class="col-subject">1,000원을 결제하였습니다.</td>
                        <td class="col-payment">컬쳐랜드</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.07 20:59</td>
                        <td class="col-subject">30,000원을 결제하였습니다.</td>
                        <td class="col-payment">해피머니</td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.07 02:58</td>
                        <td class="col-subject">10,000원을 결제하였습니다.</td>
                        <td class="col-payment">도서문화</td>
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