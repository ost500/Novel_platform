@extends('layouts.main_layout')
@section('content')

<!-- 컨테이너 -->
<div class="container">
    <div class="wrap">
        <!-- LNB -->
        <div class="lnb">
            <nav>
                <h2 class="lnb-title">커뮤니티</h2>
                <ul class="lnb-depth1">
                    <li>
                        <a href="#mode_nav" class="is-active">자유게시판</a>
                    </li>
                    <li>
                        <a href="#mode_nav">독자추천</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- //LNB -->

        <!-- 서브컨텐츠 -->
        <div class="content" id="content">
            <!-- 위클리베스트게시물 -->
            <section class="weekly-best">
                <h2 class="title">
                    <span class="str1">Weekly</span>
                    <span class="str2">Best</span>
                </h2>
                <div class="list-wrap">
                    <ol class="list">
                        <li><a href="#mode_nav">나 전설의 핵펀치 호박토끼다.</a><span class="writer">호박토끼</span></li>
                        <li><a href="#mode_nav">텍본 문제로 인해.. 저작권법...</a><span class="writer">카마드리엘</span></li>
                        <li><a href="#mode_nav">공약 걸래요...8ㅁ8</a><span class="writer">아이데라</span></li>
                        <li><a href="#mode_nav">어워드 수상소감(어워드 관련... </a><span class="writer">누노이즈</span></li>
                        <li><a href="#mode_nav">텍본 관련 위베보여서 글 하...</a><span class="writer">CharmBird</span></li>
                    </ol>
                    <ol start="6" class="list">
                        <li><a href="#mode_nav">종강 기념 공약을</a><span class="writer">pakjeyon</span></li>
                        <li><a href="#mode_nav">완결은 언제나 기분이 좋습니...</a><span class="writer">리체르카레</span></li>
                        <li><a href="#mode_nav">텍본 얘기들 돌던데</a><span class="writer">agape2345</span></li>
                        <li><a href="#mode_nav">출판사 연락에 대한 이미지</a><span class="writer">콩테</span></li>
                        <li><a href="#mode_nav">패러디 선작할 때 눈여겨봐야...</a><span class="writer">레송</span></li>
                    </ol>
                </div>
            </section>
            <!-- //위클리베스트게시물 -->

            <!-- 게시판목록 -->
            <table class="bbs-list bbs-list--free">
                <caption>자유게시판 목록</caption>
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>제목</th>
                        <th>글쓴이</th>
                        <th>등록일</th>
                        <th>조회수</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-no">214</td>
                        <td class="col-subject">
                            <a href="#mode_nav">글을 잘 쓰는 팁! 이라고 할 수 있을진 모르겠지만...</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">2</span><i class="new-icon"> 새글</i>
                        </td>
                        <td class="col-name">리윤</td>
                        <td class="col-datetime">03:41:29</td>
                        <td class="col-view">30</td>
                    </tr>
                    <tr>
                        <td class="col-no">213</td>
                        <td class="col-subject">
                            <a href="#mode_nav">눈이 가물가물한게</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">1</span><i class="new-icon"> 새글</i>
                        </td>
                        <td class="col-name">H.M</td>
                        <td class="col-datetime">00:46:41</td>
                        <td class="col-view">21</td>
                    </tr>
                    <tr>
                        <td class="col-no">212</td>
                        <td class="col-subject">
                            <a href="#mode_nav">헉..뭐지..잠시안본사이..</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">6</span><i class="new-icon"> 새글</i>
                        </td>
                        <td class="col-name">JJ비</td>
                        <td class="col-datetime">00:20:27</td>
                        <td class="col-view">23</td>
                    </tr>
                    <tr>
                        <td class="col-no">211</td>
                        <td class="col-subject">
                            <a href="#mode_nav">조회수가 찔끔찔끔 오르니까 좋은 게 있어요</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">9</span>
                        </td>
                        <td class="col-name">chldmszns</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">48</td>
                    </tr>
                    <tr>
                        <td class="col-no">210</td>
                        <td class="col-subject">
                            <a href="#mode_nav">약빤연재재공지하고싶은데</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">5</span>
                        </td>
                        <td class="col-name">bookstore</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">86</td>
                    </tr>
                    <tr>
                        <td class="col-no">209</td>
                        <td class="col-subject">
                            <a href="#mode_nav">안녕하신가영! 신곡나와서 추천하는 안녕하신가영 노래</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">1</span>
                        </td>
                        <td class="col-name">벗우</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">22</td>
                    </tr>
                    <tr>
                        <td class="col-no">208</td>
                        <td class="col-subject">
                            <a href="#mode_nav">우매한 자게인들을 위해</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">3</span>
                        </td>
                        <td class="col-name">QBEY</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">56</td>
                    </tr>
                    <tr>
                        <td class="col-no">207</td>
                        <td class="col-subject">
                            <a href="#mode_nav">여러분이 생각하셨을때 어느 소설이 더 쓰기 쉬우신가요?</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">10</span>
                        </td>
                        <td class="col-name">대어사냥</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">207</td>
                    </tr>
                    <tr>
                        <td class="col-no">206</td>
                        <td class="col-subject">
                            <a href="#mode_nav">엑스레이 사진 보다가 뿅 간 적 있나요?</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">7</span>
                        </td>
                        <td class="col-name">피피미미</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">103</td>
                    </tr>
                    <tr>
                        <td class="col-no">205</td>
                        <td class="col-subject">
                            <a href="#mode_nav">퉷</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">4</span>
                        </td>
                        <td class="col-name">NiurKhan</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">42</td>
                    </tr>
                    <tr>
                        <td class="col-no">204</td>
                        <td class="col-subject">
                            <a href="#mode_nav">자다 일어났더니 더 피곤한거 같아염</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">3</span>
                        </td>
                        <td class="col-name">옐리르</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">24</td>
                    </tr>
                    <tr>
                        <td class="col-no">203</td>
                        <td class="col-subject">
                            <a href="#mode_nav">챕터를 끝냈다는 기쁨에 분량을 몰아넣었더니...</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">4</span>
                        </td>
                        <td class="col-name">리비에르J</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">94</td>
                    </tr>
                    <tr>
                        <td class="col-no">202</td>
                        <td class="col-subject">
                            <a href="#mode_nav">전 바끠 감지능력을 가졌습니다...</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">6</span>
                        </td>
                        <td class="col-name">요염한아이</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">45</td>
                    </tr>
                    <tr>
                        <td class="col-no">201</td>
                        <td class="col-subject">
                            <a href="#mode_nav">한때 코난 팬으로써</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">5</span>
                        </td>
                        <td class="col-name">한미르나래</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">54</td>
                    </tr>
                    <tr>
                        <td class="col-no">200</td>
                        <td class="col-subject">
                            <a href="#mode_nav">뉴비에양! 늅늅!</a>
                            <span class="hidden">댓글 </span><span class="comment-cnt">11</span>
                        </td>
                        <td class="col-name">닉언죄</td>
                        <td class="col-datetime">2016.06.20</td>
                        <td class="col-view">36</td>
                    </tr>
                </tbody>
            </table>
            <!-- //게시판목록 -->

            <!-- 하단버튼 -->
            <div class="list-bottom-btns">
                <div class="right-btns">
                    <a href="#mode_nav" class="btn">글쓰기</a>
                </div>
            </div>
            <!-- //하단버튼 -->
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

            <!-- 검색 -->
            <form name="content_search_form" action="#" class="content-search-form">
                <fieldset>
                    <legend>검색</legend>
                    <span class="selectbox">
                        <select title="검색옵션">
                            <option>제목</option>
                            <option>내용</option>
                        </select>
                    </span>
                    <input type="text" class="text1" title="검색어">
                    <button type="submit" class="userbtn userbtn--search">검색</button>
                </fieldset>
            </form>
            <!-- //검색 -->
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