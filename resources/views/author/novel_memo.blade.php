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

                <!--Mail list group-->
                <ul id="demo-mail-list" class="mail-list">
                @foreach($novel_mail_messages as $novel_mail_message)
                    <!--Mail list item-->
                    <li >
                        <div class="mail-control">
                            <label class="demo-cb-mail form-checkbox form-normal form-primary">
                                <input type="checkbox">
                            </label>
                        </div>

                        <div class="mail-from"><a href="#">@if($novel_mail_message->users) {{$novel_mail_message->users->name}} @endif</a></div>
                        <div class="mail-time">{{$novel_mail_message->created_at}}</div>

                        <div class="mail-subject">
                            <a href="{{route('author.mailbox_message',['id'=> $novel_mail_message->id ])}}" >{{$novel_mail_message->subject}} </a>
                        </div>
                    </li>
                @endforeach
                    <!--Mail list item-
                    <li class="mail-starred">
                        <div class="mail-control">
                            <label class="demo-cb-mail form-checkbox form-normal form-primary">
                                <input type="checkbox">
                            </label>
                        </div>

                        <div class="mail-from"><a href="#">Shopping Mall</a></div>
                        <div class="mail-time">10:45 AM</div>

                        <div class="mail-subject">
                            <a href="mailbox-message.html">Tracking Your Order - Shoes Store Online</a>
                        </div>
                    </li>

                    <!--Mail list item
                    <li class="mail-list-unread mail-starred mail-attach">
                        <div class="mail-control">
                            <label class="demo-cb-mail form-checkbox form-normal form-primary">
                                <input type="checkbox">
                            </label>
                        </div>

                        <div class="mail-from"><a href="#">Dropbox</a></div>
                        <div class="mail-time">07:18 AM</div>

                        <div class="mail-subject">
                            <a href="mailbox-message.html">Reset your account password</a>
                        </div>
                    </li>

                    <!--Mail list item
                    <li class="mail-list-unread">
                        <div class="mail-control">
                            <label class="demo-cb-mail form-checkbox form-normal form-primary">
                                <input type="checkbox">
                            </label>
                        </div>

                        <div class="mail-from"><a href="#">Server Host</a></div>
                        <div class="mail-time">01:51 PM</div>

                        <div class="mail-subject">
                            <a href="mailbox-message.html">
											<span class="label label-danger">
											Bussines
											</span>
                                Regarding to your website issues.
                            </a>
                        </div>
                    </li>

                    <!--Mail list item-
                    <li>
                        <div class="mail-control">
                            <label class="demo-cb-mail form-checkbox form-normal form-primary">
                                <input type="checkbox">
                            </label>
                        </div>

                        <div class="mail-from"><a href="#">Lisa D. Smith</a></div>
                        <div class="mail-time">Yesterday</div>

                        <div class="mail-subject">
                            <a href="mailbox-message.html">Hi John! How are you?</a>
                        </div>
                    </li> -->
                </ul>


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