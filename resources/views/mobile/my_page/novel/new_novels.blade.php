@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->

        <div class="mlist_tit_rwap3">
            <h2 class="mlist_tit4">신작알림</h2>
        </div>

        <!-- 리스트 -->
        <table class="tbl_dotline">
            <tbody>
            @foreach($new_novels as $new_novel )
                <tr>
                    <td>
                        <div class="wid_imglst_wrap">
                            <div class="wid_imglst_tit">{{$new_novel->nicknames->nickname}}</div>
                            <ul class="wid_imglst">
                                <li>
                                    <a href="{{route('each_novel.novel_group',['id'=>$new_novel->id])}}"
                                       class="wid_imglst_a">
                                    <span class="widlst_img">

                                            <img src="/img/novel_covers/{{$new_novel->cover_photo}}"
                                                 alt="망의 연월"></span>
											<span class="widlst_txt">
												<strong>{{str_limit($new_novel->title,20)}}</strong>
												<span class="widlst_time">{{$new_novel->new}}</span>
											</span>

                                    </a>
                                </li>
                                @foreach($other_novels[$new_novel->user_id] as $other_novel )
                                    <li>
                                        <a href="{{route('each_novel.novel_group',['id'=>$other_novel->id])}}"
                                           class="wid_imglst_a">
                                            <span class="widlst_img"><img
                                                        src="/img/novel_covers/{{$other_novel->cover_photo}}"></span>
											<span class="widlst_txt">
												<strong>{{str_limit($other_novel->title,20)}}</strong>
												<span class="widlst_time">{{$other_novel->new}}</span>
											</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                          {{--  <a href="" class="btn_x_a"><span class="btn_x_icon">삭제</span></a>--}}
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <!-- 리스트 //-->
        <div class="spac40"></div>
    </div>
</div>
<!-- 내용 //-->
@endsection