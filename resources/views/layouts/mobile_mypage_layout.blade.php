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

        .fixed {
            position: fixed;
            width: 640px;
            background-color: #fff;
            z-index: 2;
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
</head>


<body>
<div class="wrap">
    <!-- header -->
    <div class="myheader">
        <div class="mytop">
            <h1 class="mytop_tit">MY정보</h1>
            <a href="{{route('root')}}" class="mytop_left">
                <span class="ico_mytop ico_back">뒤로가기</span>
            </a>
        </div>
    </div>
    <!-- header //-->
    @yield('content')

    @yield('footer')

</div>
<script type="text/javascript">
    $(window).scroll(function () {

        if ($(this).scrollTop() > 1) {
            $('.myheader').addClass('fixed');

            $('.myheader .mytop').css('height', '70px');
            $('.myheader .mytop .mytop_tit').css('padding', '22px');
            $('.myheader .mytop .ico_back').css('top', '3px');
        }
        else {
            $('.myheader').removeClass('fixed');

            $('.myheader .mytop').css('height', '');
            $('.myheader .mytop .mytop_tit').css('padding', '');
            $('.myheader .mytop .ico_back').css('top', '');
        }
    });
</script>
</body>
</html>