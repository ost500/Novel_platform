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
                            <th class="check"><input type="checkbox"></th>
                            <th class="from">보낸사람</th>
                            <th>제목</th>
                            <th class="send">보낸시간</th>
                            <th class="read">읽은시간</th>
                        </tr>
                        @foreach($novel_mail_messages as $novel_mail_message)
                        <tr>
                            <td class="check"><input type="checkbox"></td>
                            <td class="from"><a href="#">@if($novel_mail_message->users) {{$novel_mail_message->users->name}} @endif</a></td>
                            <td class="text-left"><a href="{{route('author.mailbox_message',['id'=> $novel_mail_message->id ])}}" >{{$novel_mail_message->subject}} </a></td>
                            <td class="send">{{$novel_mail_message->created_at}}</td>
                            <td class="read">읽은시간</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="fixed-table-pagination" style="display: block;">
                    <div class="pull-left">
                        <button class="btn btn-danger">선택삭제</button>
                    </div>

                    <div class="pull-right">
                        <ul class="pagination"><li class="page-first disabled"><a href="javascript:void(0)">&lt;&lt;</a></li><li class="page-pre disabled"><a href="javascript:void(0)">&lt;</a></li><li class="page-number active disabled"><a href="javascript:void(0)">1</a></li><li class="page-number"><a href="javascript:void(0)">2</a></li><li class="page-number"><a href="javascript:void(0)">3</a></li><li class="page-number"><a href="javascript:void(0)">4</a></li><li class="page-number"><a href="javascript:void(0)">5</a></li><li class="page-next"><a href="javascript:void(0)">&gt;</a></li><li class="page-last"><a href="javascript:void(0)">&gt;&gt;</a></li></ul>
                    </div>
                </div>
            </div>

        </div>
        <!--===================================================-->
        <!-- END OF MAIL INBOX -->


    </div>


 </div>

@endsection