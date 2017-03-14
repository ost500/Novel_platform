@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="cont_wrap">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->
        @if(Session::has('flash_message'))
            {{-- important, success, warning, danger and info --}}
            <div class="alert alert-success">
                {{Session('flash_message')}}
            </div>
            @endif
                    <!-- 안내문구 -->
            <div class="alert_box">
                <div class="bro22">선물 받은 구슬과 조각은 여우정원에 등록된 작품을 구매할 때 사용할 수 있습니다.<br/>선물을 수령하지 않으면 30일 후 자동으로 반송됩니다.
                </div>
            </div>
            <!-- 안내문구 //-->

            <div class="mlist_tit_rwap">
                <h2 class="mlist_tit5">받은 선물 내역 </h2>
            </div>

            <!-- 리스트 -->
            <table class="tbl_dotline2" id="received_gifts">
                <colgroup>
                    <col width="*">
                    <col width="25%">
                </colgroup>
                <tbody>
                @if($presents->count() == 0)
                    <tr>
                        <td class="contxt2" colspan="4">받은 내역이 없습니다.</td>
                    </tr>
                @endif
                @foreach ($presents as $present)
                    <tr>
                        <td class="contxt2">
                            <div class="borContTit">{{ $present->content }}</div>
                            <div><span class="green_20">{{ $present->fromUser->name }}</span><span
                                        class="gra_20 marL8">{{ $present->created_at }}</span></div>
                        </td>
                        @if($present->status == '대기')
                            <td>
                                <span  id="response{{$present->id}}"></span>
                                <a class="usInfo_btn1" style="width:47%;cursor:pointer;" id="approve{{$present->id}}" v-on:click="approve_deny('{{$present->id}}','수령',1)"> 수령
                                </a>

                                <a class="usInfo_btn1"   style="width:47%;cursor:pointer;" id="deny{{$present->id}}" v-on:click="approve_deny('{{$present->id}}','반송',0)"> 반송
                                </a>
                            </td>
                        @else
                            <td  class="@if($present->status == '수령') buy @else cansel @endif"><span class="marL8" >{{ $present->status }}</span></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- 리스트 //-->

            <!-- 페이징 -->
            @include('pagination_mobile', ['collection' => $presents, 'url' => route('my_info.received_gift')."?"])
                    <!-- 페이징 //-->
    </div>
</div>
<!-- 내용 //-->

<script type="text/javascript">
    var app_gift = new Vue({
        el: '#received_gifts',
        data: {
            info: {
                status: ''
            },
            alert_msg: ''
        },
        mounted: function () {

        },
        methods: {

            approve_deny: function (present_id, status, type) {
                // if type==1 is approve else deny
                if (type == 1) {
                    app_gift.alert_msg = "승인 하시겠습니까?";
                }
                else {
                    app_gift.alert_msg = "반송 하시겠습니까?";
                }

                if (confirm(app_gift.alert_msg)) {

                    //approve info
                    app_gift.info.status = status;
                    app_gift.$http.put('{{ url('presents') }}/' + present_id, app_gift.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                /*   $('#approve' + present_id).hide();
                                 $('#deny' + present_id).hide();
                                 $('#response' + present_id).html(response.data.data);*/
                                location.reload();
                            })
                            .catch(function (data, status, request) {
                                var errors = data.data;
                            });

                }
            }
        }
    });
    $(".alert").delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });
</script>
@endsection