@extends('layouts.admin_layout')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">공지사항</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li><a href="#">공지사항 관리</a></li>
            <li class="active">공지사항</li>
        </ol>


        <div id="page-content">

            <div class="panel">
                <div class="panel-body">


                    <div class="row">
                        <div class="col-sm-7">

                            <!--Sender Information-->
                            <div class="media">
                                <div class="media-body">
                                    <div class="text-bold request-subject">{{ $noti->title }}

                                        @if($noti->posting)
                                            <button style="margin-left:10px" class="btn btn-success">
                                                공지
                                            </button>
                                        @else
                                            <button style="margin-left:10px" class="btn btn-danger">
                                                미공지
                                            </button>
                                        @endif

                                    </div>

                                    <h4>관리자</h4>
                                </div>
                            </div>
                        </div>

                        <hr class="hr-sm visible-xs">
                        <div class="col-sm-5 clearfix">

                            <!--Details Information-->
                            <div class="pull-right text-right">
                                <p class="mar-no">
                                <div class="text-muted">{{$noti->created_at}}</div>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!--Message-->
                    <!--===================================================-->
                    <div class="pad-all bord-all bg-gray-light">

                        {{$noti->content}}
                    </div>
                    <div style="margin-top:10px" class="pull-left">
                        <a href="{{route('admin.notifications.update', ['id' => $noti->id])}}">
                            <button id="cancel_mail" class="btn btn-primary">수정</button>
                        </a>
                    </div>

                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-7">

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
                    @foreach($notifications as $notification)
                        @if($noti->id == $notification->id)
                            @continue
                        @endif
                        <!--Mail list item-->
                            <li class="mail-list-unread">
                                <div class="mails-from">


                                    <div class="mail-from">
                                        <a>관리자</a>

                                    </div>

                                    <div class="mail-from">
                                        @if($notification->posting)
                                            <button style="margin-left:10px" class="btn btn-success">
                                                공지
                                            </button>
                                        @else
                                            <button style="margin-left:10px" class="btn btn-danger">
                                                미공지
                                            </button>
                                        @endif
                                    </div>

                                    <div class="mail-time">{{$notification->created_at}}</div>

                                    <div class="mail-subject">
                                        <a href="{{ route('admin.notifications.detail', ['id' => $notification->id]) }}/?page={{$page}}">{{$notification->title}} </a>
                                    </div>
                                </div>
                            </li>
                    @endforeach

                    <!--Mail list item-
                    <li class="mails-starred">
                        <div class="mails-from"><button class="btn btn-xs btn-success">완료</button></div>
                        <div class="mails-time">2014-10-06</div>

                        <div class="mails-subject">
                            <a href="novel_request.php">Tracking Your Order - Shoes Store Online</a>
                        </div>
                    </li>

                    <!--Mail list item
                    <li class="mails-list-unread mails-starred">
                        <div class="mails-from"><button class="btn btn-xs btn-success">완료</button></div>
                        <div class="mails-time">2014-10-06</div>

                        <div class="mails-subject">
                            <a href="novel_request_view.php">Reset your account password</a>
                        </div>
                    </li>-->

                    </ul>
                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-left">
                            @include('pagination', ['collection' => $notifications, 'url' => route('admin.notifications.detail', ['id'=>$notification->id])])
                        </div>
                    </div>
                </div>

            </div>
            <!--===================================================-->
            <!-- END OF MAIL INBOX -->


        </div>


    </div>
@endsection