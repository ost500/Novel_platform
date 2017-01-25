@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 댓글목록 -->
                <div class="comments comments--manage">
                    <div class="comment-list-header">
                        <h2 class="title">일반 댓글 관리</h2>
                        <span class="count">25</span>
                        <!-- 댓글정렬 -->
                        <div class="sort-nav sort-nav--comment">
                            <nav>
                                <ul>
                                    <li><a href="#mode_nav" class="is-active">최신순</a></li>
                                    <li><a href="#mode_nav">등록순</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- //댓글정렬 -->
                    </div>
                    <ul class="comment-list">
                        <li>
                            <div class="comment-wrap is-reply">
                                <div class="comment-info"><span class="parent-subject">&lt;검든꽃&gt; 기다무에 떴어요</span><span
                                            class="writer">불면증사탕</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>저도 이북파라서 그냥 기다리려구요~ 카카오는 그래도 네웹이랑은 다르니까 2017년 안에는 나오지 않을까 하는 생각...</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">1분 전</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap is-reply">
                                <div class="comment-info"><span class="parent-subject">&lt;검든꽃&gt; 기다무에 떴어요</span><span
                                            class="writer">불면증사탕</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>제가 알기론 카카오 자체브랜드로 알고 있어요~~ 리디북스 나인 같은거요.</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">5분 전</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">다이어트와 로설의 상관관계</span><span
                                            class="writer">골라읽기</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>맞는 말 같아요ㅋㅋㅋ</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">1시간 전</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">새해 첫 날부터 빵 터져서 왔어요</span><span
                                            class="writer">돼지거북</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>하야하라!!!</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">2시간 전</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">연애를 걸다 - 서정윤</span><span
                                            class="writer">블랙빈</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>리뷰가 참 보고 싶게 잘 쓰셨네요+_+ 저도 이번에 한번 정주행 달려까요?</p>
                                </div>
                                <div class="comment-etc-info">독자추천게시판<span class="datetime">4시간 전</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">아파트 주차구역...</span><span
                                            class="writer">애니스</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>그거 범칙금 무는 게 맞을걸요. 아파트 지하주차장꺼 위반시 신고하면 벌금나오던데..</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">2016.12.31</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">시대물 추천해주세요.</span><span
                                            class="writer">프린</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>망의 연월 추천드려요.<br>찾아보시면 제가 리뷰 남긴것도 있어요!</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">2016.12.30</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">올해가 얼마 안남았네요!</span><span
                                            class="writer">해피라이프</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>이름 참 누가 지었(?)는지...<br>병신년이라는 이름답게 사건 사고가 엄청 많았던..<br>내년엔 순탄했음 좋겠네요.</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">2016.12.29</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">드라마 도깨비 보신 분ㅠ.ㅠ</span><span
                                            class="writer">단비내림</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>와, 공유 진짜 멋있는듯!</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">2016.12.24</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">매혹당하다 읽으신 분 계세요?</span><span
                                            class="writer">반짝반짝이야</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>피폐물은 그래서 힘들죠.....</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">2016.12.24</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">aaaaaa</span><span
                                            class="writer">bbbbb</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>ccccccc</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">1시간 전</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">aaaaaa</span><span
                                            class="writer">bbbbb</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>ccccccc</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span class="datetime">1시간 전</span></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- //댓글목록 -->
                <!-- 페이징 -->
                <div class="page-nav">
                    <nav>
                        <ul>
                            <!--<li><a href="#mode_nav" class="prev-page"><span>이전</span></a></li>-->
                            <li><a href="#mode_nav" class="current-page">1</a></li>
                            <li><a href="#mode_nav">2</a></li>
                            <li><a href="#mode_nav">3</a></li>
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

@endsection