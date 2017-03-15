@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->

        <!-- 안내 문구 -->
        <div class="alert_box2">
            <div class="alert_b2_tit">조각이란?</div>
            여우정원에서 제공하는 서비스 결제 수단입니다.<br/>한 개의 조각은 한 개의 구슬처럼 사용할 수 있습니다.
        </div>
        <!-- 안내 문구 //-->

        <div class="padt40">
            <div class="piece_ico_tit">내가 가진 조각<span class="marble_num marL8">100 조각</span></div>
        </div>

        <div class="mlist_tit_rwap5">
            <h2 class="mlist_tit5">조각관리 </h2>
        </div>

        <!-- 리스트 -->
        <table class="tbl_dotline2">
            <tbody>
            @foreach ($pieces as $piece)
                <tr>
                    <td class="contxt2">
                        <div class="borContTit">{{ $piece->content }} <span class="green_22">{{ $piece->numbers }}
                                개</span></div>
                        <div class="gra_20">적립일 {{ $piece->created_at }} / 소멸일 {{ $piece->deadline }}</div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <!-- 리스트 //-->

        <!-- 페이징 -->
        @include('pagination_mobile', ['collection' => $pieces, 'url' => route('my_info.manage_piece')."?"])
                <!-- 페이징 //-->
    </div>
    <!-- 페이징 //-->
</div>
</div>
<!-- 내용 //-->
@endsection