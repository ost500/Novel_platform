@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap" id="notifications">
        @include('mobile.ask.select_bar')

                <!-- 문의내역 -->
        <div>
            <div class="mlist_tit_rwap3">
                <h2 class="mlist_tit4">공지사항</h2>
            </div>

            <table class="tbl_dotline">
                <colgroup>
                    <col width="*">
                </colgroup>
                <tbody>
                @foreach($notifications as $notification)
                    <tr>
                        <td class="contxt">
                            <a href="{{route('ask.notification_detail',['id'=>$notification->id])}}"><div class="borContTit">{{$notification->title}}</div></a>
                            <div class="">
                                   <span class="brw_22">{{$notification->category}}</span>
                                <span class="gra_20 marL8">{{$notification->created_at}}</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- 페이징 -->
            @include('pagination_mobile', ['collection' => $notifications, 'url' => route('ask.notifications').'?'])
            <!-- 페이징 //-->
        </div>
        <!-- 문의내역 //-->
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var app = new Vue({
        el: '#notifications',
        data: {
            optionValue: ''
        },
        methods: {
            callUrl: function () {
                //Get the selected value
                this.optionValue = $('#servicesSelect').val();
                console.log(this.optionValue);
                //Based on values make a request
                if (this.optionValue == '자주 묻는 질문') {
                    location.assign('{{route('ask.faqs')}}');
                } else if (this.optionValue == '1:1문의') {
                    location.assign('{{route('ask.ask_question')}}');
                } else if (this.optionValue == '공지사항') {
                    location.assign('{{route('ask.notifications')}}');

                }
            }

        }
    });
</script>
@endsection