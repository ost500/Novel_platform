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
                    <h2 class="title">보낸 선물 내역</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--gift2">
                    <caption>보낸 선물 내역 목록</caption>
                    <thead>
                    <tr>
                        <th>보낸 날짜</th>
                        <th>보낸 선물</th>
                        <th>받은사람</th>
                        <th>상태</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-no-data" colspan="4">보낸 내역이 없습니다.</td>
                    </tr>
                    </tbody>
                </table>
                <!-- //게시판목록 -->

                <!-- 하단버튼 -->
                <div class="list-bottom-btns">
                    <div class="right-btns">
                        <a href="#gift_form" class="btn btn--special" data-modal-id="gift_form" data-modal-fullsize>구슬
                            선물하기</a>
                    </div>
                </div>
                <!-- //하단버튼 -->
                <!-- 페이징 -->
                <div class="page-nav">
                    <nav>
                        <ul>
                            <!--<li><a href="#mode_nav" class="prev-page"><span>이전</span></a></li>-->
                            <li><a href="#mode_nav" class="current-page">1</a></li>
                            <li><a href="#mode_nav" class="next-page"><span>다음</span></a></li>
                        </ul>
                    </nav>
                </div>
                <!-- //페이징 -->

                <!-- 공지 -->
                <p class="mypage-notice mypage-notice--gift2">
                    게시글이나 댓글의 아이디를 클릭하여 구슬을 선물할 수도 있습니다.<br>선물 받은 구슬과 조각은 환불 및 재선물이 되지 않습니다.
                </p>
                <!-- //공지 -->
            </div>
            <!-- //서브컨텐츠 -->

            <!-- 구슬선물하기 팝업 -->
            <section id="gift_form" class="fullsize-modal" tabindex="0">
                <div class="popup-container">
                    <button type="button" class="popup-close-btn" data-modal-close>닫기</button>
                    <div class="popup-header">
                        <h2 class="title">구슬 선물하기</h2>
                    </div>
                    <div class="popup-content">
                        <form name="gift_form" action="#" class="gift-form">
                            <div class="item-list">
                                <div class="item-cols">
                                    <label for="gift_user" class="label">받는사람</label>
                                    <div class="input input--user-search">
                                        <div class="search-input">
                                            <input type="text" id="gift_user" class="text1"
                                                   placeholder="아이디나 닉네임을 검색하세요.">
                                        </div>
                                        <button type="button" class="userbtn userbtn--search-submit">검색</button>
                                        <!-- 받는사람찾기결과 -->
                                        <div class="user-search-result">
                                            <div class="result-item">
                                                <span class="user-name">김달</span>
                                                <button type="button" class="delete-btn">삭제</button>
                                            </div>
                                            <div class="result-item">
                                                <span class="user-name">이비안</span>
                                                <button type="button" class="delete-btn">삭제</button>
                                            </div>
                                        </div>
                                        <!-- //받는사람찾기결과 -->
                                    </div>
                                </div>
                                <div class="item-cols">
                                    <label for="gift_msg" class="label">전할문구</label>
                                    <div class="input input--fullsize">
                                        <input type="text" id="gift_msg" class="text2"
                                               placeholder="공백 포함 최대 30자까지 가능합니다.">
                                    </div>
                                </div>
                                <div class="item-cols">
                                    <label for="gift_marble" class="label">구슬선물</label>
                                    <div class="input">
                                        <input type="text" id="gift_marble" class="text2" size="25">
                                        <span class="input-desc">구매한 구슬만 선물이 가능합니다.</span>
                                    </div>
                                </div>
                                <div class="my-item">
                                    <i class="marble3-icon"></i><span class="item-name">내가 가진 구슬</span><strong
                                            class="count">1,170 개</strong>
                                </div>
                            </div>
                            <div class="submit">
                                <button type="submit" class="btn btn--submit">선물보내기</button>
                            </div>
                        </form>
                    </div>
                    <button class="popup-close-btn" data-modal-close>닫기</button>
                </div>
            </section>
            <!-- //구슬선물하기 팝업 -->
            <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->


@endsection