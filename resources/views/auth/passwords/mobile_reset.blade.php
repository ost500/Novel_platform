@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <div class="spac60"></div>

        <div class="padt45"><h2 class="join_tit">비밀번호 리셋</h2></div>
        <div class="padt10"><p class="join_tit_info">다음의 정보로 비밀번호가 리셋 됩니다.</p></div>
        <form class="join-form" role="form" method="POST" action="{{ url('/password/reset') }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mart45"><input name="email" type="email" id="email" class="inputJoin full"
                                       placeholder="이메일 입력" value="{{$email or old('email') }}" required>
            </div>
            @if ($errors->has('email'))
                <span class="red22ng" id="email_alert">{{ $errors->first('email') }}</span>
            @endif
            <div class="mart45"><input name="password" type="password" id="password" class="inputJoin full"
                                       placeholder="비밀번호 입력"  required>
            </div>
            @if ($errors->has('password'))
                <span class="red22ng" id="password_alert">{{ $errors->first('password') }}</span>
            @endif
            <div class="mart45"><input name="password_confirmation" type="password" id="password_confirmation" class="inputJoin full"
                                       placeholder="비밀번호 확인 입력"  required>
            </div>
            @if ($errors->has('password_confirmation'))
                <span class="red22ng" id="password_alert">{{ $errors->first('password_confirmation') }}</span>
            @endif


            <div class="color_btn_wrap mart70">

                <a class="btn_red floL" style="cursor:pointer;"> <button  type="submit" style="background: transparent; border: 0; color: #fff; font-weight: bold;font-size: 22px; width: 266px; height: 76px;">비밀번호 리셋</button></a>

            </div>
        </form>
    </div>
</div>
<!-- 내용 //-->
@endsection