@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내 정보 -->
<div class="myInfo_wrap">
    <div class="myInfo">
        <div class="myInfo_id">{{$my_profile->name}}</div>
        <div class="myInfo_name">{{ $my_profile->nickname }}</div>
        <div class="myInfo_mail">{{$my_profile->email}}</div>
        <a href="{{url('/logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <div class="myInfo_logout">로그아웃</div>
        </a>

        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
              style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <div class="myInfo_mn_wrap">
        <ul class="myInfo_mn">
            <li>
                <a href="{{ route('m.my_info.charge_bead')}}" class="myInfo_mn_a">
                    <span class="icon_img marble">구슬</span>
                    <span class="myInfo_1">보유구슬</span>
                    <span class="myInfo_num">{{ Auth::user()->bead }}개</span>
                    <span class="myInfo_btn">구슬충전</span>
                </a>
            </li>
            <li>
                <a class="myInfo_mn_a">
                    <span class="icon_img piece">조각</span>
                    <span class="myInfo_1">보유조각</span>
                    <span class="myInfo_num">{{ Auth::user()->piece }}개</span>
                    {{--  <span class="myInfo_txt">소멸 예정 0개</span>--}}
                </a>
            </li>
            <li>
                <a class="myInfo_mn_a">
                    <span class="icon_img bokmak">선호작</span>
                    <span class="myInfo_1">선호작</span>
                    <span class="myInfo_num">{{ $favorites_count }}작품</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- 내 정보 //-->

<!-- 내용 -->
<div class="container">
    <div class="cont_wrap" id="my_info">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
        <!-- 셀렉트박스 //-->

        <!-- 최근 구매 내역 -->
        <div>
            <div class="mlist_tit_rwap">
                <h2 class="mlist_tit">최근 구매 내역</h2>
                <a href="{{ route('m.my_info.purchased_novel_list') }}" class="mlist_more">더보기</a>
            </div>
            <!-- 이미지 리스트 -->
            <table class="mlist_tbl">
                <colgroup>
                    <col width="30%">
                    <col width="*">
                </colgroup>
                <tbody>
                @if(count($recently_purchased_novels)  > 0)
                    @foreach($recently_purchased_novels as $recently_purchased_novel )
                        <tr>
                            <td class="talC"><span class="mtbl_img"> <a
                                            href="{{route('m.each_novel.novel_group_inning',['id'=>$recently_purchased_novel->id])}}"><img
                                                src="/img/novel_covers/{{$recently_purchased_novel->cover_photo}}"></a></span>
                            </td>
                            <td class="">
                                <a href="{{route('m.each_novel.novel_group_inning',['id'=>$recently_purchased_novel->id])}}">
                                    <div class="mtbl_tit">{{str_limit($recently_purchased_novel->title,15)}}</div>
                                </a>

                                <div class="bw_name">{{$recently_purchased_novel->nickname}}</div>
                                <div class="mtbl_binfo">{{$recently_purchased_novel->keyword_name}}<span
                                            class="mtbl_binfo_sl"></span>총 {{$recently_purchased_novel->max_inning}}화
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <div style="text-align:center;">최근 구매 내역이 없습니다</div>
                @endif
                </tbody>
            </table>
            <!-- 이미지 리스트 //-->
        </div>
        <!-- 최근 구매 내역 //-->

        <!-- 선호작 업데이트 -->
        <div>
            <div class="mlist_tit_rwap">
                <h2 class="mlist_tit">선호작 업데이트</h2>
                <a href="{{route('m.my_page.favorites')}}" class="mlist_more">더보기</a>
            </div>
            <!-- 이미지 리스트 -->
            <table class="mlist_tbl">
                <colgroup>
                    <col width="30%">
                    <col width="*">
                </colgroup>
                <tbody>

                @if(count($recently_updated_favorites)  > 0)
                    @foreach($recently_updated_favorites as $recently_updated_favorite )
                        <tr>
                            <td class="talC"><span class="mtbl_img">
                                      <a href="{{route('m.each_novel.novel_group',['id'=>$recently_updated_favorite->id])}}">
                                          <img src="/img/novel_covers/{{$recently_updated_favorite->cover_photo}}"></a><span></span></span>
                            </td>
                            <td class="">
                                <a href="{{route('m.each_novel.novel_group',['id'=>$recently_updated_favorite->id])}}">
                                    <div class="mtbl_tit">{{str_limit($recently_updated_favorite->title,15)}}</div>
                                </a>

                                <div class="bw_name">{{$recently_updated_favorite->nicknames->nickname}}</div>
                                <div class="mtbl_binfo">@if(count($recently_updated_favorite->keywords) >0) {{$recently_updated_favorite->keywords[0]->name }} @endif
                                    <span class="mtbl_binfo_sl"></span>총 {{$recently_updated_favorite->max_inning}}화
                                </div>
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
        </div>
        <!-- 선호작 업데이트 //-->
        <div class="spac40"></div>
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var my_info = new Vue({
        el: '#my_info',
        data: {
            optionValue: ''
        },
        methods: {
            callUrl: function () {

                //Get the selected value
                this.optionValue = $('#myinfoSelect').val();
                //Based on values make a request
                if (this.optionValue == '마이페이지 홈') {
                    location.assign('{{route('m.my_page.index')}}');
                } else if (this.optionValue == '선호작') {
                    location.assign('{{route('m.my_page.favorites')}}');
                } else if (this.optionValue == '이용정보') {
                    location.assign('{{route('m.my_info.charge_bead')}}');

                } else if (this.optionValue == '소설') {
                    location.assign('{{route('m.my_page.novels.new_speed')}}');

                } else if (this.optionValue == '개인') {
                    location.assign('{{route('m.my_info.post_manage')}}');

                }
            }

        }
    });
</script>
@endsection