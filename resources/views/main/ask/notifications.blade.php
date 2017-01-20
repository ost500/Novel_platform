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
                    <h2 class="title">공지사항</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list-notice">
                   <caption>공지사항 목록</caption>
                    <thead>
                    <tr>
                        <th>분류</th>
                        <th>제목</th>
                        <th>등록일</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notifications as $notification)
                    <tr>
                        <td class="col-category">{{$notification->category}}</td>
                        <td class="col-subject">
                            <a href="#mode_nav">{{$notification->title}}</a>
                        </td>
                        <td class="col-datetime">{{$notification->created_at}}</td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                <!-- //게시판목록 -->

                <!-- 페이징 -->
                <div class="page-nav">
                    @include('pagination_front', ['collection' => $notifications, 'url' => route('ask.notifications'),'page'=>'?page='])
                </div>
                <!-- //페이징 -->

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