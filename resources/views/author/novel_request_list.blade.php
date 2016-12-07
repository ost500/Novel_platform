@extends('layouts.app')
@section('content')
 <div id="content-container">

    <div id="page-title">
        <h1 class="page-header text-overflow">1:1문의내역</h1>
    </div>


    <ol class="breadcrumb">
        <li><a href="#">작가홈</a></li>
        <li class="active"><a href="#">1:1문의내역</a></li>
    </ol>


    <div id="page-content">



        <div class="panel panel-default panel-left">
            <div id="demo-email-list" class="panel-body">
                <div class="row">
                    <div class="col-sm-7">
                        <a href="{{route('author.novel_request')}}"><button class="btn btn-primary">문의하기</button></a>
                    </div>
                    <hr class="hr-sm visible-xs">
                    <div class="col-sm-12 clearfix">
                        <div class="pull-left">

                        </div>
                    </div>
                </div>
                <hr class="hr-sm">
                <?php $counter= 0; ?>
                @if($counter > 0)
                <!--Mail list group-->
                <ul id="demo-mail-list" class="mail-list">

                    <!--Mail list item-->
                    @foreach($men_to_men_requests as $men_to_men_request)
                    <!--Mail list item-->
                    <li class="mail-list-unread">
                        <div class="mail-from"><button  @if($men_to_men_request->status==0) class="btn btn-xs btn-danger" @else class="btn btn-xs btn-success"  @endif >대기</button></div>

                        <div class="mail-time">{{$men_to_men_request->created_at}}</div>

                        <div class="mail-subject">
                            <a href="{{ route('author.novel_request_view',['id' => $men_to_men_request->id]) }}">{{$men_to_men_request->title}} </a>
                        </div>
                    </li>
                    @endforeach

                   
                </ul>


                <div class="fixed-table-pagination" style="display: block;">
                    <div class="pull-left">
                        <ul class="pagination">

                            {{-- $men_to_men_requests->render() --}}
                            <li class="page-first  @if($men_to_men_requests->currentPage() ==1)  disabled @endif" >
                                <a href=" @if($men_to_men_requests->currentPage() ==1)  #  @else {{url('/author/novel_request_list'."?page=1")}} @endif">&lt;&lt;</a>
                            </li>
                            @if($men_to_men_requests->currentPage() >= 2)
                                <li class="page-pre"><a href="{{url('/author/novel_request_list'."?page=".($men_to_men_requests->currentPage()-1))}}">&lt;</a></li>
                            @endif
                            @if($men_to_men_requests->currentPage() >= 5)
                                <li class="page-pre"><a href="{{url('/author/novel_request_list'."?page=".($men_to_men_requests->currentPage()-4))}}">{{$men_to_men_requests->currentPage()-4}}</a></li>
                            @endif
                            @if($men_to_men_requests->currentPage() >= 4)
                                <li class="page-pre"><a href="{{url('/author/novel_request_list'."?page=".($men_to_men_requests->currentPage()-3))}}">{{$men_to_men_requests->currentPage()-3}}</a></li>
                            @endif
                            @if($men_to_men_requests->currentPage() >= 3)
                                <li class="page-pre"><a href="{{url('/author/novel_request_list'."?page=".($men_to_men_requests->currentPage()-2))}}">{{$men_to_men_requests->currentPage()-2}}</a></li>
                            @endif
                            @if($men_to_men_requests->currentPage() >= 2)
                                <li class="page-pre"><a href="{{url('/author/novel_request_list'."?page=".($men_to_men_requests->currentPage()-1))}}">{{$men_to_men_requests->currentPage()-1}}</a></li>
                            @endif

                            <li class="page-number active"><a href="#">{{ $men_to_men_requests->currentPage()}}</a></li>

                            @if($men_to_men_requests->lastPage()-1 >= $men_to_men_requests->currentPage())
                                <li class="page-number"><a href="{{url('/author/novel_request_list'."?page=".($men_to_men_requests->currentPage()+1))}}">{{$men_to_men_requests->currentPage()+1}}</a></li>
                            @endif
                            @if($men_to_men_requests->lastPage()-2 >= $men_to_men_requests->currentPage())
                                <li class="page-number"><a href="{{url('/author/novel_request_list'."?page=".($men_to_men_requests->currentPage()+2))}}">{{$men_to_men_requests->currentPage()+2}}</a></li>
                            @endif
                            @if($men_to_men_requests->lastPage()-3 >= $men_to_men_requests->currentPage())
                                <li class="page-number"><a href="{{url('/author/novel_request_list'."?page=".($men_to_men_requests->currentPage()+3))}}">{{$men_to_men_requests->currentPage()+3}}</a></li>
                            @endif
                            @if($men_to_men_requests->lastPage()-4 >= $men_to_men_requests->currentPage())
                                <li class="page-number"><a href="{{url('/author/novel_request_list'."?page=".($men_to_men_requests->currentPage()+4))}}">{{$men_to_men_requests->currentPage()+4}}</a></li>
                            @endif

                            @if($men_to_men_requests->lastPage()-1 >= $men_to_men_requests->currentPage())
                            <li class="page-next"><a href="{{url('/author/novel_request_list'."?page=".($men_to_men_requests->currentPage()+1))}}">&gt;</a></li>
                            @endif

                            <li class="page-last  @if($men_to_men_requests->currentPage() == $men_to_men_requests->lastPage())  disabled @endif">
                                <a href=" @if($men_to_men_requests->currentPage() ==$men_to_men_requests->lastPage())  #  @else{{url('/author/novel_request_list'."?page=".($men_to_men_requests->lastPage()))}} @endif">&gt;&gt;</a>
                            </li>
                        </ul>
                    </div>

                    <div class="pull-right">

                    </div>
                    @else
                        <div style="font-weight: 600;text-align: center;">
                           No record Found.
                        </div>
                    @endif

                </div>
            </div>

        </div>
        <!--===================================================-->
        <!-- END OF MAIL INBOX -->


    </div>


 </div>
@endsection