@extends('layouts.admin_layout')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">보낸 쪽지</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li class="active"><a href="#">쪽지함</a></li>
        </ol>


        <div id="page-content">

            <div class="panel">
                <div class="panel-body">


                    <div class="row">
                        <div class="col-sm-7">

                            <!--Sender Information-->
                            <div class="media">
                                <div class="media-body">
                                    <div class="text-bold request-subject">{{ $men_to_men_request->subject }}</div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-sm visible-xs">
                        <div class="col-sm-5 clearfix">

                            <!--Details Information-->
                            <div class="pull-right text-right">
                                <p class="mar-no">
                                <div class="text-muted">{{$men_to_men_request->created_at}}</div>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!--Message-->
                    <!--===================================================-->
                    <div class="pad-all bord-all bg-gray-light">
                        {{$men_to_men_request->body}}


                    </div>

                    <div class="row">

                        @if($men_to_men_request->answer)
                            <div class="pad-top">
                                <h5>답변시간 <span>{{$men_to_men_request->updated_at}}</span></h5>

                            </div>

                            <div class="pad-all bord-all bg-gray-light margin-top-10">
                                {{$men_to_men_request->answer}}
                            </div>
                        @endif
                        @if($men_to_men_request->attachment)
                            <div class="pad-top">
                                <div class="col-md-9" style="text-align: left">

                                    <img src="/img/mail_attachments/{{$men_to_men_request->attachment}}"
                                         style="width: 20%;height: 15%"/>

                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="pad-all margin-top-10">


                        <table class="novel_memo">
                            <tbody>
                            <tr>
                                <th class="from">받은사람</th>
                                <th class="content">소설명</th>

                                <th class="send">보낸시간</th>

                                <th class="read">읽은시간</th>
                            </tr>
                            @if($mail_logs->count() == 0)
                                <tr>
                                    <td colspan="4">쪽지를 보내지 않았습니다</td>
                                </tr>
                            @endif
                            @foreach($mail_logs as $maillog)
                                <tr>

                                    <td class="from"><a
                                                href="#">@if($maillog->users) {{$maillog->users->name}} @endif</a>
                                    </td>
                                    <td class="content"><a
                                                href="#">@if($men_to_men_request->novel_groups){{$men_to_men_request->novel_groups->title}}@endif</a>
                                    </td>

                                    <td class="send">{{$men_to_men_request->created_at}}</td>
                                    <td class="read">{{ $maillog->read }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>


                        <div class="fixed-table-pagination" style="display: block;">
                            <div class="pull-left">
                                @include('pagination_manual', ['collection' => $mail_logs, 'url' => route('admin.mailbox_send_message',['id'=>$men_to_men_request->id]) . "?page=".$page . "&maillog_page="])
                            </div>

                            <div class="pull-right">
                                <button id="cancel_mail" class="btn btn-primary">쪽지 보내기 취소</button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <a href="{{route('admin.memo_create')}}">
                                <button class="btn btn-primary">쪽지 보내기</button>
                            </a>
                        </div>
                        <hr class="hr-sm visible-xs">
                        <div class="col-sm-12 clearfix">
                            <div class="pull-left">

                            </div>
                        </div>
                    </div>
                    <hr class="hr-sm">

                    <!--Mail list group-->
                    <ul id="demo-mail-list" class="mail-list">
                    @foreach($men_to_men_requests as $request)
                        @if($men_to_men_request->id == $request->id)
                            @continue
                        @endif
                        <!--Mail list item-->
                            <li class="mail-list-unread">
                                {{--<div class="mail-from">--}}
                                {{--<button @if($request->answer!=null) class="btn btn-xs btn-danger">완료</button>--}}
                                {{--</div>@else class="btn btn-xs btn-success">대기</button>--}}
                                {{--</div>@endif--}}
                                <div class="mail-from">

                                    <button class="btn btn-xs btn-success">대기</button>
                                </div>

                                <div class="mail-time">{{$request->created_at}}</div>

                                <div class="mail-subject">
                                    <a href="{{ route('admin.mailbox_send_message',['id' => $request->id])}}/?page={{$page}}&maillog_page={{$maillog_page}}">{{$request->subject}} </a>
                                </div>
                            </li>
                    @endforeach


                    <!--Mail list item-
                    <li class="mail-starred">
                        <div class="mail-from"><button class="btn btn-xs btn-success">완료</button></div>
                        <div class="mail-time">2014-10-06</div>

                        <div class="mail-subject">
                            <a href="novel_request.php">Tracking Your Order - Shoes Store Online</a>
                        </div>
                    </li>

                    <!--Mail list item
                    <li class="mail-list-unread mail-starred">
                        <div class="mail-from"><button class="btn btn-xs btn-success">완료</button></div>
                        <div class="mail-time">2014-10-06</div>

                        <div class="mail-subject">
                            <a href="novel_request_view.php">Reset your account password</a>
                        </div>
                    </li>-->

                    </ul>

                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-left">
                            @include('pagination_manual', ['collection' => $men_to_men_requests, 'url' => route('admin.mailbox_send_message',['id'=>$men_to_men_request->id]) ."?maillog_page=".$maillog_page. "&page="])
                        </div>
                    </div>


                </div>

            </div>
            <!--===================================================-->
            <!-- END OF MAIL INBOX -->


        </div>


    </div>

    <script>
        $("#cancel_mail").click(function () {

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

                        $.ajax({
                            type: 'DELETE',
                            data: {'delete': true},
                            url: '{{ route('maillog.destroy', ['id' => $men_to_men_request->id]) }}',
                            headers: {
                                'X-CSRF-TOKEN': window.Laravel.csrfToken
                            },
                            success: function (response) {
                                location.reload();
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
        });
    </script>
@endsection