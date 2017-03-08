@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="cont_wrap" id="completed">
        <div class="sel2_wrap">
            <!-- 텝메뉴 -->
            <ul class="tap2_mn">
                <li class="left"><a href="{{route('m.completed')}}"
                                    @if(!$free_or_charged) class="tap2_mn_on" @endif>유료소설</a></li>
                <li class="right"><a href="{{route('m.completed',['free_or_charged'=>'free'])}}"
                                     @if($free_or_charged) class="tap2_mn_on" @endif>무료소설</a></li>
            </ul>
            <!-- 텝메뉴 //-->
            <!-- 셀렉트박스 -->
            <div class="mart8">
                <select class="full" id="completedSelect" v-on:change="callUrl()">
                    <option value="전체" @if($genre=='%') selected @endif >전체</option>
                    <option value="현대로맨스" @if($genre=='현대로맨스') selected @endif >현대로맨스</option>
                    <option value="시대로맨스" @if($genre=='시대로맨스') selected @endif >시대로맨스</option>
                    <option value="로맨스판타지" @if($genre=='로맨스판타지') selected @endif>로맨스판타지</option>
                </select>
            </div>
            <!-- 셀렉트박스 //-->
        </div>

        <div class="sort_area_wrap">
            <h3 class="blindtext">정렬보기</h3>

            <div class="sort_area">
                <a href="{{route('m.completed',['free_or_charged'=>$free_or_charged])."?genre=".$genre}}"
                   @if(!isset($order)) class="sort_btn sort_on" @else class="sort_btn sort_off" @endif>업데이트순</a>

                <a href="{{route('m.completed',['free_or_charged'=>$free_or_charged])."?genre=".$genre."&order=favorite"}}"
                   @if($order=="favorite") class="sort_btn sort_on" @else class="sort_btn sort_off" @endif>선호작순</a>

                <a href="{{route('m.completed',['free_or_charged'=>$free_or_charged])."?genre=".$genre."&order=view"}}"
                   @if($order=="view") class="sort_btn sort_on" @else class="sort_btn sort_off" @endif>조회순</a>
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
        @include('pagination_mobile', ['collection' => $novel_groups, 'url' => route('m.completed',['free_or_charged'=>$free_or_charged])."?genre=".$genre."&order=".$order.'&'])
                <!-- 페이징2 //-->
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var series = new Vue({
        el: '#completed',
        data: {
            optionValue: '',
            queryString: ''
        },
        methods: {
            callUrl: function () {
                //Get the selected value
                this.optionValue = $('#completedSelect').val();
                //Create query string
                if ('{{$free_or_charged}}') {
                    this.queryString = '/{{$free_or_charged}}';
                } else {
                    this.queryString = '';
                }
                //Based on values make a request
                if (this.optionValue == '전체') {
                    location.assign('{{route('m.completed')}}' + this.queryString);
                } else if (this.optionValue == '현대로맨스') {
                    location.assign('{{route('m.completed')}}' + this.queryString + '?genre=현대로맨스');
                } else if (this.optionValue == '시대로맨스') {
                    location.assign('{{route('m.completed')}}' + this.queryString + '?genre=시대로맨스');
                } else if (this.optionValue == '로맨스판타지') {
                    location.assign('{{route('m.completed')}}' + this.queryString + '?genre=로맨스판타지');
                }
            }
        }
    });
</script>
@endsection