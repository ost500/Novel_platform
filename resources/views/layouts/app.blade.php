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
    <link href="/css/extra.css?v=2" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/nifty.css?v=12" rel="stylesheet">
    <link href="/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/plugins/pace/pace.min.css" rel="stylesheet">

    <link href="/css/common.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="/plugins/pace/pace.min.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.min.js"></script>
    <script src="/js/jquery-2.1.1.min.js"></script>

    <script src="/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>

    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="/js/bootstrap.min.js"></script>
    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    {{--jquery-ui css--}}
    <link href="/css/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="/css/jquery-ui/jquery-ui.structure.min.css" rel="stylesheet">
    <link href="/css/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="/css/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    {{--jquery contextMenu--}}
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
                    <img style="margin-left:10px; margin-right:-8px" src="/front/imgs/common/foxgarden_author_logo.png" alt="Nifty Logo" class="brand-icon">

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
                            <i class="fa fa-navicon fa-lg"> </i>

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

                                <!--Category name-->
                                <li class="list-header"></li>


                                <!--Menu list item-->
                                <li class="{{ (Request::is('author/management/novelgroups')||Request::is('author/management/novelgroups/create')||Request::is('author/management/create_novel/*')||Request::is('author/management/novelgroups/*')||Request::is('author/management/update_novel/*')||Request::is('author/management/show_novel/*'))?"active-link":"" }}">
                                    <a href="#">
                                        <i class="fa fa-book"></i>
                                        <span class="menu-title">
                                            <strong>작품관리</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>

                                    <ul class="collapse {{ (Request::is('author/management/novelgroups')||Request::is('author/management/novelgroups/create')||Request::is('author/management/create_novel/*')||Request::is('author/management/novelgroups/*')||Request::is('author/management/update_novel/*')||Request::is('author/management/show_novel/*'))?"in":"" }}">
                                        <li><a href="{{ route('author_index') }}">작품목록</a></li>
                                        <li><a href="{{ route('author.novel_group_create') }}">작품등록</a></li>

                                    </ul>
                                </li>


                                <li class="list-divider"></li>

                                <li class="{{Request::is('author/calculations')?"active-link":"" }}">
                                    <a href="widgets.html">
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>수익내역</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>

                                    <ul class="collapse {{ (Request::is('author/calculations/*') || Request::is('author/calculations'))?"in":"" }}">
                                        <li><a href="{{ route('author.benefit') }}">여우수익내역</a></li>
                                        <li><a href="{{ route('author.calculations') }}">퍼블리싱내역</a></li>
                                        {{--<li><a href="novel_write.html">환급정산내역</a></li>--}}
                                    </ul>
                                </li>

                                <li class="list-divider"></li>

                                <li class="{{Request::is('author/partnership/*')?"active-link":"" }}">
                                    <a href="index.html">
                                        <i class="fa fa-share"></i>
                                    <span class="menu-title">
                                        <strong>제휴연재신청</strong>
                                    </span>
                                        <i class="arrow"></i>
                                    </a>

                                    <ul class="collapse {{ (Request::is('author/partnership/*') )?"in":"" }}">
                                        <li><a href="{{ route('author.partner_apply') }}">연재신청</a></li>
                                        <li><a href="{{ route('author.partner_apply_list') }}">연재신청내역</a></li>
                                        <li><a href="{{ route('author.partner_test_inning') }}">회차별 심사</a></li>
                                    </ul>
                                </li>

                                <li class="list-divider"></li>

                                <li class="{{ (Request::is('author/mailbox/receive_mail')||Request::is('author/mailbox/*')||Request::is('author/mailbox/sent_mail')||Request::is('author/mailbox/sent_mail/*')||Request::is('author/mailbox/create_mail')||Request::is('author/mailbox_message/*'))?"active-link":"" }}">

                                    <a href="{{ route('author.novel_memo')}}">
                                        <i class="fa fa-envelope"></i>
                                        <span class="menu-title">
                                            <strong>작가전용쪽지함</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse {{ (Request::is('author/mailbox/receive_mail')||Request::is('author/mailbox/*')||Request::is('author/mailbox/sent_mail')||Request::is('author/mailbox/sent_mail/*')||Request::is('author/mailbox/create_mail'))?"in":"" }}">
                                        <li><a href="{{ route('author.novel_memo')}}">받은쪽지함</a></li>
                                        <li><a href="{{ route('author.novel_memo_send')}}">보낸쪽지함</a></li>
                                        <li><a href="{{ route('author.novel_memo_create')}}">선호작 쪽지 보내기</a></li>
                                    </ul>
                                </li>

                                <li class="list-divider"></li>

                                <li class="{{ (Request::is('author/men_to_men/request_create')||Request::is('author/men_to_men/requests')||Request::is('author/men_to_men/requests/*'))?"active-link":"" }}">
                                    <a href="{{ route('author.novel_request')}}">
                                        <i class="fa fa-send"></i>
                                        <span class="menu-title">
                                            <strong>1:1문의</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>

                                    <ul class="collapse {{ (Request::is('author/men_to_men/request_create')||Request::is('author/men_to_men/requests')||Request::is('author/men_to_men/requests/*'))?"in":"" }}">
                                        <li><a href="{{ route('author.novel_request')}}">1:1문의</a></li>
                                        <li><a href="{{ route('author.novel_request_list')}}">1:1문의내역</a></li>
                                    </ul>
                                </li>
                                <li class="list-divider"></li>
                                <li class="{{ (Request::is('author/gifts/send_gift')||Request::is('author/gifts/sent_gifts'))?"active-link":"" }}">
                                    <a href="{{route('author.send_gift')}}">
                                        <i class="fa fa-send"></i>
                                        <span class="menu-title">
                                            <strong>구슬 선물</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>

                                    <ul class="collapse {{ (Request::is('author/gifts/send_gift')||Request::is('author/gifts/sent_gifts'))?"in":"" }}">
                                        <li><a href="{{ route('author.send_gift')}}">구슬 선물하기</a></li>
                                        <li><a href="{{ route('author.sent_gifts')}}">보낸 선물 내역</a></li>
                                    </ul>
                                </li>

                                <li class="list-divider"></li>

                                <li class="{{ (Request::is('author/faqs'))?"active-link":"" }}">
                                    <a href="{{ route('author.faqs')}}">
                                        <i class="fa fa-send"></i>
                                        <span class="menu-title">
                                            <strong>FAQ</strong>
                                        </span>
                                    </a>
                                </li>

                                <li class="list-divider"></li>


                                <li class="{{ (Request::is('author/profile/information')||Request::is('author/profile/nickname'))?"active-link":"" }}">
                                    <a href="/">
                                        <i class="fa fa-user"></i>
                                        <span class="menu-title">
                                            <strong>작가정보</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>


                                    <ul class="collapse {{ (Request::is('author/profile/information')||Request::is('author/profile/nickname'))?"in":"" }}">
                                        <li><a href="{{ route("author.profile") }}">필수정산정보</a></li>
                                        <li><a href="{{ route("author.nickname") }}">필명등록</a></li>
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


<script src="/js/common.js"></script>

{{--<script src="/js/bootstrap.min.js"></script>--}}
<script src="/js/nifty.min.js"></script>

<script src="/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="/plugins/bootbox/bootbox.min.js"></script>


<script src="/js/ui-modals.js"></script>
<script src="/js/ui-alerts.js"></script>

{{--laravel 기본 스크립트--}}
{{--<script src="/js/app.js"></script>--}}

{{--jquery UI--}}
<script src="/js/jquery-ui/jquery-ui.min.js"></script>

{{--<script src="/js/nifty.min.js"></script>--}}

{{--jquery contextMenu--}}
<script src="/plugins/jquery-contextMenu/jquery.contextMenu.js"></script>
<script src="/plugins/jquery-contextMenu/jquery.ui.position.js"></script>
</body>
</html>
