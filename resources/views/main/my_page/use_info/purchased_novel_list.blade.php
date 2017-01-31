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
                    <h2 class="title">소설 구매내역</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--order">
                    <caption>소설 구매내역 목록</caption>
                    <thead>
                    <tr>
                        <th>구매일</th>
                        <th>작품명</th>
                        <th>구매내역</th>
                        <th>상태</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-datetime2">2016.12.31 17:11</td>
                        <td class="col-subject">고백게임 35화</td>
                        <td class="col-detail">1조각</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.31 17:08</td>
                        <td class="col-subject">고백게임 34화</td>
                        <td class="col-detail">1조각</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.31 17:05</td>
                        <td class="col-subject">고백게임 33화</td>
                        <td class="col-detail">1조각</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.31 16:52</td>
                        <td class="col-subject">망의 연월 9화</td>
                        <td class="col-detail">1조각</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.31 16:52</td>
                        <td class="col-subject">망의 연월 9화</td>
                        <td class="col-detail">1조각</td>
                        <td class="col-state"><span class="is-cancel">취소</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.31 16:49</td>
                        <td class="col-subject">망의 연월 8화</td>
                        <td class="col-detail">1조각</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.31 16:47</td>
                        <td class="col-subject">망의 연월 7화</td>
                        <td class="col-detail">1조각</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.31 16:44</td>
                        <td class="col-subject">망의 연월 6화</td>
                        <td class="col-detail">1구슬</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.31 16:42</td>
                        <td class="col-subject">망의 연월 5화</td>
                        <td class="col-detail">1구슬</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.31 16:35</td>
                        <td class="col-subject">망의 연월 4화</td>
                        <td class="col-detail">1구슬</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.31 16:31</td>
                        <td class="col-subject">망의 연월 3화</td>
                        <td class="col-detail">1구슬</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.30 09:12</td>
                        <td class="col-subject">낙원연가 21화</td>
                        <td class="col-detail">1구슬</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.29 18:22</td>
                        <td class="col-subject">연애한도초과 36화</td>
                        <td class="col-detail">1구슬</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.29 13:48</td>
                        <td class="col-subject">초콜릿 객잔 702번지 17화</td>
                        <td class="col-detail">1구슬</td>
                        <td class="col-state"><span>구매</span></td>
                    </tr>
                    <tr>
                        <td class="col-datetime2">2016.12.29 13:48</td>
                        <td class="col-subject">초콜릿 객잔 702번지 17화</td>
                        <td class="col-detail">1조각</td>
                        <td class="col-state"><span class="is-cancel">취소</span></td>
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