@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->

        <div>
            <div class="mlist_tit_rwap3">
                <h3 class="mlist_tit4">결제내역</h3>
            </div>

            <table class="tbl_dotline2">
                <colgroup>
                    <col width="*">
                    <col width="25%">
                </colgroup>
                <tbody>
                @foreach ($pays as $pay)
                    <tr>
                        <td class="contxt2">
                            <div class="norml_26">{{ $pay->numbers."개를 ". $pay->content }}</div>
                            <div class="gra_20">구매일 {{ $pay->created_at }}</div>
                        </td>
                        <td class="inning">{{ $pay->method }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <!-- 페이징 -->
            @include('pagination_mobile', ['collection' => $pays, 'url' => route('my_info.charge_list')."?"])
                    <!-- 페이징 //-->
        </div>
    </div>
</div>
</div>
<!-- 내용 //-->
@endsection