@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="cont_wrap" id="reader_reco">
        <div class="sel2_wrap">
            <!-- 텝메뉴 -->
            <ul class="tap2_mn">
                <li class="left"><a href="{{route('m.free_board')}}" class="">자유게시판</a></li>
                <li class="right"><a href="{{route('m.reader_reco')}}" class="tap2_mn_on">독자추천</a></li>
            </ul>
            <!-- 텝메뉴 //-->
            <!-- 셀렉트 박스 -->
            <div class="mart8">
                <select class="full" id="readerSelect" v-on:change="callUrl()">
                    <option value="전체" @if($genre=='%') selected @endif >전체</option>
                    <option value="현대로맨스" @if($genre=='현대판타지' || $genre == '현대') selected @endif>현대로맨스</option>
                    <option value="시대로맨스" @if(($genre=='시대' or $genre == '사극' or $genre == '동양판타지')) selected @endif >
                        시대로맨스
                    </option>
                    <option value="서양역사" @if(($genre=='서양역사' or $genre == '로맨스판타지')) selected @endif >서양역사</option>
                </select>
            </div>
            <div class="mart8">
                @if($genre=='현대판타지' || $genre == '현대')

                    <a href="{{route('m.reader_reco')}}?genre=현대"
                       @if($genre=='현대') class="green" @else  class="mlist_tit4" @endif
                       style="padding: 7px;border-right: 1px solid lightgrey;"><span>현대</span></a>
                    <a href="{{route('m.reader_reco')}}?genre=현대판타지"
                       @if($genre=='현대판타지')class="green" @else class="mlist_tit4" @endif>현대판타지</a>

                @endif

                @if(($genre=='시대' or $genre == '사극' or $genre == '동양판타지'))
                    <a href="{{route('m.reader_reco')}}?genre=시대"
                       @if($genre=='시대')  class="green" @else  class="mlist_tit4" @endif
                       style="padding: 7px;border-right: 1px solid lightgrey;">시대</a>
                    <a href="{{route('m.reader_reco')}}?genre=사극"
                       @if($genre=='사극')  class="green" @else  class="mlist_tit4" @endif
                       style="padding: 7px;border-right: 1px solid lightgrey;">사극</a>
                    <a href="{{route('m.reader_reco')}}?genre=동양판타지"
                       @if($genre=='동양판타지') class="green" @else  class="mlist_tit4" @endif>동양판타지</a>

                @endif
                @if(($genre=='서양역사' or $genre == '로맨스판타지'))
                    <a href="{{route('m.reader_reco')}}?genre=서양역사"
                       @if($genre=='서양역사') class="green" @else  class="mlist_tit4" @endif
                       style="padding: 7px;border-right: 1px solid lightgrey;">서양역사</a>
                    <a href="{{route('m.reader_reco')}}?genre=로맨스판타지"
                       @if($genre=='로맨스판타지')  class="green" @else  class="mlist_tit4" @endif>로맨스판타지</a>
                @endif

            </div>
            <!-- 셀렉트 박스 //-->

            @if(Session::has('flash_message'))
                {{-- important, success, warning, danger and info --}}
                <div class="alert alert-success">
                    {{Session('flash_message')}}
                </div>
            @endif
        </div>

        <!-- 검색하기 -->
        <div class="mlist_tit_rwap6">
            <form action="{{Request::url()}}" class="content-search-form">
                <select name="search_option" class="selstyl2" style="width:170px;">
                    <option value="title">제목</option>
                    <option value="content">내용</option>
                </select>

                <input type="text" name="search_text" class="inputBacol marL12" style="width:300px;">
                <button type="submit" class="sch_btn"
                        style="margin-left:10px;width:57px;height:57px;border-color:transparent;">검색
                </button>
            </form>
            {{--  <a href="" class="sch_btn marL12">검색</a>--}}
        </div>
        <!-- 검색하기 //-->

        <!-- 이미지 리스트 -->
        <table class="mlist_tbl">
            <colgroup>
                <col width="30%">
                <col width="*">
            </colgroup>
            <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td class="talC"><span class="mtbl_img"><a
                                    href="{{ route('m.reader_reco.detail', ['id' => $review->id]) }}">
                                <img src="/img/novel_covers/{{$review->novel_groups->cover_photo}}"></a></span></td>
                    <td class="">
                        <a href="{{ route('m.reader_reco.detail', ['id' => $review->id]) }}">
                            <div class="mtbl_tit">{{str_limit($review->title,20)}}</div>
                        </a>

                        <div class="mtbl_binfo">{{str_limit($review->review,50)}}</div>
                        <div class="bw_name">{{$review['users']['name']}}<span
                                    class="ago">{{ time_elapsed_string($review->created_at) }}</span></div>
                        <div class="mtbl_binfo">
                            <span>{{ $review->novel_groups->keywords[0]->name }}</span>

                            <span class="mtbl_binfo_sl"></span>조회수{{$review->total_count}}</div>
                        <div class="mtbl_binfo">작성일 {{ $review->created_at->format('Y-m-d') }}</div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <!-- 이미지 리스트 //-->

        <!-- 페이징 -->
        @include('pagination_mobile', ['collection' => $reviews, 'url' => route('m.reader_reco')."?genre=".$genre."&search_option=".$search_option."&search_text=".$search_text."&novel_group=".$novel_group_id."&review_user=".$review_user_id."&"])
                <!-- 페이징 //-->
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var app = new Vue({
        el: '#reader_reco',
        data: {
            optionValue: ''
        },
        methods: {
            callUrl: function () {
                //Get the selected value
                this.optionValue = $('#readerSelect').val();
                console.log(this.optionValue);
                //Based on values make a request
                if (this.optionValue == '전체') {
                    location.assign('{{route('m.reader_reco')}}');
                } else if (this.optionValue == '현대로맨스') {
                    location.assign('{{route('m.reader_reco')}}?genre=현대');
                } else if (this.optionValue == '시대로맨스') {
                    location.assign('{{route('m.reader_reco')}}?genre=시대');

                } else if (this.optionValue == '서양역사') {
                    location.assign('{{route('m.reader_reco')}}?genre=서양역사');

                }
            }

        }
    });

    $(".alert").delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });
</script>
@endsection