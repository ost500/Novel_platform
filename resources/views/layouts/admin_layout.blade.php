<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
    <link href="/css/bootstrap.css?v=3" rel="stylesheet">

    <link href="/css/extra.css?v=2" rel="stylesheet">
    <link href="/css/nifty.css?v=6" rel="stylesheet">
    <link href="/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/plugins/pace/pace.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="/plugins/pace/pace.min.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.min.js"></script>
    <script src="/js/jquery-2.1.1.min.js"></script>
    <link href="/css/common.css" rel="stylesheet">

    <script src="/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
    <script src="/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    {{--jquery-ui css--}}
    <link href="/css/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="/css/jquery-ui/jquery-ui.structure.min.css" rel="stylesheet">
    <link href="/css/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="/css/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="/plugins/jquery-contextMenu/jquery.contextMenu.css" rel="stylesheet">
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

<div id="container" class="effect mainnav-lg">

    <header id="navbar">
        <div id="navbar-container" class="boxed">

            <div class="navbar-header">
                <a href="{{ route('root') }}" class="navbar-brand">
                    <img style="margin-left:10px; margin-right:-8px" src="/front/imgs/common/foxgarden_author_logo.png"
                         alt="Nifty Logo" class="brand-icon">

                    <div class="brand-title">
                        <img src="/front/imgs/common/foxgarden_author_logo2.png" alt="Nifty Logo">
                    </div>
                </a>
            </div>


            <div class="navbar-content clearfix">
                <ul class="nav navbar-top-links pull-left">

                    <!--Navigation toogle button-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <li class="tgl-menu-btn">
                        <a class="mainnav-toggle" href="#">
                            <i class="fa fa-navicon fa-lg"></i>
                        </a>
                    </li>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End Navigation toogle button-->


                    <!--Messages Dropdown-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <li class="dropdown">
                        {{-- <a href="#">
                             <i class="fa fa-lg"></i>
                         </a>--}}
                    </li>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End message dropdown-->
                </ul>

                <ul class="nav navbar-top-links pull-right">
                    <li id="dropdown-user">
                        <div class="username text-right">
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <button class="btn btn-danger">로그아웃</button>
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                </ul>
            </div>


        </div>
    </header>

    <div class="boxed">
        @include('partials.flash')
        @yield('content')

        <nav id="mainnav-container">
            <div id="mainnav">

                <div id="mainnav-shortcut">
                    <ul class="list-unstyled">
                    </ul>
                </div>


                <div id="mainnav-menu-wrap">
                    <div class="nano">
                        <div class="nano-content">
                            <ul id="mainnav-menu" class="list-group">

                                <li class="list-header"></li>

                                <li class="{{ (Request::is('admin/users')||Request::is('admin/users/*'))?"active-link":"" }}">
                                    <a href="{{ route('admin.users') }}">
                                        <i class="fa fa-book"></i>
                                        <span class="menu-title">
                                            <strong>회원관리</strong>
                                        </span>
                                    </a>
                                </li>

                                <li class="list-divider"></li>

                                <li class="{{ (Request::is('admin/commissions')||Request::is('admin/commissions/*'))?"active-link":"" }}">
                                    <a href="{{ route('admin.commissions') }}">
                                        <i class="fa fa-book"></i>
                                        <span class="menu-title">
                                            <strong>수수료 관리</strong>
                                        </span>
                                    </a>
                                </li>

                                <li class="list-divider"></li>

                                {{--<li class="{{ (Request::is('admin/sales'))?"active-link":"" }}">--}}
                                {{--<a href="{{ route('admin.sales') }}">--}}
                                {{--<i class="fa fa-book"></i>--}}
                                {{--<span class="menu-title">--}}
                                {{--<strong>매출관리</strong>--}}
                                {{--</span>--}}
                                {{--</a>--}}
                                {{--</li>--}}

                                {{--<li class="list-divider"></li>--}}

                                <li class="{{ (Request::is('admin/novel')||Request::is('admin/novel/*') || Request::is('admin/recommendations'))?"active-link":"" }}">
                                    <a href="{{ route('admin.novel') }}">
                                        <i class="fa fa-book"></i>
                                        <span class="menu-title">
                                            <strong>작품관리</strong>
                                        </span>
                                    </a>
                                    <ul class="collapse {{ (Request::is('admin/novel')||Request::is('admin/novel/*') ||Request::is('admin/recommendations'))?"in":"" }}">
                                        <li><a href="{{route('admin.novel')}}">작품 관리</a></li>
                                        <li><a href="{{route('admin.recommendations')}}">여기, 정오의 추천</a></li>

                                    </ul>
                                </li>


                                <li class="list-divider"></li>

                                <li class="{{(Request::is('admin/calculations')||Request::is('admin/calculations/*')||Request::is('admin/calculation/*')||Request::is('admin/total_calculations'))?"active-link":"" }}">
                                    <a href="widgets.html">
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>정산관리</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>

                                    <ul class="collapse {{ (Request::is('admin/calculations')||Request::is('admin/calculation/*')||Request::is('admin/calculations/*') ||Request::is('admin/all_calculations') ||Request::is('admin/all_calculations/*')||Request::is('admin/total_calculations'))?"in":"" }}">
                                        <li><a href="{{ route('code_num')  }}">작품 코드번호 입력</a></li>
                                        <li><a href="{{route('calculation.create')}}">정산 등록</a></li>
                                        {{--<li><a href="{{route('calculation')}}">정산 내역</a></li>--}}
                                        <li><a href="{{route('calculation')}}">퍼블리싱 정산 내역</a></li>
                                        <li><a href="{{route('calculation.all')}}">여우정원 정산 내역</a></li>
                                        <li><a href="{{route('calculation.total')}}">전체 수익 관리</a></li>
                                    </ul>
                                </li>

                                <li class="list-divider"></li>

                                <li class="{{Request::is('admin/partnership/*')?"active-link":"" }}">
                                    <a href="index.html">
                                        <i class="fa fa-share"></i>
                                        <span class="menu-title">
                                            <strong>제휴연재관리</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>

                                    <ul class="collapse {{ (Request::is('admin/partnership/*') )?"in":"" }}">
                                        <li><a href="{{ route('admin.partner_manage_company') }}">연재업체관리</a></li>
                                        <li><a href="{{ route('admin.partner_manage_apply') }}">연재신청관리</a></li>
                                        <li><a href="{{ route('admin.partner_test_inning') }}">회차별 심사</a></li>
                                        <li><a href="{{ route('admin.partner_approve_inning') }}">회차별 심사 승인</a></li>
                                    </ul>
                                </li>

                                <li class="list-divider"></li>

                                <li class="{{ (Request::is('admin/memo')||Request::is('admin/memo/*')||Request::is('admin/novel_memo_send')||Request::is('admin/memo_create')||Request::is('admin/specific_mail')||Request::is('admin/memo_detail/*') || Request::is('admin/mailbox_send_message/*') || Request::is('author/mailbox/*'))?"active-link":"" }}">
                                    <a href="{{ route('admin.memo')}}">
                                        <i class="fa fa-envelope"></i>
                                        <span class="menu-title">
                                            <strong>쪽지함</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>

                                    <ul class="collapse  {{ (Request::is('admin/memo')||Request::is('admin/memo/*')||Request::is('admin/novel_memo_send')||Request::is('admin/memo_create')||Request::is('admin/specific_mail')||Request::is('admin/memo_detail/*') || Request::is('admin/mailbox_send_message/*') || Request::is('author/mailbox/*'))?"in":"" }}">
                                        <li><a href="{{ route('admin.memo')}}">받은 쪽지함</a></li>
                                        <li><a href="{{ route('admin.novel_memo_send')}}">보낸 쪽지함</a></li>
                                        <li><a href="{{ route('admin.memo_create')}}">쪽지보내기</a></li>
                                    </ul>
                                </li>

                                <li class="list-divider"></li>

                                <li class="{{ (Request::is('admin/request')||Request::is('admin/request/*'))?"active-link":"" }}">
                                    <a href="{{ route('admin.request')}}">
                                        <i class="fa fa-send"></i>
                                        <span class="menu-title">
                                            <strong>1:1문의</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse  {{ (Request::is('admin/request')||Request::is('admin/request/*'))?"in":"" }}">
                                        <li><a href="{{ route('admin.request')}}">1:1문의</a></li>
                                    </ul>
                                </li>

                                <li class="list-divider"></li>

                                <li class="{{ (Request::is('admin/keywords')||Request::is('admin/keywords/*')||Request::is('admin/keywords/create'))?"active-link":"" }}">
                                    <a href="{{ route('admin.keywords')}}">
                                        <i class="fa fa-send"></i>
                                        <span class="menu-title">
                                            <strong>키워드</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse  {{ (Request::is('admin/keywords')||Request::is('admin/keywords/*')||Request::is('admin/keywords/create'))?"in":"" }}">
                                        <li><a href="{{ route('admin.keywords')}}">키워드</a></li>
                                        <li><a href="{{ route('admin.keywords.create')}}">키워드 등록</a></li>
                                    </ul>
                                </li>
                                <li class="list-divider"></li>

                                <li class="{{ (Request::is('admin/faqs')||Request::is('admin/faqs/*')||Request::is('admin/faqs/create'))?"active-link":"" }}">
                                    <a href="{{ route('admin.faqs')}}">
                                        <i class="fa fa-send"></i>
                                        <span class="menu-title">
                                            <strong>FAQ</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse  {{ (Request::is('admin/faqs')||Request::is('admin/faqs/*')||Request::is('admin/faqs/create'))?"in":"" }}">
                                        <li><a href="{{ route('admin.faqs')}}">FAQ</a></li>
                                        <li><a href="{{ route('admin.faqs.create')}}">FAQ 등록</a></li>
                                    </ul>
                                </li>
                                <li class="list-divider"></li>

                                <li class="{{ (Request::is('admin/notifications')||Request::is('admin/notifications/*')||Request::is('admin/notifications/create'))?"active-link":"" }}">
                                    <a href="{{ route('admin.notifications')}}">
                                        <i class="fa fa-send"></i>
                                        <span class="menu-title">
                                            <strong>공지사항 관리</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse  {{ (Request::is('admin/notifications')||Request::is('admin/notifications/*')||Request::is('admin/notifications/create'))?"in":"" }}">
                                        <li><a href="{{ route('admin.notifications')}}">공지사항</a></li>
                                        <li><a href="{{ route('admin.notifications.create')}}">공지사항 등록</a></li>
                                    </ul>
                                </li>


                                <li class="list-divider"></li>

                                <li class="{{ (Request::is('admin/notifications')||Request::is('admin/notifications/*')||Request::is('admin/notifications/create'))?"active-link":"" }}">
                                    <a href="{{ route('admin.notifications')}}">
                                        <i class="fa fa-send"></i>
                                        <span class="menu-title">
                                            <strong>신고 관리</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse  {{ (Request::is('admin/accusations')||Request::is('admin/accusations/*')||Request::is('admin/notifications/create'))?"in":"" }}">
                                        <li><a href="{{ route('admin.accusations')}}">신고 리스트</a></li>

                                    </ul>
                                </li>

                                <li class="list-divider"></li>


                            </ul>


                        </div>
                    </div>
                </div>

            </div>
        </nav>


    </div>


