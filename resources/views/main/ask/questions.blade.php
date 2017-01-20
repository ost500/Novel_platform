@extends('../layouts.main_layout')
@section('content')
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            @include('main.ask.left_sidebar')
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">1:1문의</h2>
                    <div class="links">
                        <a href="{{route('ask.ask_question')}}">문의하기</a><a href="{{route('ask.questions')}}" class="is-active">문의내역</a>
                    </div>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--qa">
                    <caption>1:1문의 목록</caption>
                    <thead>
                    <tr>
                        <th>문의유형</th>
                        <th>제목</th>
                        <th>등록일</th>
                        <th>상태</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                    <tr>
                        <td class="col-category">{{$question->category}}</td>
                        <td class="col-subject">
                            <a href="#mode_nav">{{$question->title}}</a>
                        </td>
                        <td class="col-datetime">{{$question->created_at}}</td>
                        <td class="col-state"><span @if($question->status) class="is-answer" @endif>읽지않음</span></td>
                    </tr>
                    @endforeach
                </table>
                <!-- //게시판목록 -->

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
    <!-- 푸터 -->
@endsection