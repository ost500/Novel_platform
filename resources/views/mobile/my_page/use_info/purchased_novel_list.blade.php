@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->

        <div class="mlist_tit_rwap3">
            <h2 class="mlist_tit5">소설 구매내역 </h2>
        </div>

        <!-- 리스트 -->
        <table class="tbl_dotline2">
            <colgroup>
                <col width="*">
                <col width="25%">
            </colgroup>
            <tbody>
            @foreach ($purchasedNovels as $purchasedNovel)
                <tr>
                    <td class="contxt2">
                        <a href="{{ route('each_novel.novel_group_inning', ['id' => $purchasedNovel->novel_id]) }}">
                            <div class="borContTit">{{ $purchasedNovel->novels->title }} <span
                                        class="green_22"></span></div>
                        </a>

                        <div class="gra_20">{{ $purchasedNovel->created_at }}</div>
                    </td>
                    <td class="buy">1조각</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <!-- 리스트 //-->

        <!-- 페이징 -->
        @include('pagination_mobile', ['collection' => $purchasedNovels, 'url' => route('my_info.purchased_novel_list')."?"])
                <!-- 페이징 //-->
    </div>
    <!-- 페이징 //-->
</div>
</div>
<!-- 내용 //-->
@endsection
