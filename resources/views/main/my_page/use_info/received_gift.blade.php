@extends('../layouts.main_layout')
@section('content')
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">받은 선물 내역</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--gift">
                    <caption>받은 선물 내역 목록</caption>
                    <thead>
                    <tr>
                        <th>보낸날짜</th>
                        <th>받은 선물</th>
                        <th>보낸사람</th>
                        <th>상태</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($presents->count() == 0)
                        <tr>
                            <td class="col-no-data" colspan="4">받은 내역이 없습니다.</td>
                        </tr>
                    @endif
                    @foreach ($presents as $present)
                        <tr>
                            <td class="col-datetime2">{{ $present->created_at }}</td>
                            <td class="col-subject">{{ $present->content }}</td>
                            <td class="col-from">{{ $present->fromUser->name }}</td>
                            <td class="col-state"><span>수령</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- //게시판목록 -->

                <!-- 페이징 -->
            @include('pagination_front', ['collection' => $presents, 'url' => route('my_info.received_gift')."?"])
            <!-- //페이징 -->

                <!-- 공지 -->
                <p class="mypage-notice mypage-notice--gift">
                    선물 받은 구슬과 조각은 여우정원에 등록된 작품을 구매할 때 사용할 수 있습니다.<br>선물을 수령하지 않으면 30일 후 자동으로 반송됩니다.
                </p>
                <!-- //공지 -->
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