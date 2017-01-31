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
                    <h2 class="title">받은 선물 내역</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--gift">
                    <caption>받은 선물 내역 목록</caption>
                    <thead>
                    <tr>
                        <th>보낸날짜</th>
                        <th>받은 선물</th>
                        <th>보낸사람</th>
                        <th>상태</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-datetime2">2016.12.05 17:11</td>
                        <td class="col-subject">망의 연월 추첨 이벤트 100구슬 지급</td>
                        <td class="col-from">림랑</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.11.30 17:08</td>
                        <td class="col-subject">룰렛 이벤트 10조각 당첨!</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.11.13 17:05</td>
                        <td class="col-subject">고백게임 이벤트 결제자 전원 20구슬 지급</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.10.24 16:52</td>
                        <td class="col-subject">서버 오류 10조각 보상</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.10.01 16:52</td>
                        <td class="col-subject">서버 오류 10조각 보상</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.10.01 16:49</td>
                        <td class="col-subject">출석 이벤트 4주차 40조각 지급</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.09.24 16:47</td>
                        <td class="col-subject">출석 이벤트 3주차 30조각 지급</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.09.17 16:44</td>
                        <td class="col-subject">출석 이벤트 2주차 20조각 지급</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.09.10 16:42</td>
                        <td class="col-subject">출석 이벤트 1주차 10조각 지급</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.08.01 16:35</td>
                        <td class="col-subject">여름 휴가 이벤트 5조각 지급</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.12.31 16:31</td>
                        <td class="col-subject">한 해 마무리 이벤트 3조각 지급</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span class="is-cancel">반송</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.11.06 09:12</td>
                        <td class="col-subject">누흔 추첨 이벤트 50구슬 지급</td>
                        <td class="col-from">림랑</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.10.19 18:22</td>
                        <td class="col-subject">고서버 오류 10조각 보상백게임</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.09.29 13:48</td>
                        <td class="col-subject">1+1 결제이벤트 50조각 지급</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2015.09.11 13:48</td>
                        <td class="col-subject">서버 오류 10조각 보상</td>
                        <td class="col-from">여우정원</td>
                        <td class="col-state"><span>수령</span></td>
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

                <!-- 공지 -->
                <p class="mypage-notice mypage-notice--gift">
                    선물 받은 구슬과 조각은 여우정원에 등록된 작품을 구매할 때 사용할 수 있습니다.<br>선물을 수령하지 않으면 30일 후 자동으로 반송됩니다.
                </p>
                <!-- //공지 -->
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