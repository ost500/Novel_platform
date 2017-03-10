@extends('layouts.mobile_layout')
@section('content')
        <!-- 메인 상단 배너 -->
<div class="mtop_vs">
    <h2 class="mtop_vs_tit"><span class="ocher">여</span>기, <span class="ocher">정</span>오의 <span class="ocher">추천</span>
    </h2>
    <!-- book list -->
    <ul class="mtop_list">
        @foreach($recommends as $recommend)
            <li>
                <a href="{{route('each_novel.novel_group',['id'=>$recommend->id])}}" class="mtop_list_a">
                    <span class="mtlst_img"><img src="/img/novel_covers/{{$recommend->cover_photo}}"></span>
					<span class="mtlst_txt">
						<strong>{{str_limit($recommend->title, 10)}}</strong>
						<span class="name">{{str_limit($recommend->nicknames->nickname,10)}}</span>
					</span>
                </a>
            </li>
        @endforeach
    </ul>
    <!-- book list //-->
</div>
<!-- 메인 상단 배너 //-->

<!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 유료연재 베스트 -->
        <div>
            <div class="mlist_tit_rwap">
                <h2 class="mlist_tit"><span class="green">유료연재</span> 투데이 베스트</h2>
                <a href="{{route('bests')}}" class="mlist_more">더보기</a>
            </div>
            <!-- 이미지 리스트 -->
            <table class="mlist_tbl">
                <colgroup>
                    <col width="20%">
                    <col width="25%">
                    <col width="*">
                </colgroup>
                <tbody>
                @foreach($non_free_today_bests as $today_best)
                    <tr>
                        <td class="mtbl_num"><em>{{$loop->iteration}}</em></td>
                        <td class="talC"><a href="{{route('each_novel.novel_group',['id'=>$today_best->id])}}"><span
                                        class="mtbl_img">
                           <img src="/img/novel_covers/{{$today_best->cover_photo}}"></span></a></td>
                        <td class="">
                            <a href="{{route('each_novel.novel_group',['id'=>$today_best->id])}}">
                                <div class="mtbl_tit">{{ str_limit($today_best->title, 15) }}</div>
                            </a>

                            <div class="bw_name">{{ str_limit($today_best->nicknames->nickname, 15) }}</div>
                            <div class="mtbl_binfo">동양판타지<span class="mtbl_binfo_sl"></span>총 128화</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- 이미지 리스트 //-->
        </div>
        <!-- 유료연재 베스트 //-->

        <!-- 무료연재 베스트 -->
        <div>
            <div class="mlist_tit_rwap">
                <h2 class="mlist_tit"><span class="green">무료연재</span> 투데이 베스트</h2>
                <a href="{{route('bests').'/free'}}" class="mlist_more">더보기</a>
            </div>
            <!-- 리스트 -->
            <table class="mlist_tbl">
                <colgroup>
                    <col width="20%">
                    <col width="*">
                </colgroup>
                <tbody>
                @foreach($free_today_bests as $free_today_best)
                    <tr>
                        <td class="mtbl_num"><em>{{$loop->iteration}}</em></td>
                        <td class=""><a href="{{route('each_novel.novel_group',['id'=>$free_today_best->id])}}"><span
                                        class="mtbl_tit">{{ str_limit($free_today_best->title, 15) }}</span></a>
                            <span class="mtbl_sl"></span>
                            <span class="bw_name">{{ str_limit($free_today_best->nicknames->nickname, 10) }}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- 리스트 //-->
        </div>
        <!-- 무료연재 베스트 //-->

        <!-- 독자추천 -->
        <div>
            <div class="mlist_tit_rwap">
                <h2 class="mlist_tit">독자추천</h2>
                <a href="{{route('reader_reco')}}" class="mlist_more">더보기</a>
            </div>
            <!-- 리스트 -->
            <table class="mlist_tbl">
                <tbody>
                @foreach($reader_reviews as $reader_review)
                    <tr>
                        <td>
                            <a href="{{route('reader_reco.detail',['id'=>$reader_review->id])}}">
                                <div class="mtbl_recTit">{{$reader_review->title}}</div>
                            </a>

                            <div class="mtbl_recTxt">{{ str_limit($reader_review->review,100)}}
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <!-- 리스트 //-->
        </div>
        <!-- 독자추천 //-->

        <!-- 님을 위한 추천 -->
        <div class="recommend_box mart70">
            @if(Auth::check())
                <h2 class="mrecbox_tit"> <span class="green">
                            {{ Auth::user()->name }}
                            </span>님을 위한 추천</h2>
            @else
                <h2 class="custom-latest-title">
                    <span>추천</span>인기 소설</h2>
                @endif
                        <!-- 추천도서 리스트 -->
                <ul class="recoList">
                    @foreach($recommendations as $recommendation)
                        <li>
                            <a href="{{route('each_novel.novel_group',['id'=>$recommendation->id])}}"
                               class="reco_list_a">
                                <span class="reco_img"><img
                                            src="img/novel_covers/{{$recommendation->cover_photo}}"></span>
							<span class="reco_txt">
								<strong>{{ str_limit($recommendation->title, 10) }}</strong>
								<span class="name"> {{ str_limit($recommendation->nicknames->nickname, 7) }}</span>
							</span>
                            </a>
                        </li>
                    @endforeach

                </ul>
                <!-- 추천도서 리스트 //-->
        </div>
        <!-- 님을 위한 추천 //-->
    </div>
</div>
<!-- 내용 //-->
@endsection