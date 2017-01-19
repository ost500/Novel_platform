@extends('../layouts.main_layout')
@section    ('content')
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            @include('main.ask.left_sidebar')
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- FAQ 도움말 -->
                <div class="faq-category-box">
                    <strong class="title">여우정원을 처음 이용하시나요?</strong>
                    <ul>
                        <li class="category1"><a href="#mode_nav">사이트 이용</a></li>
                        <li class="category2"><a href="#mode_nav">회원정보</a></li>
                        <li class="category3"><a href="#mode_nav">구매/결제</a></li>
                        <li class="category4"><a href="#mode_nav">작가/연재</a></li>
                        <li class="category5"><a href="#mode_nav">App</a></li>
                    </ul>
                </div>
                <form class="faq-search-form" name="faq_search_form" action="#">
                    <fieldset>
                        <legend class="un-hidden">도움말 검색</legend>
                        <input type="text" class="text1" placeholder="여우정원에 궁금한 것을 물어보세요!" title="검색어">
                        <button class="userbtn userbtn--search">검색</button>
                    </fieldset>
                </form>
                <!-- //FAQ 도움말 -->

                <!-- 게시판목록 -->
                <div class="list-header">
                    <h2 class="title title--bold">자주 묻는 질문 Best</h2>
                </div>
                <table class="bbs-list bbs-list--notice">
                    <caption>자주 묻는 질문 목록</caption>
                    <thead>
                    <tr>
                        <th>분류</th>
                        <th>제목</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-category">사이트 이용</td>
                        <td class="col-subject">
                            <a href="#mode_nav">여우정원을 처음 이용하는데 이용방법을 잘 모르겠어요.</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-category">회원정보</td>
                        <td class="col-subject">
                            <a href="#mode_nav">아이디와 비밀번호를 잊어버렸어요.</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-category">회원정보</td>
                        <td class="col-subject">
                            <a href="#mode_nav">성인인증은 어떻게 받나요?</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-category">구매/결제</td>
                        <td class="col-subject">
                            <a href="#mode_nav">구슬이 뭔가요?</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-category">작가/연재</td>
                        <td class="col-subject">
                            <a href="#mode_nav">작가 신청은 어떻게 하나요?</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-category">작가/연재</td>
                        <td class="col-subject">
                            <a href="#mode_nav">글을 연재하고 싶어요. 작품 등록은 어떻게 하나요?</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-category">APP</td>
                        <td class="col-subject">
                            <a href="#mode_nav">APP 사용법을 잘 모르겠어요.</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!-- //게시판목록 -->

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