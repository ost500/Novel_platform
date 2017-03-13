@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->

        <div class="mlist_tit_rwap3">
            <h2 class="mlist_tit4">소식</h2>
        </div>

        <!-- 리스트 -->
        <table class="tbl_dotline">
            <colgroup>
                <col width="12%">
                <col width="*">
            </colgroup>
            <tbody>
            @foreach ($new_speeds as $new_speed)
                <tr>
                    <td class="mtbl_img"><img src="{{ $new_speed->image }}" alt="" style="width:70%;"></td>
                    <td class="contxt">
                        <a @if (!$new_speed->read)style="color: #5db38e" @endif
                        href="{{ route('my_page.novels.new_speed.read', ['id' => $new_speed->id]) }}"> <div class="borContTit">{{ $new_speed->title }}<span
                                    class="gra_20 marL8">{{ time_elapsed_string($new_speed->created_at) }}</span></div></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- 리스트 //-->
        <div class="spac40"></div>
        @include('pagination_mobile', ['collection' => $new_speeds, 'url' => route('my_page.novels.new_speed')."?"])
    </div>
</div>
<!-- 내용 //-->
@endsection
