@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">My정보</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="#mode_nav">마이페이지 홈</a>
                        </li>
                        <li>
                            <a href="#mode_nav">선호작</a>
                        </li>
                        <li>
                            <a href="#mode_nav">이용정보</a>
                        </li>
                        <li>
                            <a href="#mode_nav">소설</a>
                        </li>
                        <li>
                            <a href="#mode_nav" class="is-active">개인</a>
                            <ul class="lnb-depth2">
                                <li><a href="#mode_nav">게시글 관리</a></li>
                                <li><a href="#mode_nav">일반 댓글 관리</a></li>
                                <li><a href="#mode_nav">소설 댓글 관리</a></li>
                                <li><a href="#mode_nav">추천 리뷰 관리</a></li>
                                <li><a href="#mode_nav">1:1 문의</a></li>
                                <li><a href="#mode_nav" class="is-active">정보변경</a></li>
                                <li><a href="#mode_nav">쪽지</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
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
            <div class="aside-nav" id="aside_nav">
                <nav>
                    <ul class="aside-menu">
                        <li><a href="#mode_nav" class="userbtn userbtn--alarm"><span>알림</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--memo"><span>쪽지</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--myinfo"><span>마이메뉴</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--scrap"><span>선호작</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--marble"><span>보유구슬</span></a></li>
                    </ul>
                </nav>
            </div>
            <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->

@endsection