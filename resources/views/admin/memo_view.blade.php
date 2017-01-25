@extends('layouts.admin_layout')
@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">받은 쪽지</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li class="active"><a href="#">받은 쪽지</a></li>
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

                                <img src="/img/mail_attachments/{{$men_to_men_request->attachment}}" style="width: 20%;height: 15%"/>

                            </div>
                        </div>
                    @endif

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
                            {{--<div class="mails-from">--}}
                            {{--<button @if($request->answer!=null) class="btn btn-xs btn-danger">완료</button>--}}
                            {{--</div>@else class="btn btn-xs btn-success">대기</button>--}}
                            {{--</div>@endif--}}
                            <div class="mail-from">

                                <button class="btn btn-xs btn-success">대기</button>
                            </div>

                            <div class="mail-time">{{$request->created_at}}</div>

                            <div class="mail-subject">
                                <a href="{{ route('admin.memo_view',['id' => $request->id])}}">{{$request->subject}} </a>
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
                            <ul class="pagination">

                                {{-- $men_to_men_requests->render() --}}
                                <li class="page-first  @if($men_to_men_requests->currentPage() ==1)  disabled @endif">
                                    <a href=" @if($men_to_men_requests->currentPage() ==1)  #  @else {{url('/author/novel_request_view/'.$men_to_men_request->id."?page=1")}} @endif">
                                        &lt;&lt;</a>
                                </li>
                                @if($men_to_men_requests->currentPage() >= 2)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()-1))}}">
                                            &lt;</a></li>
                                @endif
                                @if($men_to_men_requests->currentPage() >= 5)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()-4))}}">{{$men_to_men_requests->currentPage()-4}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->currentPage() >= 4)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()-3))}}">{{$men_to_men_requests->currentPage()-3}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->currentPage() >= 3)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()-2))}}">{{$men_to_men_requests->currentPage()-2}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->currentPage() >= 2)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()-1))}}">{{$men_to_men_requests->currentPage()-1}}</a>
                                    </li>
                                @endif

                                <li class="page-number active"><a href="#">{{ $men_to_men_requests->currentPage()}}</a>
                                </li>

                                @if($men_to_men_requests->lastPage()-1 >= $men_to_men_requests->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()+1))}}">{{$men_to_men_requests->currentPage()+1}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->lastPage()-2 >= $men_to_men_requests->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()+2))}}">{{$men_to_men_requests->currentPage()+2}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->lastPage()-3 >= $men_to_men_requests->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()+3))}}">{{$men_to_men_requests->currentPage()+3}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->lastPage()-4 >= $men_to_men_requests->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()+3))}}">{{$men_to_men_requests->currentPage()+4}}</a>
                                    </li>
                                @endif

                                @if($men_to_men_requests->lastPage()-1 >= $men_to_men_requests->currentPage())
                                    <li class="page-next"><a
                                                href="{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()+1))}}">
                                            &gt;</a></li>
                                @endif

                                <li class="page-last  @if($men_to_men_requests->currentPage() == $men_to_men_requests->lastPage())  disabled @endif">
                                    <a href=" @if($men_to_men_requests->currentPage() ==$men_to_men_requests->lastPage())  #  @else{{url('/admin/memo_view/'.$men_to_men_request->id."?page=".($men_to_men_requests->lastPage()))}} @endif">
                                        &gt;&gt;</a>
                                </li>
                            </ul>
                        </div>

                        <div class="pull-right">

                        </div>
                    </div>
                </div>

            </div>
            <!--===================================================-->
            <!-- END OF MAIL INBOX -->


        </div>


    </div>
@endsection
