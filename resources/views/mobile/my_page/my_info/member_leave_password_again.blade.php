@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->

        <!-- 비밀번호 입력 -->
        <div class="pw_reinput_box">
            <div class="cmtxt28">정말로 탈퇴 하시겠습니까? <br/>보안을 위해 비밀번호를 한번 더 입력해 주세요.</div>
            <form method="post" action="{{ route('my_info.member_leave') }}">
                {!! csrf_field() !!}
                <div class="padt10">
                    <input  name="password" type="password" size="28" class="inputBasic2 with280" style="margin-bottom: 10px;">
                    <button type="submit" class="sbtn_line_green marL8">확인</button>
                     <span class="mart12">
                        @if( $errors->first('password'))
                             <i class="alert-icon"></i> {{ $errors->first('password') }}
                         @endif
                     </span>
                </div>
            </form>
        </div>
        <!-- 비밀번호 입력 //-->
    </div>
</div>
<!-- 내용 //-->
@endsection