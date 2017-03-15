@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="cont_wrap">
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 -->
        @if(Session::has('flash_message'))
            {{-- important, success, warning, danger and info --}}
            <div class="alert alert-@if(Session('flash_message_level'))@if(Session('flash_message_level')=='info')success @else{{Session('flash_message_level')}}@endif @endif">
                {{Session('flash_message')}}
            </div>
            @endif
                    <!-- 셀렉트박스 //-->

            <!-- 개인정보 변경 -->
            <form method="post" action="{{ route('my_info.edit.post') }}">
                {!! csrf_field() !!}
                <table class="userInfo_tbl" id="info_edit">
                    <colgroup>
                        <col width="31%">
                        <col width="*">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th class="usInfo_lth">아이디</th>
                        <td class="">
                            {{--<form method="get"
                                  action="{{ route('my_info.member_leave.password_again') }}">
                                {!! csrf_field() !!}--}}
                            <div  class="usInfo_txt" > {{$me->email}}</div>

                            <a v-on:click="memberLeavePassword()" class="usInfo_btn1_on with128 floL"
                               style="cursor: pointer;">회원탈퇴</a>
                            {{-- </form>--}}
                        </td>
                    </tr>

                    <tr>
                        <th class="usInfo_lth">닉네임</th>
                        <td class="">
                            <input type="text" name="nickname" value="{{ $me->nickname }}" class="inputBasic2 with244">
                            {{--<a href="" class="usInfo_btn1 with128 floR">변경</a>--}}
                            <div class="red22ng">{{ $errors->first('nickname') }}</div>

                            <div class="grayTxtBox mart20">닉네임 변경은 처음 1회에 한해 바로 가능하며, 2회부터 30일에 한번만 변경 가능합니다. 닉네임은 한글,
                                영문,
                                숫자로 1~8자까지 가능합니다.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="usInfo_lth">이메일</th>
                        <td class="">
                            <span class="usInfo_txt">{{ $me->email }}</span>

                            <div   @if ($me->auth_email != 1)  class=" grayTxtBox_x" @endif>
                                @if ($me->auth_email == 1)
                                    <span class="green">인증된 이메일 주소입니다. </span>
                                @else
                                    <span class="red22ng">인증되지 않은 이메일 주소입니다.   </span>

                                @endif

                            </div>
                            <div class="mart20">
                                <a name="email_confirm_btn" v-on:click="emailConfirm()" style="cursor: pointer;"
                                   class="usInfo_btn1_on with158">인증메일발송
                                </a>
                                {{--<a href="" class="usInfo_btn1 with158 marL8">취소</a>--}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="usInfo_lth">이름</th>
                        <td class="">
                            <span class="usInfo_txt">{{ $me->name }}</span>

                            <div class="grayTxtBox_x"><span class="red22ng">성명(실명)인증이 되지 않았습니다.</span></div>
                            <div class="mart20">
                                <a class="usInfo_btn1_on with158" style="cursor: pointer;" >성인인증</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="usInfo_lth">현재 비밀번호</th>
                        <td class="">
                            <input type="password" name="current_password" class="inputBasic2 full">

                            <div class="red22ng mart8">{{ $errors->first('current_password') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="usInfo_lth">새 비밀번호</th>
                        <td class="">
                            <input type="password" name="password" class="inputBasic2 full">

                            <div class="red22ng mart8">{{ $errors->first('password') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="usInfo_lth">비밀번호 확인</th>
                        <td class="">
                            <input type="password" name="password_confirmation" class="inputBasic2 full">

                            <div class="red22ng mart8"> {{ $errors->first('password') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="usInfo_lth">댓글 공개</th>
                        <td class="">
                            <div class="check_list"><label class="checkbox-wrap">
                                    <input type="checkbox" class="comment_chb" name="comment_show" value="1"
                                           @if($me->comment_show) checked @endif><i
                                            class="check-icon"></i> <span  id="comment_msg1" @if($me->comment_show) class="green" @endif>내가 쓴 소설 댓글을 공개</span></label>
                            </div>
                            <div class="check_list padt15"><label class="checkbox-wrap">
                                    <input type="checkbox" class="comment_chb" name="comment_show" value="0"
                                           @if(!$me->comment_show) checked @endif><i
                                            class="check-icon"></i> <span id="comment_msg0" @if(!$me->comment_show) class="green" @endif>내가 쓴 소설 댓글을 비공개</span></label>
                            </div>
                            <div class="grayTxtBox mart20">소설 댓글을 공개하지 않을 경우 작가의 설정에 따라 댓글을 달지 못하는 경우가 있을 수 있습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="usInfo_lth" style="border-bottom:0;">쪽지 수신</th>
                        <td class="" style="border-bottom:0;">
                            <div class="check_list"><label class="checkbox-wrap"><input type="checkbox"
                                                                                        name="mail_available"
                                                                                        value="1"
                                                                                        class="mail_chb"
                                                                                        @if($me->mail_available) checked @endif><i
                                            class="check-icon"></i> <span id="mail_msg1" @if($me->mail_available) class="green" @endif>모든 쪽지 수신</span></label>
                            </div>
                            <div class="check_list padt15"><label class="checkbox-wrap"><input type="checkbox"
                                                                                               name="mail_available"
                                                                                               value="0"
                                                                                               class="mail_chb"
                                                                                               @if(!$me->mail_available) checked @endif><i
                                            class="check-icon"></i> <span id="mail_msg0"
                                            @if(!$me->mail_available) class="green" @endif>모든 쪽지 거부</span></label></div>
                            <div class="grayTxtBox mart20"> 회원이 보내는 쪽지를 받거나 거부합니다. 작가의 선호작 알림이나, 각 출판사와 관리자가 보내는 쪽지는 설정과
                                관계 없이 수신됩니다.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="usInfo_lth" style="border-bottom:0;">이메일 수신</th>
                        <td class="" style="border-bottom:0;">
                            <div class="check_list"><label class="checkbox-wrap">
                                    <input type="checkbox" class="event_chb" name="event_mail_available" value="1"
                                           @if($me->event_mail_available) checked @endif><i
                                            class="check-icon"></i> <span id="event_msg1"
                                                                          @if($me->event_mail_available) class="green" @endif>이벤트 메일 수신</span></label>
                            </div>
                            <div class="check_list padt15"><label class="checkbox-wrap">
                                    <input type="checkbox" class="event_chb" name="event_mail_available" value="0"
                                           @if(!$me->event_mail_available) checked @endif><i
                                            class="check-icon"></i> <span id="event_msg0"
                                                                          @if(!$me->event_mail_available) class="green" @endif>이벤트 메일 거부</span></label>
                            </div>
                            <div class="grayTxtBox mart20">새소식이나 이벤트 등의 안내 메일을 받거나 거부합니다. 약관변경 안내 및 비밀번호 찾기 등의 중요한 내용은
                                설정과
                                관계 없이 발송됩니다.
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!-- 개인정보 변경 //-->

                <!-- 버튼 -->
                <div class="padtb30">
                    <button type="submit" class="btn_green2 full">변경 완료</button>
                </div>
            </form>
            <!-- 버튼 //-->
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var app = new Vue({
        el: '#info_edit',
        data: {
            info: {}
        },

        methods: {
            emailConfirm: function () {
                app.$http.post('{{ route('email_confirm.again') }}', app.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            location.reload();
                            //console.log(response)
                        }).catch(function (errors) {
                            // console.log(errors);
                        })
            },
            memberLeavePassword: function () {
                location.assign('{{route('my_info.member_leave.password_again')}}')
            }
        }
    });
    $(".comment_chb").change(function () {
        $(".comment_chb").prop('checked', false);
        $(this).prop('checked', true);

        //change the color of text on change
        var value = $(this).val();
        if ($('#comment_msg0').hasClass('green')) {
            if (value != 0) {
                $('#comment_msg0').removeClass('green');
                $('#comment_msg1').addClass('green');
            }

        } else {
            if (value != 1) {
                $('#comment_msg0').addClass('green');
                $('#comment_msg1').removeClass('green');
            }
        }

    });
    $(".mail_chb").change(function () {
        $(".mail_chb").prop('checked', false);
        $(this).prop('checked', true);

        //change the color of text on change
        var value = $(this).val();
        if ($('#mail_msg0').hasClass('green')) {
            if (value != 0) {
                $('#mail_msg0').removeClass('green');
                $('#mail_msg1').addClass('green');
            }

        } else {
            if (value != 1) {
                $('#mail_msg0').addClass('green');
                $('#mail_msg1').removeClass('green');
            }
        }

    });
    $(".event_chb").change(function () {
        $(".event_chb").prop('checked', false);
        $(this).prop('checked', true);

        //change the color of text on change
        var value = $(this).val();
        if ($('#event_msg0').hasClass('green')) {
            if (value != 0) {
                $('#event_msg0').removeClass('green');
                $('#event_msg1').addClass('green');
            }

        } else {
            if (value != 1) {
                $('#event_msg0').addClass('green');
                $('#event_msg1').removeClass('green');
            }
        }


    });

</script>
@endsection