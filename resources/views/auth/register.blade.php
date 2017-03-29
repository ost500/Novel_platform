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
        <h1 class="logo" id="register_logo"><a href="{{route('root')}}">여우정원</a></h1>
    </div>
    <!-- 회원가입내용 -->
    <div id="agreement_step" class="register-content">
        <div class="register-form-step">
            <i class="is-active"></i>
            <i></i>
            <i></i>
        </div>
        <div class="register-form-header">
            <h2 class="title">회원가입약관</h2>
            <p class="title-desc">아래의 약관을 읽고 동의해 주세요.</p>
        </div>
        <form class="agreement-form" name="agreement_form">
            <div class="agreement-box">
                <div class="agreement-content">제 1장 총칙
                    제 1장 총칙
                    제 1장 총칙
                    제 1장 총칙
                    제 1장 총칙
                </div>
                <div class="check">
                    <label for="terms">이용약관 동의</label>
                    <span class="checkbox1"><input type="checkbox" id="terms" value="1"><span></span></span>
                </div>
            </div>
            <div class="agreement-box">
                <div class="agreement-content">1. 수집하는 개인정보의 항목 및 수집방법
                    1. 수집하는 개인정보의 항목 및 수집방법정보의 항목 및 수집방법정보의 항목 및 수집방법정보의 항목 및 수집방법
                    1. 수집하는 개인정보의 항목 및 수집방법
                    1. 수집하는 개인정보의 항목 및 수집방법
                </div>
                <div class="check">
                    <label for="privacy1">개인정보 취급방침 동의</label>
                    <span class="checkbox1"><input type="checkbox" id="privacy1"><span></span></span>
                </div>
            </div>
            <div class="agreement-box">
                <div class="agreement-content">회사는 보다나은
                    회사는 보다나은
                    회사는 보다나은
                    회사는 보다나은
                </div>
                <div class="check">
                    <label for="privacy2">개인정보 취급위탁 동의</label>
                    <span class="checkbox1"><input type="checkbox" id="privacy2"><span></span></span>
                </div>
            </div>
            <div class="agreement-check">
                <label for="agreement_all_check">위의 약관을 확인했으며 모두 동의합니다.</label>
                <span class="checkbox1"><input type="checkbox" id="agreement_all_check"><span></span></span>
            </div>

        </form>
        <div class="register-form-submit">
            <button id="next_btn" class="btn btn--submit">다음 단계</button>
        </div>
        <form class="agreement-form">
            <div class="register-prev-page">

            </div>
        </form>
    </div>
    <div id="register_step" hidden class="register-content">
        <div class="register-form-step">
            <i></i>
            <i class="is-active"></i>
            <i></i>
        </div>
        <div class="register-form-header">
            <h2 class="title">가입 정보 입력</h2>
            <p class="title-desc">로그인 정보 및 가입 정보를 입력해 주세요</p>
        </div>
        <form id="register_form" class="join-form" role="form" method="POST">
            {{ csrf_field() }}
            <div class="item-list item-list--register">
                <div class="item-cols">
                    <label class="label" for="join_id">여우정원 아이디</label>
                    <div class="input">
                        <input name="name" type="text" class="text2" id="join_id" placeholder="아이디 입력">
                        <span class="valid-msg"></span>
                        <span class="alert-msg is-active" id="name_alert"></span>
                    </div>
                </div>
                <div class="item-cols">
                    <label class="label" for="join_email">이메일 주소</label>
                    <div class="input">
                        <input type="email" class="text2" id="join_email" name="email" value="{{ old('email') }}"
                               placeholder="이메일 주소 입력" autofocus>
                        <span class="valid-msg"></span>
                        <span class="alert-msg is-active" id="email_alert"></span>
                    </div>
                </div>
                <div class="item-cols">
                    <label class="label" for="join_nick">닉네임</label>
                    <div class="input">
                        <input type="text" class="text2" id="join_nick" placeholder="닉네임 입력" name="nickname"
                               value="{{ old('nickname') }}" required>
                        <span class="valid-msg"></span>
                        <span class="alert-msg is-active" id="nickname_alert"></span>
                    </div>
                </div>
                <div class="item-cols">
                    <label class="label" for="join_pw">비밀번호</label>
                    <div class="input">
                        <input name="password" required type="password" class="text2" id="join_pw"
                               placeholder="비밀번호(4~16자리)">
                        <span class="valid-msg"></span>
                        <span class="alert-msg is-active" id="password_alert"></span>
                    </div>
                </div>
                <div class="item-cols item-cols--pw2">
                    <label class="label" for="join_pw2">비밀번호 확인</label>
                    <div class="input">
                        <input name="password_confirmation" required type="password" class="text2" id="join_pw2"
                               placeholder="비밀번호 확인">
                        <span class="valid-msg"></span>
                        <span class="alert-msg is-active" id="password_confirmation_alert"></span>
                    </div>
                </div>

                <div class="item-cols">
                    <label class="label" for="join_name">이름</label>
                    <div class="input">
                        <input name="user_name" value="{{ old('user_name') }}" type="text" class="text2" id="join_name"
                               placeholder="이름 입력">
                        <span class="valid-msg"></span>
                        <span class="alert-msg is-active" id="user_name_alert"></span>
                    </div>
                </div>
                <div class="item-cols">
                    <label class="label" for="join_birth">출생년도</label>
                    <div class="input input--birth">
                        <div class="birth-area">
                            <input name="birth" type="text" class="text2" id="join_birth" placeholder="출생년도(4자리)">
                            <!--<span class="valid-msg"></span>-->
                            <span class="alert-msg" id="birth_alert"></span>
                        </div>
                        <div class="gender-area">
                        <span class="radio-flat">
                            <label>
                                <input type="radio" name="gender" value="1"><i></i><span>남</span>
                            </label>
                            <label>
                                <input type="radio" name="gender" value="0"><i></i><span>여</span>
                            </label>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="agreement-check">
                <label for="agreement_all_check">이벤트 등 마케팅 정보 수신에 동의합니다.</label>
                <span class="checkbox1">
                    <input type="hidden" id="agreement_all_check"
                           name="event_mail_available"
                           value="0">
                    <input type="checkbox" id="agreement_all_check" name="event_mail_available"
                           value="1">
                    <span></span></span>
            </div>

        </form>
        <div class="register-form-submit">
            <button id="register_btn" class="btn btn--submit">다음 단계</button>
        </div>
        <div class="register-prev-page" style="margin-left: 30px;">
            <a href="#register_logo"><i class="prev-icon"></i> 이전으로</a>
        </div>
    </div>
    <div hidden id="final" class="register-content">
        <div class="register-form-step">
            <i></i>
            <i></i>
            <i class="is-active"></i>
        </div>
        <div class="register-form-header">
            <h2 class="title">인증 메일 발송</h2>
            <p class="title-desc">메일을 확인해 주세요.</p>
        </div>
        <div class="sendmail-result">
            <p>다음의 메일로 인증 메일이 발송되었습니다.</p>
            <p id="email-addr" class="email-addr"></p>
            <p>이메일 발송 후 3시간 이내에 인증해 주시기 바랍니다.<br>이메일 주소를 인증하시면 회원가입이 완료됩니다.</p>
            <div class="sendmail-btns">
                <form action="{{ route('email_confirm.again') }}" method="post">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn--retry">인증 메일 재발송</button>

                    <a href="{{ route('root') }}" class="btn btn--modify">메인으로 가기</a>
                </form>
            </div>
        </div>
    </div>
    <!-- //회원가입내용 -->
    <!-- step script -->
    <script>
        $("#next_btn").click(function () {
            if ($("#terms").is(":checked") && $("#privacy1").is(":checked") && $("#privacy2").is(":checked")) {
                $("#agreement_step").hide();
                $("#register_step").show();
            }
        });
        $(".register-prev-page").click(function (e) {
            e.preventDefault();
            $("#agreement_step").show();
            $("#register_step").hide();
        });

        $("#register_btn").click(function () {
            //console.log($("#register_form").serializeArray());
            var form_data = $("#register_form").serializeArray();

            $.ajax({
                url: '{{ url('/register') }}',
                type: 'POST',
                data: form_data,

                success: function (e) {
                    $("#register_step").hide();
                    $("#final").show();

                    $("#email-addr").html(form_data[2].value);
                },
                error: function (data) {
                   // console.log(data);
                    $("#email_alert").html("");
                    $("#nickname_alert").html("");
                    $("#password_alert").html("");
                    $("#password_confirmation_alert").html("");
                    $("#name_alert").html("");
                    $("#user_name_alert").html("");
                    $("#birth_alert").removeClass("is-active");
                    $("#gender_alert").html("");

                    $("#email_alert").html(data.responseJSON.email);
                    $("#nickname_alert").html(data.responseJSON.nickname);
                    $("#password_alert").html(data.responseJSON.password);
                    $("#password_confirmation_alert").html(data.responseJSON.password_confirmation);
                    $("#name_alert").html(data.responseJSON.name);
                    $("#user_name_alert").html(data.responseJSON.user_name);
                    $("#birth_alert").addClass("is-active");
                    $("#gender_alert").html(data.responseJSON.gender);
                }
            });

        });

    </script>
    <!-- //step script -->

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
