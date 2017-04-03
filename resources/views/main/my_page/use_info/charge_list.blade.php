@extends('../layouts.main_layout')
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
                    <h2 class="title">결제내역</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--payment">
                    <caption>결제내역 목록</caption>
                    <thead>
                    <tr>
                        <th>구매일</th>
                        <th>결제내역</th>
                        <th>결제수단</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pays as $pay)
                        <tr>
                            <td class="col-datetime2">{{ $pay->created_at }}</td>
                            <td class="col-subject">{{ $pay->numbers."개를 ". $pay->content }}</td>
                            <td class="col-payment">{{ $pay->method }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- //게시판목록 -->

                <!-- 페이징 -->
            @include('pagination_front', ['collection' => $pays, 'url' => route('my_info.charge_list')."?"])
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