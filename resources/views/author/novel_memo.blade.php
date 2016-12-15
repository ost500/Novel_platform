@extends('layouts.app')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">쪽지함</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li class="active"><a href="#">쪽지함</a></li>
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
                                <th class="check"><input type="checkbox" name="checkAll" id="checkAll"></th>
                                <th class="from">보낸사람</th>
                                <th>제목</th>
                                <th class="send">보낸시간</th>
                                <th class="read">읽은시간</th>
                            </tr>
                            @foreach($novel_mail_messages as $novel_mail_message)
                                <tr>
                                    <td class="check"><input type="checkbox" class="checkboxes"
                                                             value="{{ $novel_mail_message->id }}"></td>
                                    <td class="from"><a id="demo{{ $novel_mail_message->id }}"
                                                        href="#">@if($novel_mail_message->mailboxs->users) {{$novel_mail_message->mailboxs->users->name}} @endif</a>
                                    </td>
                                    <td class="text-left"><a
                                                href="{{route('author.mailbox_message',['id'=> $novel_mail_message->id ])}}">{{$novel_mail_message->mailboxs->subject}} </a>
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
                            <button class="btn btn-danger" id="destroy">선택삭제</button>
                        </div>

                        <div class="pull-right">
                            <ul class="pagination">

                                {{-- $novel_mail_messages->render() --}}
                                <li class="page-first  @if($novel_mail_messages->currentPage() ==1)  disabled @endif">
                                    <a href=" @if($novel_mail_messages->currentPage() ==1)  #  @else {{url('/author/novel_memo'."?page=1")}} @endif">
                                        &lt;&lt;</a>
                                </li>
                                @if($novel_mail_messages->currentPage() >= 2)
                                    <li class="page-pre"><a
                                                href="{{url('/author/novel_memo'."?page=".($novel_mail_messages->currentPage()-1))}}">
                                            &lt;</a></li>
                                @endif
                                @if($novel_mail_messages->currentPage() >= 5)
                                    <li class="page-pre"><a
                                                href="{{url('/author/novel_memo'."?page=".($novel_mail_messages->currentPage()-4))}}">{{$novel_mail_messages->currentPage()-4}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->currentPage() >= 4)
                                    <li class="page-pre"><a
                                                href="{{url('/author/novel_memo'."?page=".($novel_mail_messages->currentPage()-3))}}">{{$novel_mail_messages->currentPage()-3}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->currentPage() >= 3)
                                    <li class="page-pre"><a
                                                href="{{url('/author/novel_memo'."?page=".($novel_mail_messages->currentPage()-2))}}">{{$novel_mail_messages->currentPage()-2}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->currentPage() >= 2)
                                    <li class="page-pre"><a
                                                href="{{url('/author/novel_memo'."?page=".($novel_mail_messages->currentPage()-1))}}">{{$novel_mail_messages->currentPage()-1}}</a>
                                    </li>
                                @endif

                                <li class="page-number active"><a href="#">{{ $novel_mail_messages->currentPage()}}</a>
                                </li>

                                @if($novel_mail_messages->lastPage()-1 >= $novel_mail_messages->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/author/novel_memo'."?page=".($novel_mail_messages->currentPage()+1))}}">{{$novel_mail_messages->currentPage()+1}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->lastPage()-2 >= $novel_mail_messages->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/author/novel_memo'."?page=".($novel_mail_messages->currentPage()+2))}}">{{$novel_mail_messages->currentPage()+2}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->lastPage()-3 >= $novel_mail_messages->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/author/novel_memo'."?page=".($novel_mail_messages->currentPage()+3))}}">{{$novel_mail_messages->currentPage()+3}}</a>
                                    </li>
                                @endif
                                @if($novel_mail_messages->lastPage()-4 >= $novel_mail_messages->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/author/novel_memo'."?page=".($novel_mail_messages->currentPage()+4))}}">{{$novel_mail_messages->currentPage()+4}}</a>
                                    </li>
                                @endif

                                @if($novel_mail_messages->lastPage()-1 >= $novel_mail_messages->currentPage())
                                    <li class="page-next"><a
                                                href="{{url('/author/novel_memo'."?page=".($novel_mail_messages->currentPage()+1))}}">
                                            &gt;</a></li>
                                @endif

                                <li class="page-last  @if($novel_mail_messages->currentPage() == $novel_mail_messages->lastPage())  disabled @endif">
                                    <a href=" @if($novel_mail_messages->currentPage() ==$novel_mail_messages->lastPage())  #  @else{{url('/author/novel_memo'."?page=".($novel_mail_messages->lastPage()))}} @endif">
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

        $("#checkAll").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });

        // function destroySelected() {
        $("#destroy").click(function () {

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

                        var checked_data = $(".checkboxes:checked").map(function() {
                            return this.value;
                        }).get();

                        $.ajax({
                            type: 'POST',
                            data:{'ids':checked_data},
                            url: '{{ route('mailbox.destroy') }}',
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
            //  }


            $(function () {
                @foreach($novel_mail_messages as $novel_mail_message)
                $("#demo{{$novel_mail_message->id}}").click(function () {
                            $.contextMenu({
                                selector: '#demo{{$novel_mail_message->id}}',
                                trigger: "left",
                                callback: function (key, options) {
                                    var m = "clicked: " + key;
                                    console.log(this);

                                    if (key == "mail") {
                                        {{-- using this @{{$novel_mail_message->id}} we can go to somewhere to send a message to particular person--}}
                                        window.location.assign("{{ route('author.novel_memo_create') }}");
                                    }

                                },
                                items: {
                                    "mail": {name: "쪽지 보내기", icon: "mail"},
                                    "cut": {name: "소설 보기", icon: "cut"},
                                }
                            });
                        });
                @endforeach


                $('.context-menu-one').on('click', function (e) {
                            console.log('clicked', this);
                        })
            });
    </script>


@endsection