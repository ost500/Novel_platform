@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->

        <!-- 게시글 관리 -->
        <div class="">
            <h2 class="myBrdTit">추천 리뷰 관리</h2>
            <!-- 전체관리 체크 -->
            <div class="padtb8">
                <table class="tbl_noline">
                    <colgroup>
                        <col width="40px">
                        <col width="*">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="talC"><label class="checkbox-wrap"><input type="checkbox" name="" value=""><i class="check-icon"></i></label></td>
                        <td class="contxt">전체선택</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- 전체관리 체크 //-->

            <!-- 게시글 테이블 -->
            <table class="tbl_dotline">
                <colgroup>
                    <col width="40px">
                    <col width="*">
                </colgroup>
                <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td class="talC talT"><label class="checkbox-wrap"><input type="checkbox" name="" value=""><i class="check-icon"></i></label></td>
                        <td class="contxt">
                            <div class="borContTit">{{ $article->title }}<em class="count">{{ $article->comments_count }}</em></div>
                            <span class="time">{{ $article->created_at }}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- 게시글 테이블 //-->

            <!-- 페이징 -->
            @include('pagination_mobile', ['collection' => $articles, 'url' => route('my_info.review_manage').'?'])
                    <!-- 페이징 //-->
        </div>
        <!-- 게시글 관리 //-->
    </div>
</div>
<!-- 내용 //-->
@endsection