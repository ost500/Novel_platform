@extends('layouts.admin_layout')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">보낸 쪽지함</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li><a href="#">쪽지함</a></li>
            <li class="active"><a href="#">보낸 쪽지함</a></li>
        </ol>


        <div id="page-content">


            <div class="panel panel-default panel-left">
                <div id="demo-email-list" class="panel-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <a href="{{route('admin.memo_create')}}">
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
                                <th class="check">{{--<input type="checkbox"> --}}</th>
                                <th class="from">보낸사람</th>
                                <th class="from">소설명</th>
                                <th>제목</th>
                                <th class="send">보낸시간</th>

                                <th class="read">읽은시간</th>
                            </tr>
                            @foreach($novel_mail_messages as $novel_mail_message)
                                <tr>
                                    <td class="check">{{--<input type="checkbox"> --}}
                                        <button class="btn btn-xs btn-danger"
                                                onclick="destroy({{ $novel_mail_message->id }})">삭제
                                        </button>
                                    </td>
                                    <td class="from"><a
                                                href="#">@if($novel_mail_message->users) {{$novel_mail_message->users->name}} @endif</a>
                                    </td>
                                    <td class="from"><a
                                                href="#">@if($novel_mail_message->novel_groups){{$novel_mail_message->novel_groups->title}}@endif</a>
                                    </td>
                                    <td class="text-left"><a
                                                href="{{route('admin.mailbox_send_message',['id'=> $novel_mail_message->id ])}}/?page={{$page}}">{{$novel_mail_message->subject}} </a>
                                    </td>
                                    <td class="send">{{$novel_mail_message->created_at}}</td>
                                    <td class="read">읽은시간</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-left">
                            {{--<button class="btn btn-danger">선택삭제</button> --}}
                        </div>

                        <div class="pull-right">
                            <ul class="pagination">

                                {{-- $novel_mail_messages->render() --}}
                                <li class="page-first  @if($novel_mail_messages->currentPage() ==1)  disabled @endif">
                                    <a href=" @if($novel_mail_messages->currentPage() ==1)  #  @else {{url('/admin/novel_memo_send'."?page=1")}} @endif">
                                        &lt;&lt;</a>
                                </li>
                                @if($novel_mail_messages->currentPage() >= 2)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->currentPage()-1))}}">
                                            &lt;</a></li>
                                @endif
                                @if($novel_mail_messages->currentPage() >= 5)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->currentPage()-4))}}">{{$novel_mail_messages->currentPage()-4}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->currentPage() >= 4)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->currentPage()-3))}}">{{$novel_mail_messages->currentPage()-3}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->currentPage() >= 3)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->currentPage()-2))}}">{{$novel_mail_messages->currentPage()-2}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->currentPage() >= 2)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->currentPage()-1))}}">{{$novel_mail_messages->currentPage()-1}}</a>
                                    </li>
                                @endif

                                <li class="page-number active"><a href="#">{{ $novel_mail_messages->currentPage()}}</a>
                                </li>

                                @if($novel_mail_messages->lastPage()-1 >= $novel_mail_messages->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->currentPage()+1))}}">{{$novel_mail_messages->currentPage()+1}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->lastPage()-2 >= $novel_mail_messages->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->currentPage()+2))}}">{{$novel_mail_messages->currentPage()+2}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->lastPage()-3 >= $novel_mail_messages->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->currentPage()+3))}}">{{$novel_mail_messages->currentPage()+3}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->lastPage()-4 >= $novel_mail_messages->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->currentPage()+4))}}">{{$novel_mail_messages->currentPage()+4}}</a>
                                    </li>
                                @endif

                                @if($novel_mail_messages->lastPage()-1 >= $novel_mail_messages->currentPage())
                                    <li class="page-next"><a
                                                href="{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->currentPage()+1))}}">
                                            &gt;</a></li>
                                @endif

                                <li class="page-last  @if($novel_mail_messages->currentPage() == $novel_mail_messages->lastPage())  disabled @endif">
                                    <a href=" @if($novel_mail_messages->currentPage() ==$novel_mail_messages->lastPage())  #  @else{{url('/admin/novel_memo_send'."?page=".($novel_mail_messages->lastPage()))}} @endif">
                                        &gt;&gt;</a>
                                </li>
                            </ul>
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

                       /* var checked_data = $(".checkboxes:checked").map(function () {
                            return this.value;
                        }).get();*/

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