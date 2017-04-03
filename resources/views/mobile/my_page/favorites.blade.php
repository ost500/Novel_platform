@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap" id="my_info">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->
        <!-- 정렬 -->
        <div class="mysort_area_wrap">
            <h3 class="blindtext">정렬보기</h3>

            <div class="mysort_area">
                <a href="{{route('my_page.favorites').'?filter='.$filter}}"
                   @if(!$keyword_name) class="sort_btn sort_on" @else class="sort_btn sort_off" @endif>전체</a>
                @foreach($keywords as $keyword)
                    <a href="{{route('my_page.favorites').'?filter='.$filter.'&keyword='.$keyword->name }}"
                       @if($keyword_name == $keyword->name) class="sort_btn sort_on"
                       @else class="sort_btn sort_off" @endif>{{$keyword->name}}</a>
                @endforeach

            </div>
        </div>
        <!-- 정렬 //-->


        <!-- 이미지 리스트 -->
        <table class="mlist_tbl">
            <colgroup>
                <col width="30%">
                <col width="*">
                <col width="20%">
            </colgroup>
            <tbody>
            @if(count($my_favorites)  > 0)
                @foreach($my_favorites as $my_favorite )
                    <tr>
                        <td class="talC"><span class="mtbl_img"><a
                                        href="{{route('each_novel.novel_group',['id'=>$my_favorite->id])}}">
                                    <img src="/img/novel_covers/{{$my_favorite->cover_photo}}"></a>
                    </span>
                        </td>
                        <td class="">
                            <a href="{{route('each_novel.novel_group',['id'=>$my_favorite->id])}}">
                                <div class="mtbl_tit">
                                    {{str_limit($my_favorite->title,15)}}<br/>
                                    @if($week_gap < $my_favorite->new) <span class="ic_cong"><img
                                                src="/mobile/images/ico_n.png"></span>@endif
                                    @if($my_favorite->completed) <span class="ic_cong"><img
                                                src="/mobile/images/ico_e.png"></span>@endif
                                    @if($my_favorite->secret) <span class="ic_cong"><img
                                                src="/mobile/images/ico_secret.png"></span>@endif
                                </div>
                            </a>

                            <div class="bw_name">{{$my_favorite->nicknames->nickname}}</div>
                            <div class="padt10"><span class="ago">{{time_elapsed_string($my_favorite->new)}}</span>
                            </div>
                        </td>
                        <td class="talC"><a href="" class="icon_btn_bmk"><span class="icon_btn_bmk_on">즐겨찾기</span></a>
                        </td>
                    </tr>
                @endforeach
            @else
                <div style="text-align:center;padding: 20px;"> 해당 조건의 작품이 없습니다.
                </div>
            @endif

            </tbody>
        </table>
        <!-- 이미지 리스트 //-->

        <!-- 페이징 -->
        @include('pagination_mobile', ['collection' => $my_favorites, 'url' => route('my_page.favorites').$query_string.'&'])
                <!-- 페이징 //-->
    </div>
</div>
<!-- 내용 //-->
<!-- 내용 //-->

@endsection