<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>여우정원</title>
    <link rel="stylesheet" href="/front/css/font/nanum_barun_gothic.css">
    <link rel="stylesheet" href="/front/css/font/nanum_gothic.css">
    <link rel="stylesheet" href="/front/css/font/nanum_myeongjo.css">
    <link rel="stylesheet" href="/front/css/icons.css">
    <link rel="stylesheet" href="/front/css/style.css">
    <link rel="stylesheet" href="/front/css/sub.css">
    <link rel="stylesheet" href="/front/css/main.css">
    <link rel="stylesheet" href="/front/css/register.css">
    <script src="/front/js/jquery-1.12.4.min.js"></script>
    <script src="/front/js/jquery.easing.min.js"></script>
    <!--[if lte IE 8]>
    <script src="/front/js/html5shiv.min.js"></script>
    <script src="/front/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="register">
    <!-- 헤더 -->
    <div class="register-header">
        <h1 class="logo" id="register_logo"><a href="#register_logo">여우정원</a></h1>
    </div>
    <!-- 회원가입내용 -->
    <div id="final" class="register-content">
        <div class="register-form-step">
            <i></i>
            <i></i>
            <i class="is-active"></i>
        </div>
        <div class="register-form-header">
            <h2 class="title">인증 메일 재발송</h2>
            <p class="title-desc">메일을 확인해 주세요.</p>
        </div>
        <div class="sendmail-result">
            <p>다음의 메일로 인증 메일이 발송되었습니다.</p>
            <p id="email-addr" class="email-addr">{{ $user->email }}</p>
            <p>이메일 발송 후 3시간 이내에 인증해 주시기 바랍니다.<br>이메일 주소를 인증하시면 회원가입이 완료됩니다.</p>
            <div class="sendmail-btns">
                <a href="#register_logo" class="btn btn--retry">인증 메일 재발송</a>
                <a href="{{ route('root') }}" class="btn btn--modify">메인으로 가기</a>
            </div>
        </div>
    </div>
    <!-- //회원가입내용 -->




    <div class="register-footer">
        <!-- 푸터고객링크 -->
        <nav>
            <ul class="customer-link">
                <li><a href="#register_logo">이용약관</a></li>
                <li><a href="#register_logo">개인정보처리방침</a></li>
                <li><a href="#register_logo">개인정보취급위탁</a></li>
            </ul>
        </nav>
        <!-- //푸터고객링크 -->
        <p class="copyright">Copyright ⓒ foxygarden co.,Ltd. All Rights Reserved.</p>
    </div>
</div>
<div class="register-bg"></div>
<script src="/front/js/common.js"></script>
<!--[if lte IE 9]>
<script src="/front/js/jquery.placeholder.min.js"></script>
<script> $(document).ready(function () {
    $('input, textarea').placeholder();
}); </script>
<![endif]-->
<!--[if lte IE 8]>
<script src="/front/js/selectivizr-min.js"></script>
<script src="/front/js/checked-polyfill.min.js"></script>
<script> $(document).ready(function () {
    $('input:radio, input:checkbox').checkedPolyfill();
}); </script>
<![endif]-->
</body>
</html>
