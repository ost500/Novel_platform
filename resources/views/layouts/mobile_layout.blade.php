<!DOCTYPE html>
<html lang="ko" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v-bind="http://www.w3.org/1999/xhtml">
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
    <style>

        /*ALERTS*/
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-dismissable {
            padding-right: 35px;
        }

        .alert-dismissable .close {
            position: relative;
            top: -2px;
            right: -21px;
            color: inherit;
        }
    </style>

    @yield('header')
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
                        <a href="{{route('mobile.register')}}" class="login_btn">회원가입</a>
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
                        <a href="{{ route('my_page.novels.new_speed') }}" class="icon_mn_a">
                            <div class="iconut news" v-bind:class="{'news_on' : new_speeds.news_count > 0 }">
                                <span class="iconut_txt"
                                      v-bind:class="{'newstxt_on' : new_speeds.news_count > 0 }">소식</span>
                                <em v-if="new_speeds.news_count > 0"
                                    class="count_n colred">@{{ new_speeds.news_count }}</em>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mails.received') }}" class="icon_mn_a">
                            <div class="iconut note" v-bind:class="{'note_on' : new_mails.count > 0}">
                                <span class="iconut_txt" v-bind:class="{'note_on' : new_mails.count > 0}">쪽지</span>
                                <em v-if="new_mails.count > 0" class="count_n colyel">@{{ new_mails.count }}</em>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('my_page.favorites') }}" class="icon_mn_a">
                            <div class="iconut bookmark exyel">
                                <span class="">선호작</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('my_page.index')}}" class="icon_mn_a">
                            <div class="iconut myinfo">
                                <span class="">My정보</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="icon_mn_a">
                            <div class="iconut charge">
                                <span class="{{ route('my_info.charge_bead') }}">구슬충전</span>
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
                        <a href="{{route('ask.notifications')}}" class="icon_mn_a">
                            <div class="iconut notice">
                                <span class="">공지사항</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('ask.faqs')}}" class="icon_mn_a">
                            <div class="iconut customer">
                                <span class="">고객센터</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('free_board') }}" class="icon_mn_a">
                            <div class="iconut communimobile.index">
                                <span class="">커뮤니티</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- 아이콘 메뉴 //-->

            <!-- 작가작업실 -->
            <a href="{{ route('author.index') }}">
                <div class="workroom">
                    <span class="workroom_txt">작가작업실</span>
                </div>
            </a>
            <!-- 작가작업실 //-->
        </div>
    </div>
    <!-- side menu open //-->
    <!-- header -->
    <div class="header" id="header">
        <div class="h_top">
            <h1 class="top_logo">
                <a href="{{route('root')}}" class="tl_link">
                    <img src="/mobile/images/top_logo.png" class="img_logo" alt="여우정원">
                </a>
            </h1>
            @if(!Request::is('mobile/register') && !Request::is('email_confirm/again') )
                <a class="top_left">
                    <span class="ico_mtop ico_side" id="sidebar_display" v-on:click="showSideMenu()"
                          style="cursor:pointer">스 메뉴 펼치기</span>
                </a>

                <div class="top_right_wrap">
                    <a class="tr_link" v-on:click="showSearchBox()"><span class="ico_mtop h_sch">검색하기 off</span></a>
                    <!--<a href="" class="tr_link"><span class="ico_mtop h_sch_on">검색하기 on</span></a>-->
                    <a href="" class="tr_link"><span class="ico_mtop bookmark">즐겨찾기 off</span></a>
                    <!--<a href="" class="tr_link"><span class="ico_mtop bookmark_on">즐겨찾기 on </span></a>-->
                </div>
            @endif

        </div>
        @if(!Request::is('mobile/register') && !Request::is('email_confirm/again'))
        <div class="top_nav">
            <ul class="top_nav_ul">
                <li><a href="{{route('bests')}}" class="top_nav_link"><span
                                class="top_nav_mn  {{ (Request::is('bests') || Request::is('bests/*'))?"on":"" }}">베스트</span></a>
                </li>
                <!-- 활성화 되면 클래스 on 추가 -->
                <li><a href="{{route('series')}}" class="top_nav_link"><span
                                class="top_nav_mn  {{ (Request::is('series') || Request::is('series/*'))?"on":"" }}">연제</span></a>
                </li>
                <li><a href="{{route('completed')}}" class="top_nav_link"><span
                                class="top_nav_mn {{ (Request::is('completed') || Request::is('completed/*'))?"on":"" }}">완결</span></a>
                </li>
                <li><a href="{{route('free_board')}}" class="top_nav_link"><span
                                class="top_nav_mn {{ (Request::is('community/freeboard') || Request::is('community/free_board/*') || Request::is('community/reader_reco') || Request::is('community/reader_reco/*'))?"on":"" }}">커뮤니티</span></a>
                </li>
            </ul>
        </div>
        @endif
    </div>
    <!-- header //-->

    <!-- search popop open -->
    <div class="popup_bg" style="top:215px;display:none;" id="search_box">
        <div class="msch_popin">
            <h2 class="msch_pop_tit">일반검색</h2>
            <!-- close 버튼 -->
            <a class="sidemn_close"><span class="ico_close" v-on:click="close" style="margin-left:23px;">닫기</span></a>
            <!-- close 버튼 //-->
            <form name="search_form" action="{{route('search.index')}}" class="search-form" method="post">
                {{csrf_field()}}
                <div class="msch_1wrap">

                    <!-- 셀렉트박스 -->
                    <div class="msch_sel">
                        <select class="selstyl2 full" name="search_type">
                            <option value="전체">전체</option>
                            <option value="소설">소설</option>
                            <option value="소설 회차">소설 회차</option>
                            <option value="작가">작가</option>
                        </select>
                    </div>
                    <!-- 셀렉트박스 //-->
                    <!-- 인풋박스 -->
                    <div class="msch_input1">
                        <input type="text" name="title" id="title" class="inputBacol with333">
                    </div>
                    <!-- 인풋박스 //-->
                </div>

                <h2 class="msch_pop_tit">해시태그 검색</h2>
                <input type="text" name="keyword_name" id="keyword_name" v-on:keyup="get_keywords()" v-model="search"
                       class="inputBacol full">

                <h2 class="msch_subtit">자주 찾는 해시태그</h2>

                <div class="tag_box">
                    <span class="tag_txt"><a v-for="keyword in keywords" class="tag_txt" style="cursor:pointer"
                                             onclick="searchKeyword(this)">#@{{keyword.name}}</a></span>
                </div>

                <div class="padt30 talC">
                    <button type="submit" style="background: transparent;border: transparent;"><img
                                src="/mobile/images/ico_mtopsch.png" alt="검색"></button>
                </div>
            </form>
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
    function searchKeyword(keyword) {

        var keyword_text = keyword.text.replace("#", "");
        $('#keyword_name').val(keyword_text);
    }
    var header = new Vue({
        el: '#header',
        data: {},
        methods: {
            showSideMenu: function () {
                $('#sidebar').show();
            },
            showSearchBox: function () {
                $('#search_box').show();
            }
        }
    });

    var search = new Vue({
        el: '#search_box',

        data: {
            keywords: "",
            search: ''
        },
        mounted: function () {
            this.get_keywords("");
        },
        methods: {
            get_keywords: function () {
                this.$http.get('{{ route('popular_keywords') }}?search=' + this.search)
                        .then(function (response) {
                            this.keywords = response.data;
                        });
            },
            close: function () {
                $('#search_box').hide();
            }
        }
    });

    var main_layout = new Vue({
        el: '#sidebar',

        data: {
            user: {
                "name": "@if(Auth::check()){{ Auth::user()->name }}@endif",
                "favorites_count": "@if(Auth::check()){{ Auth::user()->favorites->count() }}@endif"
            },
            new_speeds: "",
            new_mails: "",
            keywords: "",
            search: ''
        },
        mounted: function () {

            @if(Auth::check())
                    this.get_new_speed();
            this.get_new_mails();
            @endif



        },
        methods: {
            submit: function (e) {

            },
            get_new_speed: function () {
                this.$http.get('/newspeed')
                        .then(function (response) {
                            this.new_speeds = response.data;

                        });
            },
            get_new_mails: function () {
                this.$http.get('/newmail')
                        .then(function (response) {
                            this.new_mails = response.data;

                        });
            }

        }
    });

</script>
</body>
</html>

