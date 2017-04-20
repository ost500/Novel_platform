@extends('layouts.app')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">보낸쪽지함</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">쪽지함</a></li>
            <li class="active" ><a href="#">보낸쪽지함</a></li>
        </ol>


        <div id="page-content">


            <div class="panel panel-default panel-left">
                <div id="demo-email-list" class="panel-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <a href="{{route('author.novel_memo_create')}}">
                                <button type="button" class="btn btn-primary">쪽지보내기</button>
                            </a>
                        </div>
                        <hr class="hr-sm visible-xs">
                        <div class="col-sm-5 clearfix">
                            <div class="pull-right">
                            </div>
                        </div>
                    </div>
                    <hr class="hr-sm">

                    <div>
                        <table class="novel_memo">
                            <tbody>
                            <tr>
                                <th class="check">{{--<input type="checkbox" name="checkAll" id="checkAll"> --}}</th>
                                <th class="from">보낸사람</th>
                                <th class="from">소설명</th>
                                <th>제목</th>
                                <th class="send">보낸시간</th>

                            </tr>
                            @foreach($novel_mail_messages as $novel_mail_message)
                                <tr>
                                    <td class="check">{{--<input type="checkbox"  class="checkboxes"
                                                             value="{{ $novel_mail_message->id }}"> --}}
                                        <button class="btn btn-xs btn-danger"
                                                onclick="destroy({{ $novel_mail_message->id }})">삭제
                                        </button>
                                    </td>
                                    <td class="from"><a
                                                href="#">@if($novel_mail_message->users) {{$novel_mail_message->users->nickname}} @endif</a>
                                    </td>
                                    <td class="from"><a
                                                href="#">@if($novel_mail_message->novel_groups){{$novel_mail_message->novel_groups->title}}@endif</a>
                                    </td>
                                    <td class="text-left"><a
                                                href="{{route('author.mailbox_send_message',['id'=> $novel_mail_message->id ])}}/?page={{$page}}">{{$novel_mail_message->subject}} </a>
                                    </td>
                                    <td class="send">{{$novel_mail_message->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-left">
                            {{--<button class="btn btn-danger" id="destroy">선택삭제</button>--}}
                        </div>

                        <div class="pull-right">
                            @include('pagination', ['collection' => $novel_mail_messages, 'url' => route('author.novel_memo_send')])

                        </div>


                    </div>
                </div>

            </div>
            <!--===================================================-->
            <!-- END OF MAIL INBOX -->


        </div>


    </div>
    <script>

        /*  $("#checkAll").change(function () {
         $("input:checkbox").prop('checked', $(this).prop("checked"));
         });*/

        // function destroySelected() {
        //$("#destroy{{-- $novel_mail_message->id --}}").click(function () {
        function destroy(id) {
            bootbox.confirm({
                message: "삭제 하시겠습니까?",
                buttons: {
                    confirm: {
                        label: "삭제"
                    },
                    cancel: {
                        label: '취소'
                    }
                },
                callback: function (result) {
                    if (result) {

                        var checked_data = $(".checkboxes:checked").map(function () {
                            return this.value;
                        }).get();

                        $.ajax({
                            type: 'DELETE',
                            // data:{'ids':checked_data},
                            url: '/mailboxes/destroy_sent/'+id,
                            headers: {
                                'X-CSRF-TOKEN': window.Laravel.csrfToken
                            },
                            success: function (response) {
                                if (response.error == 1) {

                                    bootbox.alert(response.message, function () {
                                    });
                                } else {
                                    location.reload();
                                }

                                /* $.niftyNoty({
                                 type: 'warning',
                                 icon: 'fa fa-check',
                                 message: "삭제 되었습니다.",
                                 container: 'page',
                                 timer: 4000
                                 });*/
                            },
                            error: function (data2) {
                                console.log(data2);
                            }
                        });

                    }
                }
            })
        }
    </script>
@endsection