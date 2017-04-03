@extends('../layouts.main_layout')
@section('content')
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 조각이란 -->
                <div class="box-header">
                    <h2 class="title">조각이란?</h2>
                    <p class="title-desc">여우정원에서 제공하는 서비스 결제 수단입니다.<br>한 개의 조각은 한 개의 구슬처럼 사용할 수 있습니다.</p>
                </div>
                <div class="my-item">
                    <i class="piece3-icon"></i><span class="item-name">내가 가진 조각</span><strong class="count">{{Auth::user()->piece}}개</strong>
                </div>
                <!-- //조각이란 -->

                <!-- 페이지헤더 -->
                <div class="list-header list-header--piece">
                    <h2 class="title">조각관리</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--piece">
                    <caption>조각관리 목록</caption>
                    <thead>
                    <tr>
                        <th>적립일</th>
                        <th>적립내역</th>
                        <th>적립조각</th>
                        <th>소멸일</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pieces as $piece)
                        <tr>
                            <td class="col-datetime2">{{ $piece->created_at }}</td>
                            <td class="col-subject">{{ $piece->content }}</td>
                            <td class="col-payment">{{ $piece->numbers }}개</td>
                            <td class="col-datetime3">{{ $piece->deadline }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- //게시판목록 -->

                <!-- 페이징 -->
            @include('pagination_front', ['collection' => $pieces, 'url' => route('my_info.manage_piece')."?"])
                <!-- //페이징 -->
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->


@endsection