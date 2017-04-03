@extends('layouts.mobile_layout')
@section('content')

        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap" id="agreement_step">
        <div class="padt35">
            <!-- 도트 페이지 -->
            <ul class="dot_pag_wrap">
                <li><span class="dot_pag dot_on">1</span></li>
                <li><span class="dot_pag dot_off">2</span></li>
                <li><span class="dot_pag dot_off">3</span></li>
            </ul>
            <!-- 도트 페이지 //-->
        </div>
        <div class="padt45"><h2 class="join_tit">회원 가입 약관</h2></div>
        <div class="padt10"><p class="join_tit_info">아래의 약관을 읽고 동의해 주세요.</p></div>

        <form method="post" class="agreement-form" name="agreement_form">
            <fieldset>
                <legend>여우정원 서비스 약관 및 개인정보 수집 등에 대한 동의</legend>

                <div class="agree_box mart35">
                    <!-- 약관동의 -->
                    <div class="agree_tit_box">
                        <h3 class="agree_tit">이용약관 동의</h3>

                        <div class="agree_btn"><input type="checkbox" id="terms" value="1"></div>
                        <!-- 약관동의 체크박스 -->
                    </div>
                    <div class="agree_cont_box">
                        제 1장 총칙<br/>제 1장 총칙<br/>제 1장 총칙<br/>제 1장 총칙<br/>제 1장 총칙<br/>제 1장 총칙<br/>제 1장 총칙
                    </div>
                    <!-- 약관동의 //-->
                </div>

                <div class="agree_box mart15">
                    <!-- 개인정보 취급방침 -->
                    <div class="agree_tit_box">
                        <h3 class="agree_tit">개인정보 취급방침 동의</h3>

                        <div class="agree_btn"><input type="checkbox" id="privacy1"></div>
                        <!-- 약관동의 체크박스 -->
                    </div>
                    <div class="agree_cont_box">
                        1. 수집하는 개인정보의 항목 및 수집방법 <br/>
                        1. 수집하는 개인정보의 항목 및 수집방법정보의 항목 및 수집방법정보의 항목 및 수집방법정보의 항목 및 수집방법 <br/>
                        1. 수집하는 개인정보의 항목 및 수집방법 <br/>
                        1. 수집하는 개인정보의 항목 및 수집방법정보의 항목 및 수집방법정보의 항목 및 수집방법정보의 항목 및 수집방법 <br/>
                    </div>
                    <!-- 개인정보 취급방침 //-->
                </div>

                <div class="agree_box mart15">
                    <!-- 개인정보 취급위탁 -->
                    <div class="agree_tit_box">
                        <h3 class="agree_tit">개인정보 취급위탁 동의</h3>

                        <div class="agree_btn"><input type="checkbox" id="privacy2"></div>
                        <!-- 약관동의 체크박스 -->
                    </div>
                    <div class="agree_cont_box">
                        회사는 보다나은<br/>회사는 보다나은<br/>회사는 보다나은<br/>회사는 보다나은<br/>회사는 보다나은<br/>회사는 보다나은
                    </div>
                    <!-- 개인정보 취급위탁 //-->
                </div>

                <div class="all_agree_wrap">
                    <span class="all_agree_txt">위의 약관을 확인했으며 모두 동의합니다.</span>
                    <span class=""><input type="checkbox" id="agreement_all_check"></span>
                </div>

                <div class="padt40">
                    <button id="next_btn" class="btn_green2 full">다음 단계</button>
                </div>

                <div class="padtb40">
                    <a href="" class="join_back_btn">이전으로</a>
                </div>
            </fieldset>
        </form>
    </div>
    <div id="register_step" hidden class="cont_wrap">
        <div class="padt35">
            <!-- 도트 페이지 -->
            <ul class="dot_pag_wrap">
                <li><span class="dot_pag dot_off">1</span></li>
                <li><span class="dot_pag dot_on">2</span></li>
                <li><span class="dot_pag dot_off">3</span></li>
            </ul>
            <!-- 도트 페이지 //-->
        </div>
        <div class="padt45"><h2 class="join_tit">가입 정보 입력</h2></div>
        <div class="padt10"><p class="join_tit_info">로그인 정보 및 가입 정보를 입력해 주세요</p></div>

        <form method="post" id="register_form">
            {{ csrf_field() }}
            <fieldset>
                <legend>로그인 정보 입력</legend>

                <div class="mart35">
                    <input type="text" name="name" id="join_id" class="inputJoin full" placeholder="아이디 입력" autofocus>
                    <span class="red22ng" id="name_alert"></span>
                </div>

                <div class="mart15">
                    <input type="text" name="email" id="join_email" class="inputJoin full" value="{{ old('email') }}"
                           placeholder="이메일 주소 입력" autofocus>
                    <span class="red22ng" id="email_alert"></span>
                </div>

                <div class="mart15">
                    <input type="text" name="nickname" id="join_nick" class="inputJoin full" placeholder="닉네임 입력"
                           value="{{ old('nickname') }}"  autofocus required>
                    <span class="red22ng" id="nickname_alert"></span>
                </div>

                <div class="mart15">
                    <input type="password" name="password" id="join_pw" class="inputJoin full"
                           placeholder="비밀번호 (4~16자리)" required autofocus>
                    <span class="red22ng" id="password_alert"></span>
                </div>

                <div class="mart15">
                    <input type="password" name="password_confirmation" id="join_pw2" class="inputJoin full"
                           placeholder="비밀번호 확인" required >
                    <span class="red22ng" id="password_confirmation_alert"></span>
                </div>

                <div class="mart15">
                    <input type="text" name="user_name" id="join_name" value="{{ old('user_name') }}"
                           class="inputJoin full" placeholder="이름 입력" autofocus>
                    <span class="red22ng" id="user_name_alert"></span>
                </div>

                <div class="mart15">
                    <ul class="birth_wrap">
                        <li style="width:340px;">
                            <input type="text" name="birth" id="join_birth" class="inputJoin full"
                                   placeholder="출생년도(4자리)">
                            <span class="red22ng" id="birth_alert"></span>
                        </li>
                        <li style="width:110px;" class="birth_btn on">
                            <input type="checkbox" name="gender" id="gender1" value="1" class="chb" checked
                                   style="opacity:0;width: 100px;position:absolute;right:115px;height: 60px;">남
                        </li>
                        <li style="width:110px;" class="birth_btn off bordR">
                            <input type="checkbox" name="gender" id="gender2" value="0" class="chb"
                                   style="opacity:0;position:absolute;right:4px;width: 100px;height: 60px;">여
                        </li>
                    </ul>

                </div>

                <div class="all_agree_wrap">
                    <span class="all_agree_txt">이벤트 등 마케팅 정보 수신에 동의합니다.</span>
                    <span class="">
                        <input type="hidden" id="agreement_all_check"
                               name="event_mail_available"
                               value="0">

                        <input type="checkbox" id="agreement_all_check" name="event_mail_available"
                               value="1"></span>
                </div>

                <div class="padt40">
                    <button id="register_btn" type="submit" class="btn_green2 full">다음 단계</button>
                </div>

                <div class="padtb40">
                    <a id="previous_btn" class="join_back_btn" style="cursor:pointer;">이전으로</a>
                </div>
            </fieldset>
        </form>
    </div>

    <!-------------------------- Step 3       -------------------------->
    <div class="cont_wrap" hidden id="final">
        <div class="padt35">
            <!-- 도트 페이지 -->
            <ul class="dot_pag_wrap">
                <li><span class="dot_pag dot_off">1</span></li>
                <li><span class="dot_pag dot_off">2</span></li>
                <li><span class="dot_pag dot_on">3</span></li>
            </ul>
            <!-- 도트 페이지 //-->
        </div>
        <div class="padt45"><h2 class="join_tit">인증 메일 발송</h2></div>
        <div class="padt10"><p class="join_tit_info">메일을 확인해 주세요</p></div>

        <div class="join_gray_txtbox mart35">
            다음의 메일로 인증 메일이 발송되었습니다.
            <div class="userMail mart8" id="email-addr"></div>
        </div>

        <div class="cm22txt talC mart20">이메일 발송 후 3시간 이내에 인증해 주시기 바랍니다.<br/>이메일 주소를 인증하시면 회원가입이 완료됩니다.</div>

        <div class="color_btn_wrap mart70">
            <form action="{{ route('email_confirm.again') }}" method="post">
                {!! csrf_field() !!}
                <a class="btn_red floL" style="cursor:pointer;"><button type="submit" style="background: transparent; border: 0; color: #fff; font-weight: bold; width: 266px; height: 76px;">인증 메일 재발송</button></a>
                <a href="{{ route('root') }}" class="btn_yel floR">메인으로 가기</a>
            </form>
        </div>
    </div>
