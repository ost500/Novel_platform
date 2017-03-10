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
        <div id="sent" >
            <table class="tbl_dotline">
                <colgroup>
                    <col width="40px">
                    <col width="*">
                </colgroup>
                <tbody>
                @if(count($sent_mails) > 0)
                    @foreach($sent_mails as $sent_mail)
                        <tr>
                            <td class="talC talT"><label class="checkbox-wrap"><input type="checkbox" name=""
                                                                                      class="checkboxes"
                                                                                      value="{{$sent_mail->id}}"><i
                                            class="check-icon"></i></label></td>
                            <td class="contxt">
                                <div class="note_icolst">
                                    <div class="note_icolst_img"><img src="/mobile/images/boxicon_ymbok.png" alt="">
                                    </div>
                                    <a href="{{ route('mails.sent_detail', ['id' => $sent_mail->id]) }}">
                                        <div class="note_icolst_txt" style="color: #685f59;">
                                            {{$sent_mail->subject}}
                                        </div>
                                    </a>
                                </div>
                                <div class="tbl_binfo22 mart12">{{$sent_mail->users->name}}<span
                                            class="mtbl_binfo_sl"></span>{{$sent_mail->created_at}}</div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center;"> 해당 조건의 작품이 없습니다.</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <!-- 페이징 -->
            @include('pagination_mobile', ['collection' => $sent_mails, 'url' => route('mails.sent').'?'])
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
        el: '#sent',
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
                        app.$http.post('{{ route('mailbox.destroy_sent_bulk') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                .then(function (response) {
                                    location.reload();

                                }).catch(function (errors) {
                                   // console.log(errors);
                                });
                    }
                }
            }
        }
    });

    $(".alert").delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });
</script>
@endsection