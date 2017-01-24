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
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">게시글 관리</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <form name="bbs_list" action="#">
                    <table class="bbs-list bbs-list--post-manage">
                        <caption>게시글 관리 목록</caption>
                        <thead>
                        <tr>
                            <th><label class="checkbox2"><input type="checkbox" id="list_all_check"><span></span><span
                                            class="hidden">전체선택</span></label></th>
                            <th>제목</th>
                            <th>등록일</th>
                            <th>조회수</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">글을 잘 쓰는 팁! 이라고 할 수 있을진 모르겠지만...</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">2</span>
                            </td>
                            <td class="col-datetime">03:41:29</td>
                            <td class="col-view">30</td>
                        </tr>

                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">눈이 가물가물한게</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">1</span>
                            </td>
                            <td class="col-datetime">00:46:41</td>
                            <td class="col-view">21</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">헉..뭐지..잠시안본사이..</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">6</span>
                            </td>
                            <td class="col-datetime">00:20:27</td>
                            <td class="col-view">23</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">조회수가 찔끔찔끔 오르니까 좋은 게 있어요</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">9</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">48</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">약빤연재재공지하고싶은데</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">5</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">86</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">안녕하신가영! 신곡나와서 추천하는 안녕하신가영 노래</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">1</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">22</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">우매한 자게인들을 위해</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">3</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">56</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">여러분이 생각하셨을때 어느 소설이 더 쓰기 쉬우신가요?</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">10</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">207</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">엑스레이 사진 보다가 뿅 간 적 있나요?</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">7</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">103</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">퉷</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">4</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">42</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">자다 일어났더니 더 피곤한거 같아염</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">3</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">24</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">챕터를 끝냈다는 기쁨에 분량을 몰아넣었더니...</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">4</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">94</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">전 바끠 감지능력을 가졌습니다...</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">6</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">45</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">한때 코난 팬으로써</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">5</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">54</td>
                        </tr>
                        <tr>
                            <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                  data-check-item><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="#mode_nav">뉴비에양! 늅늅!</a>
                                <span class="hidden">댓글 </span><span class="comment-cnt">11</span>
                            </td>
                            <td class="col-datetime">2016.06.20</td>
                            <td class="col-view">36</td>
                        </tr>
                        </tbody>
                    </table>
                </form>
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