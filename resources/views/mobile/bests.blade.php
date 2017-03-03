@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="cont_wrap" id="bests">
        <div class="sel2_wrap">
            <!-- 텝메뉴 -->
            <ul class="tap2_mn">
                <li class="left"><a href="{{route('m.bests')}}"
                                    @if(!$free_or_charged) class="tap2_mn_on" @endif >유료소설</a></li>
                <li class="right"><a href="{{route('m.bests',['free_or_charged'=>'free'])}}"
                                     @if($free_or_charged) class="tap2_mn_on" @endif>무료소설</a></li>
            </ul>
            <!-- 텝메뉴 //-->
            <!-- 셀렉트박스 -->
            <div class="mart8">
                <select class="full"  id ="bestsSelect" v-on:change="callUrl()">
                    <option value="">Select</option>
                    <option value="투데이베스트"  @if($period=='today_count' && !($option == "현대로맨스" or $option == "시대로맨스" or $option == "로맨스판타지")) selected @endif >투데이베스트</option>
                    <option value="주간베스트"  @if($period=='week_count') selected @endif >주간베스트</option>
                    <option value="월간베스트"  @if($period=='month_count' && $option!='completed') selected @endif >월간베스트</option>
                    <option value="스테디셀러" @if($period=='year_count') selected @endif>스테디셀러</option>
                    <option value="장르별베스트" @if($period=='today_count'&& ($option == "현대로맨스" or $option == "시대로맨스" or $option == "로맨스판타지")) selected @endif >장르별베스트</option>
                    <option value="완결베스트" @if($period=='month_count'&& $option=='completed') selected  @endif >완결베스트</option>
                </select>
            </div>
            <!-- 셀렉트박스 //-->
        </div>

        <!-- 이미지 리스트 -->
        <table class="mlist_tbl" style="border:0;">
            <colgroup>
                <col width="20%">
                <col width="25%">
                <col width="*">
            </colgroup>
            <tbody>
            @foreach($novel_groups as $novel_group)
                <tr>
                    <td class="mtbl_num"><em>{{(10 * ($page-1)) + $loop->iteration}}</em></td>
                    <td class="talC"><span class="mtbl_img"><img src="/img/novel_covers/{{$novel_group->cover_photo}}"></span>
                    </td>
                    <td class="">
                        <div class="mtbl_tit">{{str_limit($novel_group->title,15)}}</div>
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
        <div class="pag_wrap">
            <div class="paging2">
                <a href="" class="pbtn2 prev">이전</a>
                <span class="pag_count">1-20</span>
                <a href="" class="pbtn2 next">다음</a>
            </div>
        </div>
        <!-- 페이징2 //-->
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var bests = new Vue({
        el: '#bests',
        data: {
            optionValue:''
        },
        methods: {
            callUrl: function () {
                this.optionValue= $('#bestsSelect').val();

                if (this.optionValue == '') {
                    location.assign('{{route('m.bests')}}/{{$free_or_charged}}');
                }else if (this.optionValue == '투데이베스트') {
                    location.assign('{{route('m.bests')}}/{{$free_or_charged}}?period=today_count');
                } else if (this.optionValue == '주간베스트') {
                    location.assign('{{route('m.bests')}}/{{$free_or_charged}}?period=week_count');
                }
                else if (this.optionValue == '월간베스트') {
                    location.assign('{{route('m.bests')}}/{{$free_or_charged}}?period=month_count');
                }else if (this.optionValue == '스테디셀러') {
                    location.assign('{{route('m.bests')}}/{{$free_or_charged}}?period=year_count&option=steady');
                }else if (this.optionValue == '장르별베스트') {
                    location.assign('{{route('m.bests')}}/{{$free_or_charged}}?period=today_count&option=현대로맨스');
                }else if (this.optionValue == '완결베스트') {
                    location.assign('{{route('m.bests')}}/{{$free_or_charged}}?period=month_count&option=completed');
                }
            }
        }

    });
</script>
@endsection