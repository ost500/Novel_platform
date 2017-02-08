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
                    <h2 class="title">소설 구매내역</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--order">
                    <caption>소설 구매내역 목록</caption>
                    <thead>
                    <tr>
                        <th>구매일</th>
                        <th>작품명</th>
                        <th>구매내역</th>
                        {{--<th>상태</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($purchasedNovels as $purchasedNovel)
                        <tr>
                            <td class="col-datetime2">{{ $purchasedNovel->created_at }}</td>
                            <td class="col-subject">{{ $purchasedNovel->novels->title }}</td>
                            <td class="col-detail">1{{ $purchasedNovel->method }}</td>
                            {{--<td class="col-state"><span class="is-cancel">취소</span></td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- //게시판목록 -->

                <!-- 페이징 -->
            @include('pagination_front', ['collection' => $purchasedNovels, 'url' => route('my_info.purchased_novel_list')."?"])
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