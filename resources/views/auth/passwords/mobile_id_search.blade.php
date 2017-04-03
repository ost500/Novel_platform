@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <div class="spac60"></div>

        <div class="padt45"><h2 class="join_tit">아이디 찾기</h2></div>
        <div class="padt10"><p class="join_tit_info">가입할 당시 입력했던 이메일 주소를 입력해 주세요.</p></div>
        <form class="join-form" role="form" method="POST" action="{{ url('/id_search') }}">
            {{ csrf_field() }}
            <div class="mart45"><input name="email" type="email" id="email" class="inputJoin full"
                                       placeholder="이메일 입력" value="{{ old('email') }}" required></div>
            @if ($errors->has('email'))
                <span class="red22ng" id="email_alert">본 이메일 주소로 등록된 계정이 없습니다</span>
            @endif
            @if (session('success'))
                <div class="alert alert-success" style="margin-top:10px;">
                    아이디를 성공적으로 찾았습니다.<br><br>
                    찾은 아이디 : {{ session('success') }}
                </div>
            @elseif (session('fail'))
                <div class="alert alert-danger" style="margin-top:10px;">
                    해당 아이디를 찾을 수 없습니다.
                </div>
            @endif
            <div class="color_btn_wrap mart70">
                <a class="btn_red floL" style="cursor:pointer;">
                    <button type="submit"
                            style="background: transparent; border: 0; color: #fff; font-weight: bold;font-size: 22px; width: 266px; height: 76px;">
                        아이디 찾기
                    </button>
                </a>
                @if (session('success'))
                    <a href="{{ url('/login').'?userID='.session('success') }}" class="btn_yel floR" style="cursor:pointer;"> 찾은 아이디로 로그인</a>
                @elseif (session('fail'))
                    <a href="{{ route('root') }}" class="btn_yel floR">메인으로 가기</a>
                @endif
            </div>
        </form>
    </div>
</div>
<!-- 내용 //-->
@endsection