</div>


<!-- FOOTER -->
<!--===================================================-->
{{--<footer id="footer">--}}


{{--<!-- Visible when footer positions are static -->--}}
{{--<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->--}}
{{--<div class="hide-fixed pull-right pad-rgt"></div>--}}

{{--<p class="pad-lft"></p>--}}


{{--</footer>--}}
<!--===================================================-->
<!-- END FOOTER -->


<!-- SCROLL TOP BUTTON -->
<!--===================================================-->
<button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
<!--===================================================-->


</div>
<!--===================================================-->
<!-- END OF CONTAINER -->


<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="demo-default-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Modal Heading</h4>
            </div>

            <!--Modal body-->
            <div class="modal-body">
                <h4 class="text-thin">Bootstrap Modal Vertical Alignment Center</h4>

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                    laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                    ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                <hr>
                <h4 class="text-thin">Popover in a modal</h4>

                <p>This
                    <button class="btn btn-sm btn-warning demo-modal-popover add-popover" data-toggle="popover"
                            data-trigger="focus"
                            data-content="And here\'s some amazing content. It\'s very engaging. right?"
                            data-original-title="Popover Title">button
                    </button>
                    should trigger a popover on click.
                </p>
                <hr>
                <h4 class="text-thin">Tooltips in a modal</h4>

                <p>
                    <a class="btn-link add-tooltip" href="#" data-original-title="Tooltip">This link</a> and
                    <a class="btn-link add-tooltip" href="#" data-original-title="Tooltip">that link</a> should have
                    tooltips on hover.
                </p>
            </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->


