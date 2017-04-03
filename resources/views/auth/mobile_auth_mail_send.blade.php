@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <div class="spac60"></div>

        <div class="padt45"><h2 class="join_tit">인증 메일 재발송</h2></div>
        <div class="padt10"><p class="join_tit_info">메일을 다시 발송하였습니다.</p></div>

        <div class="join_gray_txtbox mart35">
            다음의 메일로 인증 메일이 발송되었습니다.
            <div class="userMail mart8">{{ $user->email }}</div>
        </div>

        <div class="cm22txt talC mart20">이메일 발송 후 3시간 이내에 인증해 주시기 바랍니다.<br/>이메일 주소를 인증하시면 회원가입이 완료됩니다. </div>

        <div class="color_btn_wrap mart70">
            <form action="{{ route('email_confirm.again') }}" method="post">
                {!! csrf_field() !!}
            <a style="cursor:pointer;" class="btn_red floL" ><button type="submit" style="background: transparent; border: 0; color: #fff; font-weight: bold; width: 266px; height: 76px;">인증 메일 재발송</button></a>
            <a href="{{ route('root') }}" class="btn_yel floR">메인으로 가기</a>
            </form>
        </div>
    </div>
</div>
<!-- 내용 //-->
@endsection