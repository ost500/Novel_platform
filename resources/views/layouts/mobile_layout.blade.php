<!DOCTYPE html>
<html lang="ko" xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>여우정원</title>
    <meta name="viewport" id="viewport" content="width=640, user-scalable=0, target-densitydpi=device-dpi">
    <link rel="stylesheet" type="text/css" href="/mobile/css/default.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/common.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/main.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/sub.css">
    <link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css" type="text/css">
    {{-- <script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>--}}
    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.min.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script type="text/javascript">
        <!--
        var select = {
            action: function (el, state) {
                // state = 0 or 1
                var SelectElement = document.getElementById(el.id);
                var ListElement = SelectElement.getElementsByTagName("ul")[0];
                var ActionElement = ListElement.getElementsByTagName("a");
                if (ListElement.style.display == "block") {
                    select.close(ListElement);
                    return false;
                } else {
                    ListElement.style.display = "block";
                }

                var strSelected = SelectElement.getElementsByTagName("a")[0];
                strSelected.focus();
                for (var i = 0; i < ActionElement.length; i++) {
                    if (strSelected.firstChild.nodeValue == ActionElement[i].firstChild.nodeValue) {
                        select.elementClass = ActionElement[i];
                        select.elementClass.className = "selected";
                        ActionElement[i].onclick = function () {
                            return false;
                        }
                    } else {
                        ActionElement[i].onclick = function () {
                            if (this.href.indexOf("javascript") > -1) {
                                eval(this.href);
                            } else if (this.href == "" || this.href.indexOf("#") > -1) {
                            } else if (this.target == "_blank") {
                                window.open(this.href);
                            } else {
                                location.href(this.href);
                            }
                            if (state == 1) {
                                strSelected.firstChild.nodeValue = this.firstChild.nodeValue;
                            }
                            return false;
                        }
                    }
                    ActionElement[i].onmouseover = function () {
                        select.elementClass.className = "";
                        this.className = "selected";
                        select.elementClass = this;
                    }
                }

                SelectElement.onmouseover = function () {
                    strSelected.onblur = function () {
                    }
                }
                SelectElement.onmouseout = function () {
                    strSelected.onblur = function () {
                        select.close(ListElement);
                    }
                }

            },
            close: function (el) {
                select.elementClass.className = "";
                el.style.display = "none";
                return false;
            }
        }
        //-->
    </script>

</head>


