@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="cont_wrap" >
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->

        <!-- 전체선택 -->
        <div class="padb10">
            @if(Session::has('flash_message'))
                {{-- important, success, warning, danger and info --}}
                <div class="alert alert-success">
                    {{Session('flash_message')}}
                </div>
            @endif
            <table class="tbl_noline">
                <colgroup>
                    <col width="40px">
                    <col width="*">
                </colgroup>
                <tbody>
                <tr>
                    <td class="talC"><label class="checkbox-wrap"><input type="checkbox" name="checkAll" id="checkAll"><i
                                    class="check-icon"></i></label></td>
                    <td class="contxt4">전체선택</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- 전체선택 //-->

        <!-- 리스트 테이블 -->
        <div id="received" >
            <table class="tbl_dotline">
                <colgroup>
                    <col width="40px">
                    <col width="*">
                </colgroup>
                <tbody>
                @if(count($received_mails) > 0)
                    @foreach($received_mails as $received_mail)
                        <tr>
                            <td class="talC talT"><label class="checkbox-wrap"><input type="checkbox" name=""
                                                                                      class="checkboxes"
                                                                                      value="{{$received_mail->id}}"><i
                                            class="check-icon"></i></label></td>
                            <td class="contxt">
                                <div class="note_icolst">
                                    <div class="note_icolst_img"><img src="/mobile/images/boxicon_speech.png" alt="">
                                    </div>
                                  <a href="{{ route('mails.detail', ['id' => $received_mail->id]) }}">
                                        <div @if($received_mail->read == null) class="note_icolst_txt green" @else  class="note_icolst_txt" style="color: #685f59;" @endif>
                                            {{$received_mail->mailboxs->subject}}
                                        </div>
                                   </a>
                                </div>
                                <div class="tbl_binfo22 mart12">{{$received_mail->mailboxs->users->name}}<span
                                            class="mtbl_binfo_sl"></span>{{$received_mail->created_at}}</div>
                                <div class="replst_btn_wrap mart15">
                                    <a  v-on:click="destroy()" class="replst_btn" style="cursor:pointer">삭제</a>
                                    <a  v-on:click="myBoxOrSpam('mybox')" class="replst_btn" style="cursor:pointer">보관</a>
                                    <a  v-on:click="myBoxOrSpam('spam')" class="replst_btn" style="cursor:pointer" >차단</a>
                                    <a  href="{{route('accusations',['id'=>Auth::user()->id])}}" class="replst_btn" style="cursor:pointer">신고</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center;"> 받은 쪽지가 없습니다.</td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="replst_btn_wrap2 padt30">
                <button  v-on:click="destroy()" class="replst_btn2" style="cursor:pointer;"  @if(count($received_mails) == 0)  disabled @endif>삭제</button>
                <button  v-on:click="myBoxOrSpam('mybox')" class="replst_btn2" style="cursor:pointer;"  @if(count($received_mails) == 0)  disabled @endif>보관</button>
                <button  v-on:click="myBoxOrSpam('spam')" class="replst_btn2" style="cursor:pointer;"  @if(count($received_mails) == 0)  disabled @endif>차단</button>
                <a  href="{{route('accusations',['id'=>Auth::user()->id])}}"><button class="replst_btn2" @if(count($received_mails) == 0)  disabled @endif style="cursor:pointer;">신고 </button></a>
            </div>

            <!-- 페이징 -->
            @include('pagination_mobile', ['collection' => $received_mails, 'url' => route('mails.received').'?'])
                    <!-- 페이징 //-->
        </div>
        <!-- 리스트 테이블 //-->
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">

    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

    var app = new Vue({
        el: '#received',
        data: {
            info: {ids: '', type: ''}
        },

        methods: {
            destroy: function () {

                this.info.ids = $(".checkboxes:checked").map(function () {
                    return this.value;
                }).get();
                if (this.info.ids.length > 0) {

                    if (confirm('삭제 하시겠습니까?')) {
                        app.$http.post('{{ route('mailbox.destroy') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                .then(function (response) {
                                    location.reload();

                                }).catch(function (errors) {
                                   // console.log(errors);
                                });
                    }
                }
            },
            myBoxOrSpam: function (type) {

                this.info.ids = $(".checkboxes:checked").map(function () {
                    return this.value;
                }).get();
                this.info.type = type;
                if (this.info.ids.length > 0) {
                    app.$http.put('{{ route('maillog.update') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                location.reload();

                            }).catch(function (errors) {
                                console.log(errors);
                            });
                }
            },
            spam: function () {

            }
        }
    });

    $(".alert").delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });
</script>
@endsection