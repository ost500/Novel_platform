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
                        <h2 class="title">소설 댓글 관리</h2>
                        <span class="count">231</span>
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
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">은행의 공녀님</span><span
                                            class="writer">세사외</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>잘보고 가요~~</p>
                                </div>
                                <div class="comment-etc-info">45화<span class="datetime">1시간 전</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">고양이는 아홉번을 산다</span><span
                                            class="writer">밤바다</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>어~ 제 예상이 현실이 되었어요 ㅎㅎ 정해져 있던 스토리라인이겠지만~ 기쁩니다~ㅋㅋ</p>
                                </div>
                                <div class="comment-etc-info">52화<span class="datetime">2016.12.31</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap is-reply">
                                <div class="comment-info"><span class="parent-subject">고양이는 아홉번을 산다</span><span
                                            class="writer">밤바다</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>리메하신 거 맞아요~ 제가 전에 본 기억이 있어요~</p>
                                </div>
                                <div class="comment-etc-info">8화<span class="datetime">2016.12.31</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">그녀에게 접근하는 이유</span><span
                                            class="writer">다락방마녀</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p><i class="secret-icon">비밀</i> 작가님 오타가 있어요. 외않되가 아니라 왜 안 돼 입니다!</p>
                                </div>
                                <div class="comment-etc-info">11화<span class="datetime">2016.12.30</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">Ever ever after</span><span
                                            class="writer">이보라</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>헐... 얘네 죽어요?!</p>
                                </div>
                                <div class="comment-etc-info">20화<span class="datetime">2016.12.30</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">완벽한 죽음을 위하여</span><span
                                            class="writer">홍마루</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>아싸 1등!</p>
                                </div>
                                <div class="comment-etc-info">17화<span class="datetime">2016.12.30</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">핸드 메이드</span><span
                                            class="writer">석류스프</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>완결 축하드려요!</p>
                                </div>
                                <div class="comment-etc-info">143화<span class="datetime">2016.12.28</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">모렛타[moretta]</span><span
                                            class="writer">잭라빈</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>크리스마스 5행시 이벤트 참여합니다.<br><br>
                                        크 : 크흑흑흙흑흑<br>리 : 리흑흑엉으허으흙<br>스 : 스으으읗흑어으어으어<br>마 : 마으어으어으엉<br>스 :
                                        스흑흑어응허엉엉<br><br>(....)
                                    </p>
                                </div>
                                <div class="comment-etc-info">46화<span class="datetime">2016.12.25</span></div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">짐승같은 그대</span><span
                                            class="writer">라가머핀</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>에잇! 커플만 환영받는 더러운 세상!</p>
                                </div>
                                <div class="comment-etc-info">30화<span class="datetime">2016.12.24</span></div>
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

@endsection