<!--Bootstrap Modal without Animation-->
<!--===================================================-->
<div class="modal" id="demo-modal-wo-anim" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Modal Heading</h4>
            </div>


            <!--Modal body-->
            <div class="modal-body">
                <h4 class="text-thin">Bootstrap Modal Vertical Alignment Center</h4>

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                    laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                    ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>

                <hr>
                <h4 class="text-thin">Popover in a modal</h4>

                <p>This
                    <button class="btn btn-sm btn-warning demo-modal-popover add-popover" data-toggle="popover"
                            data-trigger="focus"
                            data-content="And here\'s some amazing content. It\'s very engaging. right?"
                            data-original-title="Popover Title">button
                    </button>
                    should trigger a popover on click.
                </p>

                <hr>

                <h4 class="text-thin">Tooltips in a modal</h4>

                <p><a class="btn-link add-tooltip" href="#" data-original-title="Tooltip">This link</a> and <a
                            class="btn-link add-tooltip" data-toggle="tooltip" href="#" data-original-title="Tooltip"
                            title="">that link</a> should have tooltips on hover.</p>
            </div>


            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Bootstrap Modal without Animation-->


<!--Large Bootstrap Modal-->
<!--===================================================-->
<div id="demo-lg-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                    laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                    ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Large Bootstrap Modal-->


<!--Small Bootstrap Modal-->
<!--===================================================-->
<div id="demo-sm-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="mySmallModalLabel">Small modal</h4>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Small Bootstrap Modal-->


{{--laravel 기본 스크립트--}}
{{--<script src="/js/app.js"></script>--}}
{{--<script src="/js/bootstrap.min.js"></script>--}}
<script src="/js/common.js"></script>
<script src="/js/nifty.min.js"></script>
<script src="/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="/plugins/bootbox/bootbox.min.js"></script>


<script src="/js/ui-modals.js"></script>
<script src="/js/ui-alerts.js"></script>


{{--jquery UI--}}
<script src="/js/jquery-ui/jquery-ui.min.js"></script>

<script src="/plugins/jquery-contextMenu/jquery.contextMenu.js"></script>
<script src="/plugins/jquery-contextMenu/jquery.ui.position.js"></script>

</body>
</html>
