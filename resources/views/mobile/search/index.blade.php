@extends('layouts.mobile_layout')
@section('content')
<!-- 내용 -->
<div class="container" >
    <div class="cont_wrap" >

        <div class="sort_area_wrap" style=" margin: 36px 0 0 10px;font-size: large;">

                <div style="float:left;">
                    검색 [ @if($search_type) 검색 조건: {{$search_type}} , @endif
                    @if($title) 제목: {{$title}},@endif @if($keyword_name)  해시 태그:{{$keyword_name}} @endif]
                </div><br/>
                <div style="float:left;margin-top:10px;">
                    전체 {{$novel_groups->Total()}} 개의 결과물
                </div>

        </div>
        <table class="tbl_dotline">
            <colgroup>
                <col width="40%">
                <col width="*">
            </colgroup>
            <tbody>
            @foreach($novel_groups as $novel_group)
                <tr>
                    <td class="talC"><span class="mtbl_img">
                            <a href="{{ route('m.each_novel.novel_group',['id'=>$novel_group->id]) }}">
                                <img src="/img/novel_covers/{{$novel_group->cover_photo}}" alt="망의 연월"></a></span>
                    </td>
                    <td class="">
                        <a href="{{ route('m.each_novel.novel_group',['id'=>$novel_group->id]) }}">
                            <div class="mtbl_tit">{{str_limit($novel_group->title,15)}}</div>
                        </a>

                        <div class="bw_name">{{ $novel_group->nicknames->nickname }}<span
                                    class="ago">{{ time_elapsed_string($novel_group->new) }}</span></div>
                        <div class="mtbl_binfo">@foreach($novel_group->keywords as $keyword){{$keyword->name}}@endforeach
                            <span class="mtbl_binfo_sl"></span>총 {{$novel_group->novels_count}}화
                        </div>
                        <div class="mtbl_binfo">조회수 {{$novel_group->total_count}}</div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- 이미지 리스트 //-->

        <!-- 페이징2 -->
        @include('pagination_mobile', ['collection' => $novel_groups, 'url' => route('m.search.index').'?search_type='.$search_type.'&title='.$title.'&keyword_name='.$keyword_name.'&'])
                <!-- 페이징2 //-->
    </div>
</div>
<!-- 내용 //-->
@endsection