<body>
<div class="wrap">
    <!-- side menu open -->
    <div class="popup_bg" id="sidebar" style="display:none;">
        <div class="sidemn_in">
            <!-- 로그인 및 사용자 정보 -->
            <div class="side_login">
                <h3 class="blindtext">사용자 정보</h3>
                @if(Auth::check())
                    <div class="user_name">{{ Auth::user()->name}}</div>
                    <!--<div class="user_name">로그인이 필요합니다.</div>-->
                    <div class="user_id">{{ Auth::user()->nickname}}</div>
                    <div class="user_mail">{{ Auth::user()->email}}</div>
                    <div class="login_btn_wrap">
                        <a href="{{ url('/logout') }}" class="login_btn" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">로그아웃</a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                    @else
                            <!-- 로그인 버튼 -->
                    <div class="login_btn_wrap">
                        <a href="{{route('mobile.login')}}" class="login_btn">로그인</a>
                        <!--<a href="" class="login_btn">로그아웃</a>-->
                        <a href="" class="login_btn">회원가입</a>
                    </div>
                    @endif
                            <!-- 로그인 버튼 //-->

                    <!-- close 버튼 -->
                    <a href="" class="sidemn_close"><span class="ico_close">닫기</span></a>
                    <!-- close 버튼 //-->
            </div>
            <!-- 로그인 및 사용자 정보 //-->

            <!-- 아이콘 메뉴 -->
            <div class="icon_mn_wrap">
                <ul class="icon_mn">
                    <li>
                        <a href="" class="icon_mn_a">
                            <div class="iconut news">
                                <span class="iconut_txt">소식</span>
                                <!--<em class="count_n colred">3</em>-->
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="icon_mn_a">
                            <div class="iconut note">
                                <span class="iconut_txt">쪽지</span>
                                <!--<em class="count_n colyel">6</em>-->
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="icon_mn_a">
                            <div class="iconut bookmark exyel">
                                <span class="">선호작</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="icon_mn_a">
                            <div class="iconut myinfo">
                                <span class="">My정보</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="icon_mn_a">
                            <div class="iconut charge">
                                <span class="">구슬충전</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="icon_mn_a">
                            <div class="iconut guide">
                                <span class="">이용가이드</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="icon_mn_a">
                            <div class="iconut notice">
                                <span class="">공지사항</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="icon_mn_a">
                            <div class="iconut customer">
                                <span class="">고객센터</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="icon_mn_a">
                            <div class="iconut community">
                                <span class="">커뮤니티</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- 아이콘 메뉴 //-->

            <!-- 작가작업실 -->
            <div class="workroom">
                <span class="workroom_txt">작가작업실</span>
            </div>
            <!-- 작가작업실 //-->
        </div>
    </div>
    <!-- side menu open //-->
    <!-- header -->
    <div class="header" id="header">
        <div class="h_top">
            <h1 class="top_logo">
                <a href="{{route('mobile.index')}}" class="tl_link">
                    <img src="/mobile/images/top_logo.png" class="img_logo" alt="여우정원">
                </a>
            </h1>
            <a class="top_left">
                <span class="ico_mtop ico_side" id="sidebar_display" v-on:click="showSideMenu()" style="cursor:pointer">스 메뉴 펼치기</span>
            </a>

            <div class="top_right_wrap">
                <a href="" class="tr_link"><span class="ico_mtop h_sch">검색하기 off</span></a>
                <!--<a href="" class="tr_link"><span class="ico_mtop h_sch_on">검색하기 on</span></a>-->
                <a href="" class="tr_link"><span class="ico_mtop bookmark">즐겨찾기 off</span></a>
                <!--<a href="" class="tr_link"><span class="ico_mtop bookmark_on">즐겨찾기 on </span></a>-->
            </div>
        </div>
        <div class="top_nav">
            <ul class="top_nav_ul">
                <li><a href="{{route('m.bests')}}" class="top_nav_link"><span
                                class= "top_nav_mn  {{ (Request::is('m/bests') || Request::is('m/bests/*'))?"on":"" }}">베스트</span></a>
                </li>
                <!-- 활성화 되면 클래스 on 추가 -->
                <li><a href="{{route('m.series')}}" class="top_nav_link"><span
                                class="top_nav_mn  {{ (Request::is('m/series') || Request::is('m/series/*'))?"on":"" }}">연제</span></a>
                </li>
                <li><a href="" class="top_nav_link"><span class="top_nav_mn">완결</span></a></li>
                <li><a href="" class="top_nav_link"><span class="top_nav_mn">커뮤니티</span></a></li>
            </ul>
        </div>
    </div>
    <!-- header //-->
    <!-- search popop open -->
    <div class="msch_pop" style="display:none;">
        <div class="msch_popin">
            <h2 class="msch_pop_tit">일반검색</h2>

            <div class="msch_1wrap">
                <div id="Link" class="selectlayer" onclick="select.action(this,1);">
                    <p><a href="#" class="default" onclick="return false;">전체</a></p>
                    <ul>
                        <li><a href="">전체</a></li>
                        <li><a href="">기타기타</a></li>
                        <li><a href="">기타기타</a></li>
                        <li><a href="">기타기타</a></li>
                    </ul>
                </div>
                <div class="msch_input1">
                    <input type="text" name="" class="inputBacol with333">
                </div>
            </div>

            <h2 class="msch_pop_tit">해시태그 검색</h2>
            <input type="text" name="" class="inputBacol full">

            <h2 class="msch_subtit">자주 찾는 해시태그</h2>

            <div class="tag_box">
                <span class="tag_txt">#현대</span><span class="tag_txt">#시대</span><span
                        class="tag_txt">#로맨스판타지</span><span class="tag_txt"></span>
                <span class="tag_txt">#메디컬</span><span class="tag_txt">#남장여자</span><span
                        class="tag_txt">#회귀물</span><span class="tag_txt">#원나잇</span>
                <span class="tag_txt">#계약물</span><span class="tag_txt">#정략결혼</span><span
                        class="tag_txt">#나쁜남자</span><span class="tag_txt">#재벌남</span>
                <span class="tag_txt">#후회남</span><span class="tag_txt">#철벽녀</span><span
                        class="tag_txt">#로맨틱코미디</span><span class="tag_txt">#피폐물</span>
                <span class="tag_txt">#잔잔물</span><span class="tag_txt">#신파</span>
            </div>

            <div class="padt30 talC">
                <a href=""><img src="/mobile/images/ico_mtopsch.png" alt="검색"></a>
            </div>
        </div>
    </div>
    <!-- search popop open //-->
    @yield('content')

            <!-- bottom -->
    <div class="bottom">
        <div class="footer">
            <ul class="ftmn_wrap">
                <li><a href="" class="ftmn_link">이용약관</a></li>
                <li><a href="" class="ftmn_link">개인정보처리방침</a></li>
                <li><a href="" class="ftmn_link">고객센터</a></li>
                <li><a href="" class="ftmn_link">구슬충전</a></li>
                <li><a href="" class="ftmn_link">PC버전</a></li>
            </ul>
            <p class="copyright">Copyright ⓒ foxygarden co.,Ltd. All Rights Reserved.</p>
        </div>
    </div>
    <!-- bottom //-->

</div>
<script type="text/javascript">
    var header = new Vue({
        el: '#header',
        data: {},
        methods: {
            showSideMenu: function () {
                $('#sidebar').show();
            }
        }
    });
</script>
</body>
</html>

