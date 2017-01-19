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
                    <h2 class="title">1:1문의</h2>
                    <div class="links">
                        <a href="#mode_nav" class="is-active">문의하기</a><a href="#mode_nav">문의내역</a>
                    </div>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판쓰기 -->
                <div class="bbs-write">
                    <div class="item-list item-list--bbs">
                        <div class="item-rows">
                            <div class="label">안내</div>
                            <p class="input input--notice">문의는 최대한 빠르게 답변드리고 있으나, 주말, 공휴일 문의는 답변이 지연될 수 있는 점 양해 부탁드립니다.</p>
                        </div>
                        <div class="item-rows">
                            <div class="label">문의유형</div>
                            <div class="input input--checklist">
                                <label class="checkbox2"><input type="radio" name="category" checked><span>사이트이용</span></label>
                                <label class="checkbox2"><input type="radio" name="category"><span>회원정보</span></label>
                                <label class="checkbox2"><input type="radio" name="category"><span>구매/결제</span></label>
                                <label class="checkbox2"><input type="radio" name="category"><span>작가/연재</span></label>
                                <label class="checkbox2"><input type="radio" name="category"><span>APP</span></label>
                                <label class="checkbox2"><input type="radio" name="category"><span>건의사항</span></label>
                                <label class="checkbox2"><input type="radio" name="category"><span>기타</span></label>
                            </div>
                        </div>
                        <div class="item-cols">
                            <label for="bbs_subject" class="label">제목</label>
                            <div class="input"><input type="text" class="text2" id="bbs_subject"></div>
                        </div>
                        <div class="item-cols">
                            <label for="bbs_content" class="label">내용</label>
                            <div class="input"><textarea class="textarea2" rows="10" id="bbs_content"></textarea></div>
                        </div>
                        <div class="item-cols">
                            <span class="label">이미지</span>
                            <div class="input input--attach">
                            <span class="typefile">
                                <span class="typefile-button"><i class="plus-icon"></i>첨부파일</span>
                                <span class="typefile-path">선택된 파일 없음</span>
                                <input type="file" class="typefile-input" title="첨부파일">
                            </span>
                                <p class="attach-desc">
                                    JPG, GIF, PNG 파일 형식의 이미지를 최대 3장까지 첨부할 수 있습니다.(5MB 이하)<br>
                                    이미지 첨부는 필수 항목이 아닙니다.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="submit">
                        <button class="btn btn--special" type="submit">문의하기</button>
                    </div>
                </div>
                <!-- //게시판쓰기 -->

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