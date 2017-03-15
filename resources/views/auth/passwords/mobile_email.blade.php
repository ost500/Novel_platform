@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <div class="spac60"></div>

        <div class="padt45"><h2 class="join_tit">비밀번호 리셋 메일 발송</h2></div>
        <div class="padt10"><p class="join_tit_info">메일을 확인해 주세요</p></div>
        <div class="padt10"><p class="join_tit_info">다음의 메일로 비밀번호 리셋 메일이 발송 됩니다.</p></div>
        <form class="join-form" role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            <div class="mart45"><input name="email" type="email" id="email" class="inputJoin full"
                                       placeholder="이메일 주소 입력" value="{{ old('email') }}" required></div>
            @if ($errors->has('email'))
                <span class="red22ng" id="email_alert">본 이메일 주소로 등록된 계정이 없습니다</span>
            @endif
            @if (session('status'))
                <div class="alert alert-success" style="margin-top:10px;">
                    비밀번호 리셋 메일을 성공적으로 전송했습니다
                </div>
            @endif
            <div class="color_btn_wrap mart70">

                <a class="btn_red floL" style="cursor:pointer;"> <button  type="submit" style="background: transparent; border: 0; color: #fff; font-weight: bold;font-size: 22px; width: 266px; height: 76px;">비밀번호 리셋 링크 전송</button></a>
                @if (session('status'))
                    <a href="{{ route('root') }}" class="btn_yel floR">메인으로 가기</a>
                @endif
            </div>
        </form>
    </div>
</div>
<!-- 내용 //-->
@endsection