@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="cont_wrap" id="novel_group_notifications">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->

        <div class="mlist_tit_rwap3">
            <h2 class="mlist_tit4">신작알림</h2>
        </div>

        <!-- 리스트 -->
        <table class="tbl_dotline">
            <tbody>
            @if($authors->isEmpty())
                <tr>
                    <td>
                        <div class="wid_imglst_wrap">
                            <div class="wid_imglst_tit" style="text-align: center;">신작이 없습니다.</div>
                        </div>
                    </td>
                </tr>
            @endif
            @foreach($authors as $author )
                <tr>
                    <td>
                        <div class="wid_imglst_wrap">
                            <div class="wid_imglst_tit">{{$author->nickname}}</div>
                            <ul class="wid_imglst">
                                @foreach($notifications[$author->user_id] as $notification )
                                    <li>
                                        <a href="{{route('each_novel.novel_group',['id'=>$notification->id])}}"
                                           class="wid_imglst_a">
                                            <span class="widlst_img"><img
                                                        src="/img/novel_covers/{{$notification->cover_photo}}"></span>
											<span class="widlst_txt">
												<strong>{{str_limit($notification->title,20)}}</strong>
												<span class="widlst_time">{{$notification->notification_date}}</span>
											</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <a class="btn_x_a" style="cursor:pointer;" v-on:click="remove_notifications('{{$author->user_id}}')"><span class="btn_x_icon">삭제</span></a>
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
<script>
    var app_noti = new Vue({
        el: '#novel_group_notifications',
        data: {

        },

        methods: {
            remove_notifications:function(author_id){
                    this.$http.delete('{{ route('novel_group_notifications.destroy',['id'=>""]) }}/'+author_id, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                location.reload();
                            })
                            .catch(function (errors) {

                                window.location.assign('{{ url('/login')}}');
                            });
            }
        }
    });
</script>
@endsection