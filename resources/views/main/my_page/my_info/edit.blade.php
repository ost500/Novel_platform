@extends('layouts.main_layout')
@section('content')
        <!-- 컨테이너 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="wrap" id="info_edit">
        <!-- LNB -->
        @include('main.my_page.left_sidebar')
                <!-- //LNB -->

        <!-- 서브컨텐츠 -->
        <div class="content" id="content">
            @if(Session::has('flash_message'))
                {{-- important, success, warning, danger and info --}}
                <div class="alert alert-@if(Session('flash_message_level'))@if(Session('flash_message_level')=='info')success @else{{Session('flash_message_level')}}@endif @endif">
                    {{Session('flash_message')}}
                </div>
                @endif
                        <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">정보변경</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 정보변경 -->

                <div class="info-modify">
                    <div class="item-list item-list--info-modify">
                        <div class="item-cols">
                            <div class="label">아이디</div>
                            <div class="input input--data">
                                <span class="info">{{ $me->name }}</span>

                                <div class="input-side-btns">
                                    <form method="get"
                                          action="{{ route('my_info.member_leave.password_again') }}">
                                        {!! csrf_field() !!}
                                        <button type="submit" class="btn">회원탈퇴</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post"
                      action="{{ route('my_info.edit.post') }}">
                    {!! csrf_field() !!}
                    <div class="info-modify">
                        <div class="item-list item-list--info-modify">
                            <div class="item-cols">
                                <div class="label">닉네임</div>
                                <div class="input input--data">

                                    <input name="nickname" type="text" class="text2"
                                           id="info_pw" size="28" value="{{ $me->nickname }}">
                                    <span class="alert alert-inline">{{ $errors->first('nickname') }}</span>

                                    <div class="input-desc-box">닉네임 변경은 처음 1회에 한해 바로 가능하며, 2회부터 30일에 한번만 변경 가능합니다.<br>닉네임은
                                        한글, 영문, 숫자로 1~8자까지 가능합니다.
                                    </div>
                                    {{--<div class="input-side-btns">--}}
                                    {{--<button type="button" class="btn btn--special">변경</button>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                            <div class="item-cols">
                                <div class="label">이메일</div>
                                <div class="input input--data">
                                    <span class="info">{{ $me->email }}</span>

                                    <div class="input-desc-box">
                                        @if ($me->auth_email == 1)
                                            <span class="valid"><i class="valid-icon"></i>인증된 이메일 주소입니다.</span>
                                        @else
                                            <span class="alert"><i class="alert-icon"></i>인증되지 않은 이메일 주소입니다.</span>

                                        @endif
                                    </div>
                                    @if ($me->auth_email != 1)
                                        <div class="input-btns">
                                            <button class="btn btn--special" name="email_confirm_btn"
                                                    type="button" v-on:click="emailConfirm()">인증메일발송
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="item-cols">
                                <div class="label">이름</div>
                                <div class="input input--data">
                                    <span class="info">{{ $me->user_name }}</span>

                                    <div class="input-desc-box"><span class="alert"><i class="alert-icon"></i>성인(실명)인증이 되지 않았습니다.</span>
                                    </div>
                                    <div class="input-btns">
                                        <button type="button" class="btn btn--special">성인인증</button>
                                    </div>
                                </div>
                            </div>
                            <div class="item-cols">
                                <label for="info_pw" class="label">현재 비밀번호</label>

                                <div class="input"><input name="current_password" type="password" class="text2"
                                                          id="info_pw" size="28">
                                    <span class="alert alert-inline">{{ $errors->first('current_password') }}</span>
                                </div>
                            </div>
                            <div class="item-cols">
                                <label for="info_pw2" class="label">새 비밀번호</label>

                                <div class="input">
                                    <input name="password" type="password" class="text2" id="info_pw2" size="28">
                                    <span class="alert alert-inline">{{ $errors->first('password') }}</span>
                                </div>
                            </div>
                            <div class="item-cols">
                                <label for="info_pw3" class="label">비밀번호 확인</label>

                                <div class="input">
                                    <input name="password_confirmation" type="password" class="text2" id="info_pw3"
                                           size="28">
                                    <span class="alert alert-inline">{{ $errors->first('password') }}</span>
                                </div>
                            </div>
                            <div class="item-cols">
                                <div class="label">댓글 공개</div>
                                <div class="input input--data">
                                    <fieldset class="input-check-field">
                                        <legend>댓글 공개</legend>
                                        <label class="checkbox2"><input type="radio" name="comment_show" value="1"
                                                                        @if($me->comment_show) checked @endif><span>내가 쓴 소설 댓글을 공개</span></label>
                                        <label class="checkbox2"><input type="radio" name="comment_show" value="0"
                                                                        @if(!$me->comment_show) checked @endif><span>내가 쓴 소설 댓글을 비공개</span></label>
                                    </fieldset>
                                    <div class="input-desc">
                                        소설 댓글을 공개하지 않을 경우 작가의 설정에 따라 댓글을 달지 못하는 경우가 있을 수 있습니다.
                                    </div>
                                </div>
                            </div>
                            <div class="item-cols">
                                <div class="label">쪽지 수신</div>
                                <div class="input input--data">
                                    <fieldset class="input-check-field">
                                        <legend>쪽지 수신</legend>
                                        <label class="checkbox2"><input type="radio" name="mail_available" value="1"
                                                                        @if($me->mail_available) checked @endif><span>모든 쪽지 수신</span></label>
                                        <label class="checkbox2"><input type="radio"
                                                                        name="mail_available" value="0"
                                                                        @if(!$me->mail_available) checked @endif><span>모든 쪽지 거부</span></label>
                                    </fieldset>
                                    <div class="input-desc">
                                        회원이 보내는 쪽지를 받거나 거부합니다.<br>
                                        작가의 선호작 알림이나, 각 출판사와 관리자가 보내는 쪽지는 설정과 관계 없이 수신됩니다.
                                    </div>
                                </div>
                            </div>
                            <div class="item-cols">
                                <div class="label">이메일 수신</div>
                                <div class="input input--data">
                                    <fieldset class="input-check-field">
                                        <legend>이메일 수신</legend>
                                        <label class="checkbox2"><input type="radio" name="event_mail_available"
                                                                        value="1"
                                                                        @if($me->event_mail_available) checked @endif><span>이벤트 메일 수신</span></label>
                                        <label class="checkbox2"><input type="radio"
                                                                        name="event_mail_available" value="0"
                                                                        @if(!$me->event_mail_available) checked @endif><span>이벤트 메일 거부</span></label>
                                    </fieldset>
                                    <div class="input-desc">
                                        새소식이나 이벤트 등의 안내 메일을 받거나 거부합니다.<br>
                                        약관변경 안내 및 비밀번호 찾기 등의 중요한 내용은 설정과 관계 없이 발송됩니다.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit">
                            <button class="btn btn--special" type="submit">변경완료</button>
                        </div>
                    </div>
                </form>
                <!-- //정보변경 -->
        </div>
        <!-- //서브컨텐츠 -->
        <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
                <!-- //따라다니는퀵메뉴 -->
    </div>
</div>
<!-- //컨테이너 -->
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
                            console.log(errors);
                        })
            }
        }
    });

</script>
@endsection