</div>
<!-- 내용 //-->
<script>
    $("#next_btn").click(function (e) {
        e.preventDefault();
        if ($("#terms").is(":checked") && $("#privacy1").is(":checked") && $("#privacy2").is(":checked")) {
            $("#agreement_step").hide();
            $("#register_step").show();
        }
    });

    $("#previous_btn").click(function (e) {
        e.preventDefault();
        $("#agreement_step").show();
        $("#register_step").hide();
    });

    $(".chb").change(function () {
        $(".chb").prop('checked', false);
        $(this).prop('checked', true);

        $(".chb").parent().addClass('off');
        $(this).parent().removeClass('off');
        $(this).parent().addClass('on');


    });


    $("#agreement_all_check").click(function () {
        if ($(this).is(':checked')) {
            $("#terms").prop("checked", true);
            $("#privacy1").prop("checked", true);
            $("#privacy2").prop("checked", true);
        } else {
            $("#terms").prop("checked", false);
            $("#privacy1").prop("checked", false);
            $("#privacy2").prop("checked", false);
        }
    });


    $("#register_btn").click(function (e) {
        // console.log($("#register_form").serializeArray());
        e.preventDefault();
        console.log('register_form');
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
                console.log(data);
                $("#email_alert").html("");
                $("#nickname_alert").html("");
                $("#password_alert").html("");
                $("#password_confirmation_alert").html("");
                $("#name_alert").html("");
                $("#user_name_alert").html("");
                $("#join_birth").css('border','');
                $("#gender_alert").html("");

                $("#email_alert").html(data.responseJSON.email);
                $("#nickname_alert").html(data.responseJSON.nickname);
                $("#password_alert").html(data.responseJSON.password);
                $("#password_confirmation_alert").html(data.responseJSON.password_confirmation);
                $("#name_alert").html(data.responseJSON.name);
                $("#user_name_alert").html(data.responseJSON.user_name);
               if(data.responseJSON.birth) {
                   $("#join_birth").css('border', '1px solid #b2363a');
               }
                $("#gender_alert").html(data.responseJSON.gender);
            }
        });

    });

</script>
@endsection