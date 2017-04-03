@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">회원탈퇴</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 정보변경 -->
                <div class="password-check">
                    <p>정말로 탈퇴 하시겠습니까?</p>
                    <p>보안을 위해 비밀번호를 한번 더 입력해 주세요.</p>
                    <form method="post"
                          action="{{ route('my_info.member_leave') }}">
                        {!! csrf_field() !!}
                        <div class="input-block">
                            <input name="password" type="password" class="text2" size="28" title="비밀번호">
                            <button class="btn btn--special" type="submit">확인</button>
                            <div class="input-desc-box">
                                <span class="alert">
                                    <i class="alert-icon"></i> {{ $errors->first('password') }}
                                </span>
                            </div>

                        </div>
                    </form>

                </div>
                <!-- //정보변경 -->

            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->

@endsection