@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <h2 class="login_tit">LOGIN</h2>
        <!-- 로그인 폼 -->
        <form method="post" action="{{url('/login')}}">
            {{ csrf_field() }}
            <fieldset>
                <legend class="screen_out">아이디,비밀번호 로그인 정보 입력 폼</legend>
                <input type="text" name="name" id="email" class="inputLogin full" placeholder="여우정원계정" autofocus
                       value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <span class="alert-msg is-active" style="font-size: 15px;">{{ $errors->first('name') }}</span>
                @endif
                <input type="password" name="password" id="password" class="inputLogin full mart15"
                       placeholder="비밀번호(4~16자리)" required>
                @if ($errors->has('password'))
                    <span class="alert-msg is-active" style="font-size: 15px;" >{{ $errors->first('password') }}</span>
                @endif

                <div class="login_btn_wrap">
                    <button type="submit" class="btn_login">로그인</button>
                </div>
            </fieldset>
        </form>
        <!-- 로그인 폼 //-->

        <div class="login_rel">
            <a href="" class="join">회원가입</a>
            <a href="" class="findIdPw">아이디 찾기</a>
            <span class="logRelSli"></span>
            <a href="" class="findIdPw">비밀번호 찾기</a>
        </div>
    </div>
</div>
<!-- 내용 //-->
@endsection